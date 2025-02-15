<?php

namespace AppleMapsServerApiClient\Tests\Auth;

use AppleMapsServerApiClient\Auth\InterimTokenSource;
use AppleMapsServerApiClient\Exception\Token\InterimTokenMalformedException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(InterimTokenSource::class)]
class InterimTokenSourceTest extends TestCase
{
    public static function interimTokenSourceChecksDataProvider(): array
    {
        return [
            'Complete non sense value'           => [
                'malformedToken',
                true,
            ],
            'Try to form string with 3 segments' => [
                'three.segments.check',
                true,
            ],
            'More than 3 dot seperated segments' => [
                'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9',
                true,
            ],
            'Correct key'                        => [
                'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c',
                false,
            ],
            'Base encoding broken'               => [
                'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWasIjoxNTE2MjM5MDIyfd.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5d',
                true,
            ],
        ];
    }


    #[DataProvider('interimTokenSourceChecksDataProvider')]
    public function testInterimTokenSourceChecks(string $token, bool $malformed): void
    {
        if (true === $malformed) {
            $this->expectException(InterimTokenMalformedException::class);
        }

        $result = new InterimTokenSource($token);

        $this->assertSame($token, $result->toJwt());
    }
}