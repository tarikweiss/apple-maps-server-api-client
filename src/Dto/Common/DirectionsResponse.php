<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Dto\Common\DirectionsResponse\Route;
use AppleMapsServerApiClient\Dto\Common\DirectionsResponse\Step;
use AppleMapsServerApiClient\Dto\Common\SearchResponse\Place;

/**
 * An object that describes the directions from a starting location to a destination in terms routes, steps, and a series of waypoints.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/directionsresponse
 */
class DirectionsResponse
{
    /**
     * A {@link Place} object that describes the destination.
     */
    public Place $destination;

    /**
     * A {@link Place} result that describes the origin.
     */
    public Place $origin;

    /**
     * An array of routes. Each route references steps based on indexes into the steps array.
     *
     * @var Route[]
     */
    public array $routes;

    /**
     * An array of step paths across all steps across all routes. Each step path is a single polyline represented as an array of points. You reference the step paths by index into the array.
     *
     * @var Location[]
     */
    public array $stepPaths;

    /**
     * An array of all steps across all routes. You reference the route steps by index into this array. Each step in turn references its path based on indexes into the <code>stepPaths</code> array.
     *
     * @var Step[]
     */
    public array $steps;
}