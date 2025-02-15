<?php

namespace AppleMapsServerApiClient\Dto\Searching;

use AppleMapsServerApiClient\Dto\Common\Place;
use AppleMapsServerApiClient\Dto\Searching\PlacesResponse\PlaceLookupError;

/**
 * A list of Place IDs and errors.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/placesresponse
 */
class PlacesResponse
{
    /**
     * A list of {@link PlaceLookupError} results.
     *
     * @var PlaceLookupError[]
     */
    public array $errors;

    /**
     * A list of {@link Place} results.
     *
     * @var Place[]
     */
    public array $results;
}