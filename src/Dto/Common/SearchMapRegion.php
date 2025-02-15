<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that describes an area to search in terms of its upper-right and lower-left corners as a pair of geographic points.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchmapregion
 */
class SearchMapRegion
{
    /**
     * A double value that describes the east longitude of the map region.
     */
    public float $eastLongitude;

    /**
     * A double value that describes the north latitude of the map region.
     */
    public float $northLatitude;

    /**
     * A double value that describes the south latitude of the map region.
     */
    public float $southLatitude;

    /**
     * A double value that describes west longitude of the map region.
     */
    public float $westLongitude;
}