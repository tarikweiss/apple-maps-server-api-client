<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\AddressCategory;
use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\PoiCategory;
use AppleMapsServerApiClient\Dto\Common\SearchACResultType;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Dto\Common\SearchRegion;
use AppleMapsServerApiClient\Dto\Common\SearchRegionPriority;
use AppleMapsServerApiClient\Dto\Common\UserLocation;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-searchautocomplete
 */
class SearchAutocompleteQuery
{
    /**
     * The query to autocomplete. For example, <code>q=eiffel</code>.
     */
    public string $q;

    /**
     * A comma-separated list of strings that describes the points of interest to exclude from the search results. For example, <code>excludePoiCategories=Restaurant,Cafe</code>.
     *
     * See {@PoiCategory} for a complete list of possible values.
     *
     * @var PoiCategory[]
     */
    public ?array $excludePoiCategories = null;

    /**
     * A comma-separated list of strings that describes the points of interest to include in the search results. For example, <code>includePoiCategories=Restaurant,Cafe</code>.
     *
     * See {@linkPoiCategory} for a complete list of possible values.
     *
     * @var PoiCategory[]
     */
    public ?array $includePoiCategories = null;

    /**
     * The language the server uses when returning the response, specified using a BCP 47 language code. For example, for English, use <code>lang=en-US</code>.
     */
    public ?Lang $lang = null;

    /**
     * A comma-separated list of two-letter ISO 3166-1 codes of the countries to limit the results to. For example, <code>limitToCountries=US,CA</code> limits the search to the United States and Canada.
     *
     * If you specify two or more countries, the results reflect the best available results for some or all of the countries rather than everything related to the query for those countries.
     *
     * @var string[]
     */
    public ?array $limitToCountries = null;

    /**
     * A comma-separated list of strings that describes the kind of result types to include in the response. For example, <code>resultTypeFilter=Poi</code>.
     *
     * @var SearchACResultType[]
     */
    public ?array $resultTypeFilter = null;

    /**
     * A location the app defines as a hint. Specify the location as a comma-separated string containing the latitude and longitude. For example, <code>searchLocation=37.78,-122.42</code>.
     *
     * If you don’t provide a <code>searchLocation</code>, the server uses <code>userLocation</code> and <code>searchRegion</code> as fallback hints.
     */
    public ?SearchLocation $searchLocation = null;

    /**
     * A region the app defines as a hint for the search. Specify the region as a comma-separated string that describes the region in the form of a north-latitude, east-longitude, south-latitude, west-longitude string. If you don’t provide <code>searchLocation</code>, the server uses <code>userLocation</code> and <code>searchRegion</code> as fallback hints. For example, <code>searchRegion=38,-122.1,37.5,-122.5</code>.
     */
    public ?SearchRegion $searchRegion = null;

    /**
     * The location of the user, specified as a comma-separated string that contains the latitude and longitude. For example, <code>userLocation=37.78,-122.42</code>.
     *
     * Certain APIs, such as Search, may opt to use the <code>userLocation</code>, if specified, as a fallback for the <code>searchLocation</code>.
     */
    public ?UserLocation $userLocation = null;

    /**
     * A value that indicates the importance of the configured region.
     */
    public ?SearchRegionPriority $searchRegionPriority = null;

    /**
     * A comma-separated list of strings that describes the addresses to include in the search results. For example, <code>includeAddressCategories=SubLocality,PostalCode</code>. If you use this parameter, you must include <code>address</code> in resultTypeFilter.
     * See {@link AddressCategory} for a complete list of possible values.
     *
     * @var AddressCategory[]
     */
    public ?array $includeAddressCategories = null;

    /**
     * A comma-separated list of strings that describes the addresses to exclude in the search results. For example, <code>excludeAddressCategories=Country,AdministrativeArea</code>. If you use this parameter, you must include <code>address</code> in <code>resultTypeFilter</code>.
     * See {@link AddressCategory} for a complete list of possible values.
     *
     * @var AddressCategory[]
     */
    public ?array $excludeAddressCategories = null;


    /**
     * @throws ValuesEmptyException
     */
    public function __construct(string $q)
    {
        if (false === ValidationUtil::checkStringIsNotEmpty($q)) {
            throw new ValuesEmptyException('Query parameter "q" is malformed (it must not be empty).');
        }

        $this->q = $q;
    }
}