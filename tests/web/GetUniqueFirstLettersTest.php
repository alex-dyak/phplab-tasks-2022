<?php

namespace web;

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider UniqueFirstLettersDataProvider
     */
    public function testUniqueFirstLetters($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function UniqueFirstLettersDataProvider(): array
    {
        return [
            [
                [
                    ["name" => "Albuquerque Sunport International Airport"],
                    ["name" => "Atlanta Hartsfield International Airport"],
                    ["name" => "Piedmont Triad International Airport"],
                    ["name" => "Greenville Spartanburg International Airport"],
                    ["name" => "Westchester County Airport"],
                ],
                ['A', 'G', 'P', 'W'],
            ],
        ];
    }
}
