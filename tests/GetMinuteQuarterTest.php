<?php

use PHPUnit\Framework\TestCase;

class GetMinuteQuarterTest extends TestCase
{
    protected $validator;
    protected $basics;

    protected function setUp(): void
    {
        $this->validator = new basics\BasicsValidator();
        $this->basics = new basics\Basics($this->validator);
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($minute, $expected)
    {
        $this->assertEquals($expected, $this->basics->getMinuteQuarter($minute));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->basics->getMinuteQuarter(75);
    }

    public function positiveDataProvider(): array
    {
        return [
            [1, 'first'],
            [5, 'first'],
            [15, 'first'],
            [16, 'second'],
            [20, 'second'],
            [30, 'second'],
            [31, 'third'],
            [40, 'third'],
            [45, 'third'],
            [46, 'fourth'],
            [50, 'fourth'],
            [0, 'fourth'],
        ];
    }
}