<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * Information about an error that occurs while processing a request.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/errorresponse
 */
class ErrorResponse
{
    /**
     * An array of strings with additional details about the error
     *
     * @var string[]
     */
    public array $details;

    /**
     * A message that provides details about the error.
     */
    public string $message;
}