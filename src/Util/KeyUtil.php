<?php

namespace AppleMapsServerApiClient\Util;

use AppleMapsServerApiClient\Exception\KeyNotReadableException;
use OpenSSLAsymmetricKey;

class KeyUtil
{
    /**
     * @throws KeyNotReadableException
     */
    public static function getPrivateKeyFromFile(string $filePath, ?string $passphrase = null): OpenSSLAsymmetricKey
    {
        $privateKeyContents = file_get_contents($filePath);

        if (false === $privateKeyContents) {
            throw new KeyNotReadableException('Private key could file could not be read. Please check if the file exists and is readable.');
        }

        $privateKey  = openssl_pkey_get_private(
            $privateKeyContents,
            $passphrase
        );

        if (false === $privateKey) {
            throw new KeyNotReadableException('Private key could not be obtained. Please check if the file exists, is readable and the given passphrase is correct.');
        }

        return $privateKey;
    }
}