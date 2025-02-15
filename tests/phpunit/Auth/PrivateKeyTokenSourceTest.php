<?php

namespace AppleMapsServerApiClient\Tests\Auth;

use AppleMapsServerApiClient\Auth\PrivateKeyTokenSource;
use AppleMapsServerApiClient\Exception\Token\PrivateKeyTokenArgumentMalformedException;
use OpenSSLAsymmetricKey;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(PrivateKeyTokenSource::class)]
class PrivateKeyTokenSourceTest extends TestCase
{
    public static function privateKeyTokenSourceChecksDataProvider(): array
    {
        return [
            'Everything is fine'         => [
                '9JQL5N2RFT',
                'QW7JXPLMNO',
                openssl_pkey_new(),
                1800,
                false,
            ],
            'Key id is wrong'            => [
                '',
                'QW7JXPLMNO',
                openssl_pkey_new(),
                1800,
                true,
            ],
            'Team id is wrong'           => [
                '9JQL5N2RFT',
                '',
                openssl_pkey_new(),
                1800,
                true,
            ],
            'No valid key specified'     => [
                '9JQL5N2RFT',
                'QW7JXPLMNO',
                'Foobar',
                1800,
                true,
            ],
            'Invalid lifetime specified' => [
                '9JQL5N2RFT',
                'QW7JXPLMNO',
                openssl_pkey_new(),
                -256,
                true,
            ],
        ];
    }


    #[DataProvider('privateKeyTokenSourceChecksDataProvider')]
    public function testPrivateKeyTokenSourceChecks(
        string                      $keyId,
        string                      $teamId,
        OpenSSLAsymmetricKey|string $key,
        int                         $lifetimeSeconds,
        bool                        $errorExpected
    ): void
    {
        if (true === $errorExpected) {
            $this->expectException(PrivateKeyTokenArgumentMalformedException::class);
        }

        $source = new \AppleMapsServerApiClient\Auth\PrivateKeyTokenSource($keyId, $teamId, $key, $lifetimeSeconds);

        if (false === $errorExpected) {
            $this->assertIsString($source->toJwt());
        }
    }
}