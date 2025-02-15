<?php

namespace AppleMapsServerApiClient\Dto\Searching\AlternateIdsResponse;

/**
 * Contains a list of alternate Place IDs for a given Place ID.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/alternateidsresponse/alternateids
 */
class AlternateIds
{
    /**
     * A list of alternate Place IDs for id.
     *
     * @var string[]
     */
    public array $alternateIds;

    /**
     * The Place ID.
     */
    public string $id;
}