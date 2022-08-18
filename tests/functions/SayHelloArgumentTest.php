<?php

namespace functions;

use functions;
use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider correctDataTypeProvider
     */
    public function testCorrectDataType($input, $expected)
    {
        $this->assertEquals('Hello ' . $expected, $this->functions->sayHelloArgument($input));
    }

    public function correctDataTypeProvider(): array
    {
        return [
            [10, '10'],
            ['Alex', 'Alex'],
            ['cat', 'cat'],
            [true, '1'],
            [false, ''],
        ];
    }
}
