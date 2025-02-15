<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that describes the detailed address components of a place.
 *
 * @see   https://developer.apple.com/documentation/applemapsserverapi/structuredaddress
 * @since Apple Maps Server API 1.2+
 */
class StructuredAddress
{
    /**
     * The state or province of the place.
     */
    public string $administrativeArea;

    /**
     * The short code for the state or area.
     */
    public string $administrativeAreaCode;

    /**
     * Common names of the area in which the place resides.
     * @var string[]
     */
    public array  $areasOfInterest;

    /**
     * Common names for the local area or neighborhood of the place.
     * @var string[]
     */
    public array  $dependentLocalities;

    /**
     * A combination of thoroughfare and subthoroughfare.
     */
    public string $fullThoroughfare;

    /**
     * The city of the place.
     */
    public string $locality;

    /**
     * The postal code of the place.
     */
    public string $postCode;

    /**
     * The name of the area within the locality.
     */
    public string $subLocality;

    /**
     * The number on the street at the place.
     */
    public string $subThoroughfare;

    /**
     * The street name at the place.
     */
    public string $thoroughfare;
}