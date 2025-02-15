<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that describes a location in terms of its longitude and latitude.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/location
 */
class Location
{
    /**
     * A double value that describes the latitude of the coordinate.
     */
    public float $latitude;

    /**
     * A double value that describes the longitude of the coordinate.
     */
    public float $longitude;
}