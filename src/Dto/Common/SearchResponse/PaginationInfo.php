<?php

namespace AppleMapsServerApiClient\Dto\Common\SearchResponse;

/**
 * An object that returns a page of search responses.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchresponse/paginationinfo-data.dictionary
 */
class PaginationInfo
{
    /**
     * An opaque string that the server uses to fetch the next page of search responses.
     */
    public string $nextPageToken;

    /**
     * An opaque string that the server uses to fetch the previous page of search responses.
     */
    public string $prevPageToken;

    /**
     * The total number of pages for the request.
     */
    public int $totalPageCount;

    /**
     * The total number of results for the request.
     */
    public int $totalResults;
}