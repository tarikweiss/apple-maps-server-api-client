<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that describes a place in terms of a variety of spatial, administrative, and qualitative properties.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/place
 */
class Place
{
    /**
     * The country or region of the place.
     */
    public string $country;

    /**
     * The 2-letter country code of the place.
     */
    public string $countryCode;

    /**
     * The geographic region associated with the place.
     * This is a rectangular region on a map expressed as south-west and north-east points. Specifically south latitude, west longitude, north latitude, and east longitude.
     */
    public MapRegion $displayMapRegion;

    /**
     * The address of the place, formatted using its conventions of its country or region.
     *
     * @var string[]
     */
    public array $formattedAddressLines;

    /**
     * A place name that you can use for display purposes.
     */
    public string $name;

    /**
     * The latitude and longitude of this place.
     */
    public Location $coordinate;

    /**
     * A {@link StructuredAddress} object that describes details of the place’s address.
     */
    public StructuredAddress $structuredAddress;

    /**
     * A list of alternate Place IDs for the id.
     *
     * @var string[]
     */
    public array $alternateIds;

    /**
     * An opaque string that identifies a place.
     */
    public string $id;
}