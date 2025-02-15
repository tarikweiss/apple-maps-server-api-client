<?php

namespace AppleMapsServerApiClient\Dto\Common\DirectionsResponse;

/**
 * An object that represents a step along a route.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/directionsresponse/step
 */
class Step
{
    /**
     * Total distance covered by the step, in meters.
     */
    public int $distanceMeters;

    /**
     * The estimated time to traverse this step, in seconds.
     */
    public int $durationSeconds;

    /**
     * The localized instruction string for this step that you can use for display purposes.
     * You can specify the language to receive the response in using the <code>lang</code> parameter.
     */
    public string $instructions;

    /**
     * A pointer to this step’s path. The pointer is in the form of an index into the <code>stepPaths</code> array contained in a <code>Route</code>.
     * Step paths are self-contained which implies that the last point of a previous step path along a route is the same as the first point of the next step path. Clients are responsible for avoiding duplication when rendering the point.
     */
    public int $stepPathIndex;

    /**
     * A string that indicates the transport type for this step if it’s different from the <code>transportType</code> in the route.
     */
    public TransportType $transportType;
}