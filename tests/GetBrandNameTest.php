<?php

use PHPUnit\Framework\TestCase;

class GetBrandNameTest extends TestCase
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
        $this->assertEquals($expected, $this->strings->getBrandName($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['dolphin', 'The Dolphin'],
            ['alaska', 'Alaskalaska'],
            ['europe', 'Europeurope'],
            ['php', 'Phphp'],
            ['the', 'The The'],
        ];
    }
}