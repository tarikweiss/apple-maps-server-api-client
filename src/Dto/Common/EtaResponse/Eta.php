<?php

namespace AppleMapsServerApiClient\Dto\Common\EtaResponse;

use AppleMapsServerApiClient\Dto\Common\Location;

/**
 * An object that contains details about an estimated time of arrival (ETA).
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/etaresponse/eta
 */
class Eta
{
    /**
     * The destination as a {@link Location}.
     */
    public Location      $destination;

    /**
     * The distance in meters to the destination.
     */
    public int           $distanceMeters;

    /**
     * The estimated travel time in seconds, including delays due to traffic.
     */
    public int           $expectedTravelTimeSeconds;

    /**
     * The expected travel time, in seconds, without traffic.
     */
    public int           $staticTravelTimeSeconds;

    /**
     * A string that represents the mode of transportation for this ETA, which is one of:
     * <ul>
     *     <li>Automobile</li>
     *     <li>Transit</li>
     *     <li>Walking</li>
     * </ul>
     */
    public TransportType $transportType;
}