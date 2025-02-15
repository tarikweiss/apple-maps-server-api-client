<?php

namespace AppleMapsServerApiClient\Dto\Common\EtaResponse;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/etaresponse/eta
 */
enum TransportType: string
{
    case AUTOMOBILE = 'Automobile';

    case TRANSIT    = 'Transit';

    case WALKING    = 'Walking';
}
