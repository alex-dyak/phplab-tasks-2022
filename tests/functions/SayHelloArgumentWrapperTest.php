<?php

namespace functions;

use functions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider incorrectArgumentTypeDataProvider
     */
    public function testIncorrectArgumentType($arg, $expected)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->assertEquals($expected,$this->functions->sayHelloArgumentWrapper($arg));
    }

    public function incorrectArgumentTypeDataProvider(): array
    {
        return [
            [[1,2,3], new InvalidArgumentException('Arg should be: number, string or bool')],
            [(object) [1,2,3], new InvalidArgumentException('Arg should be: number, string or bool')],
            [new stdClass(), new InvalidArgumentException('Arg should be: number, string or bool')],
        ];
    }
}
