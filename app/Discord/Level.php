<?php

namespace App\Discord;

class Level
{
    private static $a = 5;
    private static $b = 50;
    private static $c = 100;

    public static function getLevelXp($level)
    {
        return (self::$a * pow($level, 2)) + (self::$b * $level) + self::$c;
    }

    public static function getLevelFromXp($xp)
    {
        if (pow(self::$b, 2) - ((4 * self::$a) * (self::$c - $xp)) < 0) {
            return 0;
        }

        $x = (-self::$b + sqrt(pow(self::$b, 2) - ((4 * self::$a) * (self::$c - $xp)))) / (2 * self::$a);
        
        return $x < 0 ? 0 : floor($x);
    }
}
