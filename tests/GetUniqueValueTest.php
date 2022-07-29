<?php

use PHPUnit\Framework\TestCase;

class GetUniqueValueTest extends TestCase
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
        $this->assertEquals($expected, $this->arrays->getUniqueValue($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [[], 0],
            [[1, 2, 3, 2, 1, 5, 6], 3],
            [[1, 1, 2, 3, 3], 2],
            [[1, 1, 2, 2, 3, 3], 0],
        ];
    }
}
