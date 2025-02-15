<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that contains information you can use to suggest addresses and further refine search results.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/autocompleteresult
 */
class AutocompleteResult
{
    /**
     * The relative URI to the <code>search</code> endpoint to use to fetch more details pertaining to the result. If available, the framework encodes opaque data about the autocomplete result in the completion URL’s <code>metadata</code> parameter.
     * If clients need to fetch the search result in a certain language, they’re responsible for specifying the <code>lang</code> parameter in the request.
     */
    public string $completionUrl;

    /**
     * A JSON string array to use to create a long form of display text for the completion result.
     *
     * @var string[]
     */
    public array $displayLines;

    /**
     * A {@link Location} object that specifies the location of the result in terms of its latitude and longitude.
     */
    public Location $location;

    /**
     * A {@link StructuredAddress} object that describes the detailed address components of a place.
     */
    public StructuredAddress $structuredAddress;
}