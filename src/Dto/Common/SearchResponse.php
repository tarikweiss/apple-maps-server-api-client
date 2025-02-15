<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Dto\Common\SearchResponse\PaginationInfo;

/**
 * An object that contains the search region and an array of place descriptions that a search returns.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchresponse
 */
class SearchResponse
{
    /**
     * Represents a rectangular region on a map expressed as south-west and north-east points. More specifically south latitude, west longitude, north latitude and east longitude.
     */
    public SearchMapRegion $displayMapRegion;

    public PaginationInfo  $paginationInfo;

    /**
     * An array of {@link Place} results.
     *
     * @var Place[]
     */
    public array $results;
}