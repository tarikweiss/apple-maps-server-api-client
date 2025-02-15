<?php

namespace AppleMapsServerApiClient\Util;

class ValidationUtil
{
    /**
     * @param mixed[]|null $items
     */
    public static function checkArrayIsNotEmpty(?array $items): bool
    {
        return null !== $items && 0 < count($items);
    }


    public static function checkStringIsNotEmpty(string $string): bool
    {
        $string = trim($string);

        return '' !== $string;
    }
}