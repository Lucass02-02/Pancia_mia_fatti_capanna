<?php

namespace AppORM\Services\Foundation;

use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\ETurn;
use AppORM\Entity\DayOfWeek;

class FTurn {


    // ho dovuto mettere i time->format perche essendo solo data hanno un anno di default e quindi la data di $time cioe della
    // prenotazione non corrisponde a quella del turno, quindi non si confrontano correttamente, quindi ho uguagliato le date
    // e ho potuto fare un confronto solo sugli orari corretto
    public static function determineTurnByTime(array $turns, $time) {
        

        $inputTimeStr = $time->format('H:i:s');
        

        foreach ($turns as $turn) {
            $startTimeStr = $turn->getStartTime()->format('H:i:s');
            $endTimeStr = $turn->getEndTime()->format('H:i:s');

            if ($inputTimeStr >= $startTimeStr && $inputTimeStr <= $endTimeStr) {
                return $turn;
            }
        }
        return null; // No matching turn found
    }

    public static function getTurnByDayOfTheWeek(DayOfWeek $dayOfWeek) {
        $results = FEntityManager::getInstance()->retriveObjectList(ETurn::getEntity(), 'dayOfWeek', $dayOfWeek);
        return $results;
    }
}