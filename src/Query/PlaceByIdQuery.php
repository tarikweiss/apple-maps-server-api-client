<?php

namespace AppleMapsServerApiClient\Query;

use AppleMapsServerApiClient\Dto\Common\Lang;
use AppleMapsServerApiClient\Exception\ValuesEmptyException;
use AppleMapsServerApiClient\Util\ValidationUtil;

/**
 * @see https://developer.apple.com/documentation/applemapsserverapi/-v1-place-:id
 */
class PlaceByIdQuery
{
    /**
     * A single Place ID.
     */
    public string $id;

    /**
     * The language code for the response.
     */
    public ?Lang $lang = null;


    /**
     * @throws ValuesEmptyException
     */
    public function __construct(string $id)
    {
        if (false === ValidationUtil::checkStringIsNotEmpty($id)) {
            throw new ValuesEmptyException('Query parameter "id" is malformed (it must not be empty).');
        }

        $this->id = $id;
    }
}