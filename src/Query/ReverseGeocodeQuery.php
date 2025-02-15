<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Dto\Common\SearchLocation;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-reversegeocode
 */
class ReverseGeocodeQuery
{
    /**
     * The coordinate to reverse geocode as a comma-separated string that contains the latitude and longitude. For example: <code>loc=37.3316851,-122.0300674</code>.
     */
    public SearchLocation $loc;

    /**
     * The language the server uses when returning the response, specified using a BCP 47 language code. For example, for English, use <code>lang=en-US</code>.
     */
    public ?Lang $lang = null;


    public function __construct(SearchLocation $loc)
    {
        $this->loc = $loc;
    }
}