<?php

namespace AppleMapsServerApiClient\Tests\Util;

use AppleMapsServerApiClient\Dto\Common\SearchLocation;
use AppleMapsServerApiClient\Util\MappingUtil;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MappingUtil::class)]
class MappingUtilTest extends TestCase
{
    public static function mapSearchLocationArrayToPipeSeparatedListDataProvider(): array
    {
        return [
            '1st set of locations' => [
                [
                    new SearchLocation(38.897957, -77.036560),
                    new SearchLocation(51.34072233489405, 12.374481823275437),
                    new SearchLocation(51.4189575756217, 12.233204399359263),
                ],
                '38.897957,-77.03656|51.340722334894,12.374481823275|51.418957575622,12.233204399359',
            ],
        ];
    }


    public static function clearEmptyStringValuesDataProvider(): array
    {
        return [
            [
                [
                    'foo' => 'ajpdoifj',
                    'apifjopadf' => 'apsdifjpoiadjsf',
                    'poaijdfasd' => '',
                    'iadsojpoiasdjf' => '      ',
                ],
                [
                    'foo' => 'ajpdoifj',
                    'apifjopadf' => 'apsdifjpoiadjsf',
                ]
            ]
        ];
    }


    public function testEnumToValue()
    {
        $this->assertSame('bar', MappingUtil::enumToValue(DummyEnum::BAR));
        $this->assertSame('foo', MappingUtil::enumToValue(DummyEnum::FOO));
    }


    #[DataProvider('mapSearchLocationArrayToPipeSeparatedListDataProvider')]
    public function testMapSearchLocationArrayToPipeSeparatedList(array $locations, string $expectedOutput)
    {
        $mapped = MappingUtil::mapSearchLocationArrayToPipeSeparatedList($locations);

        $this->assertSame($expectedOutput, $mapped);
    }


    #[DataProvider('clearEmptyStringValuesDataProvider')]
    public function testClearEmptyStringValues(array $given, array $expected)
    {
        $filtered = MappingUtil::clearEmptyStringValues($given);

        $this->assertSame($expected, $filtered);
    }
}

enum DummyEnum: string
{
    case FOO = 'foo';

    case BAR = 'bar';
}
