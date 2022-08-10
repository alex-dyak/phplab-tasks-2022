<?php


use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
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

        $this->assertEquals($expected,$this->functions->sayHelloArgumentWrapper($arg));
    }

    public function negativeDataProvider(): array
    {
        return [
            [[1,2,3], new InvalidArgumentException('Arg should be: number, string or bool')],
            [(object) [1,2,3], new InvalidArgumentException('Arg should be: number, string or bool')],
            [new stdClass(), new InvalidArgumentException('Arg should be: number, string or bool')],
        ];
    }
}
