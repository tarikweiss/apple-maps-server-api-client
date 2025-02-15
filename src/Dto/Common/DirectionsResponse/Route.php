<?php

namespace AppleMapsServerApiClient\Dto\Common\DirectionsResponse;

/**
 * An object that represent the components of a single route.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/directionsresponse/route
 */
class Route
{
    /**
     * Total distance that the route covers, in meters.
     */
    public int $distanceMeters;

    /**
     * The estimated time to traverse this route in seconds. If you’ve specified a <code>departureDate</code> or <code>arrivalDate</code>, then the estimated time includes traffic conditions assuming user departs or arrives at that time. If you set neither <code>departureDate</code> or <code>arrivalDate</code>, then estimated time represents current traffic conditions assuming user departs “now” from the point of origin.
     */
    public int $durationSeconds;

    /**
     * When <code>true</code>, this route has tolls; if <code>false</code>, this route has no tolls. If the value isn’t defined (“undefined”), the route may or may not have tolls.
     */
    public bool $hasTolls;

    /**
     * The route name that you can use for display purposes.
     */
    public string $name;

    /**
     * An array of integer values that you can use to determine the number steps along this route. Each value in the array corresponds to an index into the <code>steps</code> array.
     *
     * @var int[]
     */
    public array $stepIndexes;

    /**
     * A string that represents the mode of transportation the service used to estimate the arrival time. Same as the input query param <code>transportType</code> or <code>Automobile</code> if the input query didn’t specify a transportation type.
     */
    public TransportType $transportType;
}