<?php

namespace AppleMapsServerApiClient\Util;

use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use BackedEnum;
use DateTime;

class MappingUtil
{
    public static function enumToValue(BackedEnum $enum): string|int
    {
        return $enum->value;
    }


    /**
     * @param BackedEnum[] $enumArray
     *
     * @return string[]|int[]
     */
    public static function mapEnumArrayToValueArray(array $enumArray): array
    {
        return array_map('\AppleMapsServerApiClient\Util\MappingUtil::enumToValue', $enumArray);
    }


    /**
     * @param BackedEnum[] $enumArray
     */
    public static function mapEnumArrayToCommaSeparatedList(array $enumArray): string
    {
        return implode(',', self::mapEnumArrayToValueArray($enumArray));
    }


    /**
     * @param SearchLocation[] $searchLocations
     */
    public static function mapSearchLocationArrayToPipeSeparatedList(array $searchLocations): string
    {
        return implode('|', array_map(fn(SearchLocation $searchLocation) => $searchLocation->searchLocation, $searchLocations));
    }


    public static function mapDateTimeToISO8601(DateTime $dateTime): string
    {
        return $dateTime->format('c');
    }


    /**
     * @param array<string, string> $data
     *
     * @return array<string, non-empty-string>
     */
    public static function clearEmptyStringValues(array $data): array
    {
        return array_filter($data, fn(string $value) => '' !== trim($value));
    }
}