<?php

namespace AppleMapsServerApiClient\Util;

class LocationUtil
{
    public const MAX_LENGTH = 14;

    public const LATITUDE_REGEX  = '/^(\+|-)?(?:90(?:(?:\.0{1,' . self::MAX_LENGTH . '})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,' . self::MAX_LENGTH . '})?))$/';

    public const LONGITUDE_REGEX = '/^(\+|-)?(?:180(?:(?:\.0{1,' . self::MAX_LENGTH . '})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,' . self::MAX_LENGTH . '})?))$/';


    public static function isLatitude(string $latitude): bool
    {
        if (!preg_match(self::LATITUDE_REGEX, $latitude)) {
            return false;
        }

        return true;
    }


    public static function isLongitude(string $longitude): bool
    {
        if (!preg_match(self::LONGITUDE_REGEX, $longitude)) {
            return false;
        }

        return true;
    }
}