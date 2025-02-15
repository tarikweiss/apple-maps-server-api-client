<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * A list of the features you can request to avoid when calculating directions.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/directionsavoid
 */
enum DirectionsAvoid: string
{
    case TOLLS = 'tolls';
}
