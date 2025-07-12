<?php

namespace AppORM\Entity;

use DateTime;


enum DayOfWeek: int {
    case MONDAY = 1;
    case TUESDAY = 2;
    case WEDNESDAY = 3;
    case THURSDAY = 4;
    case FRIDAY = 5;
    case SATURDAY = 6;
    case SUNDAY = 7;

    
    public static function fromDate(DateTime $date): self {
        $w = (int) $date->format('N'); 
        return match ($w) {
        //return match ((int) $date->format('W')) {
            
            1 => self::MONDAY,
            2 => self::TUESDAY,
            3 => self::WEDNESDAY,
            4 => self::THURSDAY,
            5 => self::FRIDAY,
            6 => self::SATURDAY,
            7 => self::SUNDAY,
            default => throw new \InvalidArgumentException("Invalid day of the week"),
        };
    }
}