<?php


use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [10, 'Hello 10'],
            ['Alex', 'Hello Alex'],
            ['cat', 'Hello cat'],
            [true, 'Hello 1'],
            [false, 'Hello '],
        ];
    }
}
