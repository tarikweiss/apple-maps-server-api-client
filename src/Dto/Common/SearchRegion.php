<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Exception\LocationMalformedException;
use AppleMapsServerApiClient\Util\LocationUtil;
use Stringable;

/**
 * A string that describes a region to search in terms of its upper-right and lower-left corners as a pair of geographic points.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/searchregion
 */
class SearchRegion implements Stringable
{
    public readonly string $searchRegion;


    /**
     * @throws LocationMalformedException
     */
    public function __construct(
        string $northLatitude,
        string $eastLongitude,
        string $southLatitude,
        string $westLongitude
    )
    {
        if (false === LocationUtil::isLatitude($northLatitude)) {
            throw new LocationMalformedException('The value "' . $northLatitude . '" for the north latitude is malformed.');
        }

        if (false === LocationUtil::isLongitude($eastLongitude)) {
            throw new LocationMalformedException('The value "' . $eastLongitude . '" for the east longitude is malformed.');
        }
        if (false === LocationUtil::isLatitude($southLatitude)) {
            throw new LocationMalformedException('The value "' . $southLatitude . '" for the south latitude is malformed.');
        }

        if (false === LocationUtil::isLongitude($westLongitude)) {
            throw new LocationMalformedException('The value "' . $westLongitude . '" for the west longitude is malformed.');
        }

        $this->searchRegion = $northLatitude . ',' . $eastLongitude . ',' . $southLatitude . ',' . $westLongitude;
    }


    public function __toString(): string
    {
        return $this->searchRegion;
    }
}