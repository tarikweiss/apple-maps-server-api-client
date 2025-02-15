<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * An object that contains an access token and an expiration time in seconds.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/tokenresponse
 */
class TokenResponse
{
    /**
     * A string that represents the access token.
     */
    public string $accessToken;

    /**
     * An integer that indicates the time, in seconds from now until the token expires.
     */
    public int $expiresInSeconds;
}