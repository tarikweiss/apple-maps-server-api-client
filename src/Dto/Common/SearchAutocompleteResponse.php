<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An array of autocomplete results.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchautocompleteresponse
 */
class SearchAutocompleteResponse
{
    /**
     * @var AutocompleteResult[]
     */
    public array $results;
}