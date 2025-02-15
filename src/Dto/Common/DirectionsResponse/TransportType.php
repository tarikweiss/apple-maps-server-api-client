<?php

namespace AppleMapsServerApiClient\Dto\Common\DirectionsResponse;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/directionsresponse/route
 * @see https://developer.apple.com/documentation/applemapsserverapi/directionsresponse/step
 */
enum TransportType: string
{
    case AUTOMOBILE = 'Automobile';

    case WALKING    = 'Walking';
}
