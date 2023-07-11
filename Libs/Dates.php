<?php

namespace Libs;

use Carbon\Carbon;

class Dates
{
    public static function today()
    {
        return Carbon::now();
    }

    public static function tomorrow()
    {
        return self::today()->addDays(1);
    }

    public static function longDate($date, $language = 'es')
    {
        Carbon::setLocale($language);
        return $date->isoFormat('dddd DD [de] MMMM');
    }

    public static function datesAreDifferent($dateStart, $dateEnd)
    {
        $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $dateStart);
        $dateEnd   = Carbon::createFromFormat('Y-m-d H:i:s', $dateEnd);

        return !$dateStart->equalTo($dateEnd);
    }
}
