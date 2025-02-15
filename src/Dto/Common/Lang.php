<?php

namespace AppleMapsServerApiClient\Dto\Common;

use AppleMapsServerApiClient\Exception\LanguageMalformedException;
use Stringable;

/**
 * A string that represents a standard tag for identifying languages.
 *
 * @since Apple Maps Server API 1.2+
 * @see   https://developer.apple.com/documentation/applemapsserverapi/lang
 */
class Lang implements Stringable
{
    public const DEFAULT = 'en-US';

    public readonly string $lang;


    /**
     * @throws LanguageMalformedException
     */
    public function __construct(string $countryCode = self::DEFAULT)
    {
        if (!preg_match('/[a-z]{2}-[A-Z]{2}/', $countryCode)) {
            throw new LanguageMalformedException('The given value "' . $countryCode . '" is malformed.');
        }

        $this->lang = $countryCode;
    }


    public function __toString(): string
    {
        return $this->lang;
    }
}