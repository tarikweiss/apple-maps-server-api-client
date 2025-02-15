<?php

namespace AppleMapsServerApiClient\Dto\Common;

enum SearchACResultType: string
{
    case POI               = 'poi';

    case ADDRESS           = 'address';

    case PHYSICAL_FEATURE  = 'physicalFeature';

    case POINT_OF_INTEREST = 'pointOfInterest';

    case QUERY             = 'query';
}
