<?php

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




    public static function createReservation(EReservation $reservation){
        //costanti per gestire la durata dinamica della prenotazione 
        $defaultDuration = 90;
        $minDuration = 60;
        $maxDuration = 180;

        $time = $reservation->getHours();
        $duration = $reservation-getReservation();
        $turn = FEntityManager::getInstance()->retriveObject(ETurn::getEntity(), $reservation->getTurn()->getIdTurn());
        $hall = FEntityManager::getInstance()->retriveObject(EHall::getEntity(), $reservation->getHall()->getIdHall()); 

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

        $endTime = (clone $time)->modify("+$duration minutes");

        $turnStart = $turn->getStartTime();
        $turnEnd = $turn->getEndTime();
        $maxEndTime = (clone $turnEnd)->modify("+30 minutes");
        

        if ($time < $turnStart) {
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

        $tables = FEntityManager::getInstance()->retriveObjectList(ETable::getEntity(), 'hall', $hall->getIdHall());


        $people = $reservation->getPeopleNum();
        $availableTables = [];

        foreach ($tables as $table) {
            $conflict = false;
            $existingReservations = FReservation::getReservationsForTableOnDate($table, $reservation->getDate());

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

            if (!conflict) {
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

        self::uploadObject($reservation);

        return [
            'status' => 'success',
            'message' => "Prenotazione creata con successo.",
            'tables' => array_map(fn($t) => $t->getIdTable(), $assignedTables)
        ];

    }


    


}