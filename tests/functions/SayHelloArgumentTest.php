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
        $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
    }

    public function correctDataTypeProvider(): array
    {
        $functions = new \functions\Functions();
        $hello = $functions->sayHello();

        return [
            [10, $hello . ' 10'],
            ['Alex', $hello . ' Alex'],
            ['cat', $hello . ' cat'],
            [true, $hello . ' 1'],
            [false, $hello . ' '],
        ];
    }
}
