<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\AddressCategory;
use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\PoiCategory;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Dto\Common\SearchRegion;
use AppleMapsServerApiClient\Dto\Common\SearchRegionPriority;
use AppleMapsServerApiClient\Dto\Common\SearchResultType;
use AppleMapsServerApiClient\Dto\Common\UserLocation;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-search
 */
class SearchQuery
{
    /**
     * The place to search for. For example, <code>q=eiffel tower</code>.
     */
    public string $q;

    /**
     * A comma-separated list of strings that describes the points of interest to exclude from the search results. For example, <code>excludePoiCategories=Restaurant,Cafe</code>.
     *
     * @var PoiCategory[]|null
     */
    public ?array $excludePoiCategories = null;

    /**
     * A comma-separated list of strings that describes the points of interest to include in the search results. For example, <code>includePoiCategories=Restaurant,Cafe</code>.
     *
     * @var PoiCategory[]|null
     */
    public ?array $includePoiCategories = null;

    /**
     * A comma-separated list of two-letter ISO 3166-1 codes of the countries to limit the results to. For example, <code>limitToCountries=US,CA</code> limits the search to the United States and Canada.
     * If you specify two or more countries, the results reflect the best available results for some or all of the countries rather than everything related to the query for those countries.
     *
     * @var string[]|null
     */
    public ?array $limitToCountries = null;

    /**
     * A comma-separated list of strings that describes the kind of result types to include in the response. For example, <code>resultTypeFilter=Poi</code>.
     *
     * @var SearchResultType[]
     */
    public ?array $resultTypeFilter = null;

    /**
     * The language the server should use when returning the response, specified using a BCP 47 language code. For example, for English use <code>lang=en-US</code>. Defaults to en-US.
     */
    public ?Lang $lang = null;

    /**
     * A location defined by the application as a hint. Specify the location as a comma-separated string containing the latitude and longitude. For example, <code>searchLocation=37.78,-122.42</code>.
     */
    public ?SearchLocation $searchLocation = null;

    /**
     * A region the app defines as a hint. Specify the region specified as a comma-separated string that describes the region in the form north-latitude,east-longitude,south-latitude,west-longitude. For example, <code>searchRegion=38,-122.1,37.5,-122.5</code>s.
     */
    public ?SearchRegion $searchRegion = null;

    /**
     * The location of the user, specified as a comma-separated string that contains the latitude and longitude. For example, <code>userLocation=37.78,-122.42</code>.
     * Search may opt to use the <code>userLocation</code>, if specified, as a fallback for the <code>searchLocation</code>.
     */
    public ?UserLocation $userLocation = null;

    /**
     * A value that indicates the importance of the configured region.
     */
    public ?SearchRegionPriority $searchRegionPriority = null;

    /**
     * A value that tells the server that we expect paginated results.
     */
    public ?bool $enablePagination = null;

    /**
     * A value that indicates which page of results to return.
     */
    public ?string $pageToken = null;

    /**
     * A comma-separated list of strings that describes the addresses to include in the search results. For example, <code>includeAddressCategories=SubLocality,PostalCode</code>. If you use this parameter, you must include <code>address</code> in <code>resultTypeFilter</code>. See {@link AddressCategory} for a complete list of possible values.
     *
     * @var AddressCategory[]|null
     */
    public ?array $includeAddressCategories = null;

    /**
     * A comma-separated list of strings that describes the addresses to exclude in the search results. For example, <code>excludeAddressCategories=Country,AdministrativeArea</code>. If you use this parameter, you must include <code>address</code> in <code>resultTypeFilter</code>. See {@link AddressCategory} for a complete list of possible values.
     *
     * @var AddressCategory[]|null
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