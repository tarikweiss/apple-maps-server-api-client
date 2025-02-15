<?php

namespace AppleMapsServerApiClient\Dto\Searching\PlacesResponse;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/placesresponse/placelookuperror
 */
enum ErrorCode: string
{
    case FAILED_INVALID_ID     = 'FAILED_INVALID_ID';
    case FAILED_NOT_FOUND      = 'FAILED_NOT_FOUND';
    case FAILED_INTERNAL_ERROR = 'FAILED_INTERNAL_ERROR';
}
