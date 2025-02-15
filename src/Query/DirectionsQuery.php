<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\DirectionsAvoid;
use AppleMapsServerApiClient\Dto\Common\DirectionsResponse\TransportType;
use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Dto\Common\SearchRegion;
use AppleMapsServerApiClient\Dto\Common\UserLocation;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;
use DateTime;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-directions
 */
class DirectionsQuery
{
    /**
     * The starting location as an address, or coordinates you specify as latitude, longitude. For example, <code>origin=37.7857,-122.4011</code>
     */
    public string $origin;

    /**
     * The destination as an address, or coordinates you specify as latitude, longitude. For example, <code>destination=San Francisco City Hall, CA</code>
     */
    public string $destination;

    /**
     * The date and time to arrive at the destination in ISO 8601 format in UTC time. For example, <code>2023-04-15T16:42:00Z</code>.
     *
     * You can specify only <code>arrivalDate</code> or <code>departureDate</code>. If you don’t specify either option, the <code>departureDate</code> defaults to <i>now</i>, which the server interprets as the current time.
     */
    public ?DateTime $arrivalDate = null;

    /**
     * A comma-separated list of the features to avoid when calculating direction routes. For example, <code>avoid=Tolls</code>.
     *
     * See {@link DirectionsAvoid} for a complete list of possible values.
     *
     * @var DirectionsAvoid[]
     */
    public ?array $avoid = null;

    /**
     * The date and time to depart from the origin in ISO 8601 format in UTC time. For example, <code>2023-04-15T16:42:00Z</code>.
     *
     * You can only specify <code>arrivalDate</code> or <code>departureDate</code>. If you don’t specify either option, the <code>departureDate</code> defaults to <i>now</i>, which the server interprets as the current time.
     */
    public ?DateTime $departureDate = null;

    /**
     * The language the server uses when returning the response, specified using a BCP 47 language code. For example, for English, use <code>lang=en-US</code>.
     */
    public ?Lang $lang = null;

    /**
     * When you set this to true, the server returns additional routes, when available. For example, <code>requestsAlternateRoutes=true</code>.
     */
    public ?bool $requestsAlternateRoutes = null;

    /**
     * A searchLocation the app defines as a hint for the query input for <code>origin</code> or <code>destination</code>. Specify the location as a comma-separated string that contains the latitude and longitude. For example, <code>37.7857,-122.4011</code>.
     *
     * If you don’t provide a <code>searchLocation</code>, the server uses <code>userLocation</code> and searchLocation as fallback hints.
     */
    public ?SearchLocation $searchLocation = null;

    /**
     * A region the app defines as a hint for the query input for <code>origin</code> or destination. Specify the region as a comma-separated string that describes the region in the form of a north-latitude, east-longitude, south-latitude, west-longitude string. For example, <code>38,-122.1,37.5,-122.5</code>.
     *
     * If you don’t provide a <code>searchLocation</code>, the server uses <code>userLocation</code> and <code>searchRegion</code> as fallback hints.
     */
    public ?SearchRegion $searchRegion = null;

    /**
     * The mode of transportation the server returns directions for.
     */
    public ?TransportType $transportType = null;

    /**
     * The location of the user, specified as a comma-separated string that contains the latitude and longitude. For example, <code>userLocation=37.78,-122.42</code>.
     *
     * If you don’t provide a <code>searchLocation</code>, the server uses <code>userLocation</code> and <code>searchRegion</code> as fallback hints.
     */
    public ?UserLocation $userLocation = null;


    /**
     * @throws ValuesEmptyException
     */
    public function __construct(string $origin, string $destination)
    {
        if (false === ValidationUtil::checkStringIsNotEmpty($origin)) {
            throw new ValuesEmptyException('Query parameter "origin" is malformed (it must not be empty).');
        }

        if (false === ValidationUtil::checkStringIsNotEmpty($destination)) {
            throw new ValuesEmptyException('Query parameter "destination" is malformed (it must not be empty).');
        }

        $this->origin      = $origin;
        $this->destination = $destination;
    }
}