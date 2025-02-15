<?php

namespace AppleMapsServerApiClient\Dto\Searching;

use AppleMapsServerApiClient\Dto\Searching\AlternateIdsResponse\AlternateIds;
use AppleMapsServerApiClient\Dto\Searching\PlacesResponse\PlaceLookupError;

/**
 * A list of alternate Place IDs and associated errors.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/alternateidsresponse
 */
class AlternateIdsResponse
{
    /**
     * A list f of {@link PlaceLookupError} results.
     *
     * @var PlaceLookupError[]
     */
    public array $errors;

    /**
     * A list f of {@link AlternateIds} results.
     *
     * @var AlternateIds[]
     */
    public array $results;
}