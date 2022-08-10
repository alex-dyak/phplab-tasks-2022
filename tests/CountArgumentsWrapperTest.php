<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegative($arg, $expected)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->assertEquals($expected, $this->functions->countArgumentsWrapper($arg));
    }

    public function negativeDataProvider(): array
    {
        return [
            [1, new InvalidArgumentException('Arg should be a string')],
            [['Hello', 1], new InvalidArgumentException('Arg should be a string')],
            [['Hello', (object) [1,2,3], 'World'], new InvalidArgumentException('Arg should be a string')],
            [new stdClass(), new InvalidArgumentException('Arg should be a string')],
        ];
    }
}
