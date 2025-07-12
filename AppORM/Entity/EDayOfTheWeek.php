<?php

namespace AppORM\Entity;

use DateTime;


enum DayOfWeek: int {
    case MONDAY = 0;
    case TUESDAY = 1;
    case WEDNESDAY = 2;
    case THURSDAY = 3;
    case FRIDAY = 4;
    case SATURDAY = 5;
    case SUNDAY = 6;

    
    public static function fromDate(DateTime $date): self {
        $w = (int) $date->format('w'); 
        return match ($w) {
        //return match ((int) $date->format('W')) {
            
            0 => self::MONDAY,
            1 => self::TUESDAY,
            2 => self::WEDNESDAY,
            3 => self::THURSDAY,
            4 => self::FRIDAY,
            5 => self::SATURDAY,
            6 => self::SUNDAY,
            default => throw new \InvalidArgumentException("Invalid day of the week"),
        };
    }
}