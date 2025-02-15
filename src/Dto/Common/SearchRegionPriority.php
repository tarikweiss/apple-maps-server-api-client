<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-search
 */
enum SearchRegionPriority: string
{
    case DEFAULT  = 'default';

    case REQUIRED = 'required';
}
