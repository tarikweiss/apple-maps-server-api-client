<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Dto\Common\EtaResponse\Eta;

/**
 * An object that contains an array of one or more estimated times of arrival (ETAs).
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/etaresponse
 */
class EtaResponse
{
    /**
     * @var Eta[]
     */
    public array $etas;
}