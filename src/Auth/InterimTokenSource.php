<?php

namespace AppleMapsServerApiClient\Auth;

use AppleMapsServerApiClient\Exception\Token\InterimTokenMalformedException;
use stdClass;

/**
 * Object to directly store a maps token. This token is only 7 days valid and therefore should be used for testing purposes only.
 *
 * @see https://developer.apple.com/account/resources/services/maps-tokens
 */
class InterimTokenSource implements TokenSource
{
    /**
     * @throws InterimTokenMalformedException
     */
    public function __construct(
        protected readonly string $interimToken
    )
    {
        $splitValues = explode('.', $this->interimToken);

        if (3 !== count($splitValues)) {
            throw new InterimTokenMalformedException('The interim token is malformed and cannot be decoded.');
        }

        [$header, $payload, $signature] = $splitValues;

        $decodedHeader = json_decode(base64_decode($header));

        if (false === $decodedHeader instanceof stdClass) {
            throw new InterimTokenMalformedException('The interim token is malformed and cannot be decoded.');
        }

        $decodedPayload = json_decode(base64_decode($payload));

        if (false === $decodedPayload instanceof stdClass) {
            throw new InterimTokenMalformedException('The interim token is malformed and cannot be decoded.');
        }
    }


    public function toJwt(): string
    {
        return $this->interimToken;
    }
}