<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EOrder;
use AppORM\Entity\EProduct;
use AppORM\Entity\EReservation;
use AppORM\Entity\ETurn;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETable;
use AppORM\Entity\ReservationStatus;
use AppORM\Entity\EReservationTable;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FReservation;
use AppORM\Services\Foundation\FTurn;
use AppORM\Services\Foundation\FOrder;
use AppORM\Entity\TableState;
use AppORM\Entity\OrderStatus;
use AppORM\Entity\DayOfWeek;

class FPersistentManager {

    private static $instance;

    private function __construct() {
       
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function uploadObject($object) {
        $result = FEntityManager::getInstance()->saveObject($object);
        return $result;
    }



    //Funzione che crea una prenotazione, passi in ingeresso solo l'oggetto reservation e l'associazione al client la fai nel controllore
    //mentre l'associazione al tavolo e al turno viene fatta nella funzione
    public static function createReservation(EReservation $reservation){
        //costanti per gestire la durata dinamica della prenotazione 
        $defaultDuration = 90;
        $minDuration = 60;
        $maxDuration = 180;

        $date = $reservation->getDate();
        
        $dayOfWeek = DayOfWeek::fromDate($date);

        $turn = FTurn::getTurnByDayOfTheWeek($dayOfWeek);

        $turn = FTurn::determineTurnByTime($reservation->getHours());

        if (!$turn) {
            return [
                'status' => 'error',
                'message' => "Orario non valido per nessun turno."
            ];
        }

      
        $reservation->setTurn($turn);

        $time = $reservation->getHours();
        
        $duration = $reservation->getDuration();
        //$turn = FEntityManager::getInstance()->retriveObject(ETurn::getEntity(), $reservation->getTurn()->getIdTurn());
        $hall = FEntityManager::getInstance()->retriveObject(ERestaurantHall::getEntity(), $reservation->getRestaurantHall()->getIdHall()); 

    
        //se non è specificata una durata assegna una di default
        if(!$duration) {
            $duration = $defaultDuration;
            $reservation->setDuration($duration);
        }

        if ($duration < $minDuration || $duration > $maxDuration) {
            return [
                'status' => 'error',
                'message' => "La durata della prenotazione deve essere compresa tra $minDuration e $maxDuration minuti."
            ];
        }

        
        // tutto questo per assegnare la data ai turni che non la hanno
        $timeStart = \DateTime::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d') . ' ' .  $time->format('H:i:s'));

        $endTime = (clone $timeStart)->modify("+$duration minutes");
        
        $reservationDate = $timeStart->format('Y-m-d');

        $turnStart = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getStartTime()->format('H:i:s'));

        $turnEnd = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getEndTime()->format('H:i:s'));

        $maxEndTime = (clone $turnEnd)->modify("+30 minutes");

        if ($timeStart < $turnStart) {
            return [
                'status' => 'error',
                'message' => "L'orario di inizio della prenotazione non può essere prima dell'orario di inizio del turno."
            ];
        }

        if ($endTime > $maxEndTime) {
            return [
                'status' => 'error',
                'message' => "L'orario di fine della prenotazione non può superare l'orario di fine del turno."
            ];
        }

        //$tables = FEntityManager::getInstance()->retriveObjectList(ETable::getEntity(), 'restaurantHall', $hall->getIdHall());
        
        try {
            $tables = FEntityManager::getInstance()->selectAll(ETable::getEntity());
            echo "✅ Chiamata riuscita, tavoli caricati\n";
        } catch (\Exception $e) {
            echo "❌ ERRORE durante il recupero dei tavoli: " . $e->getMessage() . "\n";
            
        }

        $people = $reservation->getPeopleNum();
        $availableTables = [];   

