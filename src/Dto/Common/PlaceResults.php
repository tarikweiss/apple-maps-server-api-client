<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that contains an array of places.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/placeresults
 */
class PlaceResults
{
    /**
     * @var Place[]
     */
    public array $results;
}