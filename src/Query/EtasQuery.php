<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\EtaResponse\TransportType;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;
use DateTime;

class EtasQuery
{
    /**
     * The starting point for estimated arrival time requests, specified as a comma-separated string that contains the latitude and longitude. For example, <code>origin=37.331423,-122.030503</code>.
     */
    public string $origin;

    /**
     * Destination coordinates represented as pairs of latitude and longitude separated by a vertical bar character (”|”).
     *
     * For example, <code>destinations=37.32556561130194,-121.94635203581443|37.44176585512703,-122.17259315798667</code>.
     *
     * The parameter must specify at least one destination coordinate, but no more than 10 destinations. Specify the location as a comma-separated string that contains the latitude and longitude.
     *
     * @var SearchLocation[]
     */
    public array $destination;

    /**
     * The mode of transportation to use when estimating arrival times.
     */
    public ?TransportType $transportType = null;

    /**
     * The time of departure to use in an estimated arrival time request, in ISO 8601 format in UTC time.
     *
     * For example, <code>departureDate=2020-09-15T16:42:00Z</code>.
     *
     * If you don’t specify a departure date, the server uses the current date and time when you make the request.
     */
    public ?DateTime $departureDate = null;

    /**
     * The intended time of arrival in ISO 8601 format in UTC time.
     */
    public ?DateTime $arrivalDate = null;


    /**
     * @param SearchLocation[] $destination
     *
     * @throws ValuesEmptyException
     */
    public function __construct(string $origin, array $destination)
    {
        if (false === ValidationUtil::checkStringIsNotEmpty($origin)) {
            throw new ValuesEmptyException('Query parameter "origin" is malformed (it must not be empty).');
        }

        if (0 === count($destination)) {
            throw new ValuesEmptyException('Query parameter "destination" is malformed (it must not be empty).');
        }

        $this->origin      = $origin;
        $this->destination = $destination;
    }
}