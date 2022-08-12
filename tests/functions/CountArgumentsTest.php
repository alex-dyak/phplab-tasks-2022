<?php

namespace functions;

use functions;
use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider NoArgumentsDataProvider
     */
    public function testNoArguments($arg, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments());
    }

    /**
     * @dataProvider OneStringArgumentDataProvider
     */
    public function testOneStringArgument($arg, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($arg));
    }

    /**
     * @dataProvider TwoStringArgumentsDataProvider
     */
    public function testTwoStringArguments($arg1, $arg2, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments($arg1, $arg2));
    }

    public function NoArgumentsDataProvider(): array
    {
        return [
            ['', ['argument_count' => 0, 'argument_values' => []]]
        ];
    }

    public function OneStringArgumentDataProvider(): array
    {
        return [
            ['Hello', ['argument_count' => 1, 'argument_values' => ['Hello']]]
        ];
    }

    public function TwoStringArgumentsDataProvider(): array
    {
        return [
            ['Hello', 'Jack', ['argument_count' => 2, 'argument_values' => ['Hello', 'Jack']]]
        ];
    }
}
