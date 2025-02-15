<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Dto\Common\SearchRegion;
use AppleMapsServerApiClient\Dto\Common\UserLocation;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-geocode
 */
class GeocodeQuery
{
    /**
     * The address to geocode. For example: <code>q=1 Apple Park, Cupertino, CA</code>
     */
    public string $q;

    /**
     * A comma-separated list of two-letter ISO 3166-1 codes to limit the results to. For example: <code>limitToCountries=US,CA</code>.
     *
     * If you specify two or more countries, the results reflect the best available results for some or all of the countries rather than everything related to the query for those countries.
     *
     * @var string[]
     */
    public ?array $limitToCountries = null;

    /**
     * The language the server should use when returning the response, specified using a BCP 47 language code. For example, for English use <code>lang=en-US</code>.
     */
    public ?Lang $lang = null;

    /**
     * A location defined by the application as a hint. Specify the location as a comma-separated string containing the latitude and longitude. For example, <code>searchLocation=37.78,-122.42</code>.
     */
    public ?SearchLocation $searchLocation = null;

    /**
     * A region the app defines as a hint. Specify the region specified as a comma-separated string that describes the region in the form north-latitude, east-longitude, south-latitude, west-longitude. For example, <code>searchRegion=38,-122.1,37.5,-122.5</code>.
     */
    public ?SearchRegion $searchRegion = null;

    /**
     * The location of the user, specified as a comma-separated string that contains the latitude and longitude. For example: <code>userLocation=37.78,-122.42</code>.
     *
     * Certain APIs, such as Searching, may opt to use the <code>userLocation</code>, if specified, as a fallback for the <code>searchLocation</code>.
     */
    public ?UserLocation $userLocation = null;


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