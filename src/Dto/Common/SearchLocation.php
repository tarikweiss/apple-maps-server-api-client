<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Exception\LocationMalformedException;
use AppleMapsServerApiClient\Util\LocationUtil;
use Stringable;

/**
 * A string that describes a geographic location in the form of longitude and latitude.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchlocation
 */
class SearchLocation implements Stringable
{
    public readonly string $searchLocation;


    /**
     * @throws LocationMalformedException
     */
    public function __construct(string $latitude, string $longitude)
    {
        if (false === LocationUtil::isLatitude($latitude)) {
            throw new LocationMalformedException('The value "' . $latitude . '" for the latitude is malformed.');
        }

        if (false === LocationUtil::isLongitude($longitude)) {
            throw new LocationMalformedException('The value "' . $longitude . '" for the longitude is malformed.');
        }

        $this->searchLocation = $latitude . ',' . $longitude;
    }


    public function __toString(): string
    {
        return $this->searchLocation;
    }
}