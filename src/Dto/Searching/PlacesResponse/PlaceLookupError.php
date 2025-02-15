<?php

namespace AppleMapsServerApiClient\Dto\Searching\PlacesResponse;

/**
 * An error associated with a lookup call.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/placesresponse/placelookuperror
 */
class PlaceLookupError
{
    /**
     * An error code that indicates whether an Place ID is invalid because it’s malformed, not found, or resulted in any other error.
     */
    public ErrorCode $errorCode;

    /**
     * The Place ID.
     */
    public string $id;
}