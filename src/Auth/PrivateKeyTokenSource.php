<?php

namespace AppleMapsServerApiClient\Auth;

use AppleMapsServerApiClient\Exception\Token\PrivateKeyTokenArgumentMalformedException;
use AppleMapsServerApiClient\Util\ValidationUtil;
use DateInterval;
use DateTime;
use Firebase\JWT\JWT;
use OpenSSLAsymmetricKey;
use OpenSSLCertificate;

/**
 * Object to store essential information to generate a new auth token.
 *
 * @see https://developer.apple.com/documentation/applemapsserverapi/creating-a-maps-identifier-and-a-private-key
 */
class PrivateKeyTokenSource implements TokenSource
{
    /**
     * @param \OpenSSLAsymmetricKey|\OpenSSLCertificate|string $key An OpenSSL key object or the actual private key value as string.
     *
     * @throws PrivateKeyTokenArgumentMalformedException
     */
    public function __construct(
        protected readonly string                                         $keyId,
        protected readonly string                                         $teamId,
        protected readonly OpenSSLAsymmetricKey|OpenSSLCertificate|string $key,
        protected readonly int                                            $lifetimeSeconds = 1800
    )
    {
        if (false === ValidationUtil::checkStringIsNotEmpty($this->keyId)) {
            throw new PrivateKeyTokenArgumentMalformedException('The key id must not be null. You find the key id next to the key, you previously generated, in the Apple Developer Account.');
        }

        if (false === ValidationUtil::checkStringIsNotEmpty($this->teamId)) {
            throw new PrivateKeyTokenArgumentMalformedException('The team id must not be null. You find the team id in the upper corner, next to your name, in the Apple Developer Account.');
        }

        if (false === openssl_pkey_get_private($key)) {
            throw new PrivateKeyTokenArgumentMalformedException('The given key is seemingly not a key. Check the value, if it is empty or malformed.');
        }

        if (0 >= $this->lifetimeSeconds) {
            throw new PrivateKeyTokenArgumentMalformedException('The lifetime of the token is less or equal 0 seconds.');
        }
    }


    public function toJwt(): string
    {
        $payload = [
            'iss' => $this->teamId,
            'iat' => (new DateTime())->format('U'),
            'exp' => (new DateTime())->add(new DateInterval('PT' . $this->lifetimeSeconds . 'S'))->format('U'),
        ];

        return JWT::encode($payload, $this->key, 'ES256', $this->keyId);
    }
}