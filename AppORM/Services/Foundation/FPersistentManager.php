<?php

namespace AppORM\Services\Foundation;

require_once __DIR__ . '/../../Entity/EReservation.php';
require_once __DIR__ . '/../../Entity/ETurn.php';
require_once __DIR__ . '/../../Entity/ERestaurantHall.php';
require_once __DIR__ . '/../../Entity/ETable.php';
require_once __DIR__ . '/FEntityManager.php';
require_once __DIR__ . '/FReservation.php';
// Ensure the EReservation class is loaded
use AppORM\Entity\EReservation;
use AppORM\Entity\ETurn;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETable;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FReservation;
use AppORM\Services\Foundation\FTurn;

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
        echo "Sto cercando di salvare l'oggetto \n";
        $result = FEntityManager::getInstance()->saveObject($object);
        echo "saveObject risultato: " . ($result ? "true" : "false") . "\n";
        return $result;
    }



    //Funzione che crea una prenotazione, passi in ingeresso solo l'oggetto reservation e l'associazione al client la fai nel controllore
    //mentre l'associazione al tavolo e al turno viene fatta nella funzione
    public static function createReservation(EReservation $reservation){
        //costanti per gestire la durata dinamica della prenotazione 
        $defaultDuration = 90;
        $minDuration = 60;
        $maxDuration = 180;

        $turn = FTurn::determineTurnByTime($reservation->getHours());


        echo "vedo se l'orario ha senso con il turno \n";
        if (!$turn) {
            return [
                'status' => 'error',
                'message' => "Orario non valido per nessun turno."
            ];
        }

        echo "è andato? \n";

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

        echo "controllo la durata \n";

        if ($duration < $minDuration || $duration > $maxDuration) {
            return [
                'status' => 'error',
                'message' => "La durata della prenotazione deve essere compresa tra $minDuration e $maxDuration minuti."
            ];
        }

        echo "andato? \n";

        $timeStr = $time->format('H:i:s');

        $endTime = (clone $time)->modify("+$duration minutes");

        $endTimeStr = $endTime->format('H:i:s');

        $turnStart = $turn->getStartTime();
        $turnStartStr = $turnStart->format('H:i:s');

        $turnEnd = $turn->getEndTime();
        $turnEndStr = $turnEnd->format('H:i:s');

        $maxEndTime = (clone $turnEnd)->modify("+30 minutes");
        $maxEndTimeStr = $maxEndTime->format('H:i:s');

        if ($timeStr < $turnStartStr) {
            return [
                'status' => 'error',
                'message' => "L'orario di inizio della prenotazione non può essere prima dell'orario di inizio del turno."
            ];
        }

        if ($endTimeStr > $maxEndTimeStr) {
            return [
                'status' => 'error',
                'message' => "L'orario di fine della prenotazione non può superare l'orario di fine del turno."
            ];
        }

        echo "controllo gli orari \n";

        //$tables = FEntityManager::getInstance()->retriveObjectList(ETable::getEntity(), 'restaurantHall', $hall->getIdHall());

        try {
            $tables = FEntityManager::getInstance()->selectAll(ETable::getEntity());
            echo "✅ Chiamata riuscita, tavoli caricati\n";
        } catch (\Exception $e) {
            echo "❌ ERRORE durante il recupero dei tavoli: " . $e->getMessage() . "\n";
            
        }

        $people = $reservation->getPeopleNum();
        $availableTables = [];


        echo "inizio a controllare i tavoli \n";

        

        foreach ($tables as $table) {
            echo "qui? \n";
            $conflict = false;
            
            $existingReservations = FReservation::getReservationsForTableOnDate($table, $reservation->getDate());

            echo "ora? \n";
            foreach ($existingReservations as $existing) {
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
            $reservation->addTable($table);
        }


        echo "odio il mondo... \n";
        self::uploadObject($reservation);

        return [
            'status' => 'success',
            'message' => "Prenotazione creata con successo.",
            'tables' => array_map(fn($t) => $t->getIdTable(), $assignedTables)
        ];

    }


    


}