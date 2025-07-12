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
    case SUNDAY = 0;

    
    public static function fromDate(DateTime $date): self {
        $w = (int) $date->format('w'); 
        return match ($w) {
        //return match ((int) $date->format('W')) {
            
            0 => self::SUNDAY,
            1 => self::MONDAY,
            2 => self::TUESDAY,
            3 => self::WEDNESDAY,
            4 => self::THURSDAY,
            5 => self::FRIDAY,
            6 => self::SATURDAY,
            default => throw new \InvalidArgumentException("Invalid day of the week"),
        };
    }
}