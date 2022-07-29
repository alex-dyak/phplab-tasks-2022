<?php

use PHPUnit\Framework\TestCase;

class MirrorMultibyteStringTest extends TestCase
{
    protected $strings;

    protected function setUp(): void
    {
        $this->strings = new strings\Strings();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->strings->mirrorMultibyteString($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['ФЫВА олдж', 'АВЫФ ждло'],
            ['ПривеТ Мир', 'ТевирП риМ'],
            ['Я узнал что у меня есть огромная семья', 'Я ланзу отч у янем ьтсе яанморго яьмес'],
            ['ПХП', 'ПХП'],
        ];
    }
}