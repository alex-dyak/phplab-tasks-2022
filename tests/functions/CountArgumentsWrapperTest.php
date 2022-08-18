<?php

namespace functions;

use functions;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider incorrectArgumentsTypeDataProvider
     */
    public function testIncorrectArgumentsType($arg, $expected)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->assertEquals($expected, $this->functions->countArgumentsWrapper($arg));
    }

    public function incorrectArgumentsTypeDataProvider(): array
    {
        return [
            [1, new InvalidArgumentException('Arg should be a string')],
            [['Hello', 1], new InvalidArgumentException('Arg should be a string')],
            [['Hello', (object)[1, 2, 3], 'World'], new InvalidArgumentException('Arg should be a string')],
            [new stdClass(), new InvalidArgumentException('Arg should be a string')],
        ];
    }
}
