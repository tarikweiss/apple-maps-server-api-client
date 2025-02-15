<?php

namespace AppleMapsServerApiClient\Dto\Common\SearchResponse;

use AppleMapsServerApiClient\Dto\Common\PoiCategory;

/**
 * A structure returned by a search that describes a place.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchresponse/place
 */
class Place
{
    /**
     * A string that describes a specific place of interest (POI) category.
     */
    public PoiCategory $poiCategory;
}