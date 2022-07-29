<?php

use PHPUnit\Framework\TestCase;

class RepeatArrayValuesTest extends TestCase
{
    protected $arrays;

    protected function setUp(): void
    {
        $this->arrays = new arrays\Arrays();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->arrays->repeatArrayValues($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [[], []],
            [[1, 2], [1, 2, 2]],
            [[3, 1, 2], [3, 3, 3, 1, 2, 2]],
            [[4], [4, 4, 4, 4]],
        ];
    }
}