<?php

namespace AppleMapsServerApiClient\Dto\Common;

/**
 * Search categories related to political geographical boundaries.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/addresscategory
 */
enum AddressCategory: string
{
    case COUNTRY                 = 'Country';

    case ADMINISTRATIVE_AREA     = 'AdministrativeArea';

    case SUB_ADMINISTRATIVE_AREA = 'SubAdministrativeArea';

    case LOCALITY                = 'Locality';

    case SUB_LOCALITY            = 'SubLocality';

    case POSTAL_CODE             = 'PostalCode';
}