        foreach ($tables as $table) {
            $conflict = false;
            
            $existingReservations = FReservation::getReservationsForTableOnDate($table, $reservation->getDate());

            foreach ($existingReservations as $existing) {
                if (!in_array($existing->getStatus(), [ReservationStatus::CREATED, ReservationStatus::APPROVED, ReservationStatus::ORDER_IN_PROGRESS, ReservationStatus::ORDER_COMPLETED])) {
                    continue; 
                }
                $existingStart = $existing->getHours();
                $existingEnd = (clone $existingStart)->modify("+" . $existing->getDuration() . " minutes");
                
                if (
                    ($time >= $existingStart && $time < $existingEnd) ||
                    ($endTime > $existingStart && $endTime <= $existingEnd) ||
                    ($time < $existingStart && $endTime > $existingEnd)
                ) {
                    $conflict = true;
                    break;
                }
            }

            if (!$conflict) {
                $availableTables[] = $table;
            }
        }

        usort($availableTables, fn($a, $b) => $a->getSeatsNumber() <=> $b->getSeatsNumber());

        $assignedTables = [];
        $seatsAccumulated = 0;

        foreach ($availableTables as $table) {
            $assignedTables[] = $table;
            $seatsAccumulated += $table->getSeatsNumber();
            if ($seatsAccumulated >= $people) {
                break;
            }
        }

        if ($seatsAccumulated < $people) {
            return [
                'status' => 'error',
                'message' => "Non ci sono abbastanza posti disponibili per $people persone."
            ];
        }

        
            foreach ($assignedTables as $table) {
                $reservationTable = new EReservationTable();
                $reservationTable->setReservation($reservation);
                $reservationTable->setDate($date);
                $reservationTable->setStartTime($timeStart);
                $reservationTable->setEndTime($endTime);
                $reservationTable->setTable($table);
                self::uploadObject($reservationTable);

                $reservation->addTableReservation($reservationTable);
                //$reservation->addTable($table);
                $table->setState(TableState::RESERVED);
                self::uploadObject($table);
            } 
        
        self::uploadObject($reservation);
        
        return [
            'status' => 'success',
            'message' => "Prenotazione creata con successo.",
            'tables' => array_map(fn($t) => $t->getIdTable(), $assignedTables)
        ];

    }


    public static function createOrderFromReservation(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::CREATED) {
            
            $reservation->setStatus(ReservationStatus::APPROVED);
            self::uploadObject($reservation);
            $order = FOrder::createOrder($reservation);
            $results = self::uploadObject($order);
            return $results;
        }
    }


    public static function deleteReservation(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::CREATED) {
            
            $tables = $reservation->getTable();
           
            foreach ($tables as $table) {
                $table->setState(TableState::AVAILABLE);
                self::uploadObject($table);
            }
            $reservation->setStatus(ReservationStatus::CANCELED);
            $results = self::uploadObject($reservation);
            return $results;

        } else {
            return [
                'status' => 'error',
                'message' => "La prenotazione non può essere cancellata perché non è nello stato 'CREATED'."
            ];
        }
    }

    public static function unlockOrder(EOrder $order) {
       $reservation = $order->getReservation();
       
       if ($reservation->getStatus() == ReservationStatus::APPROVED) {
            $reservation->setStatus(ReservationStatus::ORDER_IN_PROGRESS);
            self::uploadObject($reservation);
            $order->setStatus(OrderStatus::IN_PROGRESS);
            $results = self::uploadObject($order);
            return $results;
        } else {
            return [
                'status' => 'error',
                'message' => "L'ordine non può essere sbloccato perché la prenotazione non è nello stato 'APPROVED'."
            ];
        }

    }

    public static function confirmOrder(EOrder $order) {
        $reservation = $order->getReservation();
        
        if ($reservation->getStatus() == ReservationStatus::ORDER_IN_PROGRESS) {
            $reservation->setStatus(ReservationStatus::ORDER_COMPLETED);
            self::uploadObject($reservation);
            $order->setStatus(OrderStatus::PAID);
            $results = self::uploadObject($order);
            return $results;
        } else {
            return [
                'status' => 'error',
                'message' => "L'ordine non può essere confermato perché la prenotazione non è nello stato 'ORDER_IN_PROGRESS'."
            ];
        }
    }

    public static function getOrderSummaryForReservation(EReservation $reservation) {
        $order = FReservation::getOrderByReservation($reservation);
        $reservation->setStatus(ReservationStatus::ENDED);
        self::uploadObject($reservation);
        return [
            'items' => $order->getOrderItems(),
            'total' => FOrder::calculateTotalPrice($order),
        ];
    }
}