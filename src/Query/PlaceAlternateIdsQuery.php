<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

class PlaceAlternateIdsQuery
{
    /**
     * A list of alternate Place IDs.
     *
     * @var string[]
     */
    public array $ids;


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