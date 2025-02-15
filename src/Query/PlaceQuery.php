<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-place
 */
class PlaceQuery
{
    /**
     * A comma separated list of Place IDs.
     *
     * @var string[]
     */
    public array $ids;

    /**
     * The language code for the response.
     */
    public ?Lang $lang = null;


    /**
     * @param string[] $ids
     *
     * @throws ValuesEmptyException
     */
    public function __construct(array $ids)
    {
        if (false === ValidationUtil::checkArrayIsNotEmpty($ids)) {
            throw new ValuesEmptyException('Query parameter "ids" is malformed (it must not be empty).');
        }

        $this->ids = $ids;
    }
}