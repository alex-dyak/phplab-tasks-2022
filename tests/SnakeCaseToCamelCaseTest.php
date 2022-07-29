<?php

use PHPUnit\Framework\TestCase;

class SnakeCaseToCamelCaseTest extends TestCase
{
    protected $strings;

    protected function setUp(): void
    {
        $this->strings = new strings\Strings();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->strings->snakeCaseToCamelCase($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['hello_world', 'helloWorld'],
            ['this_is_home_task', 'thisIsHomeTask'],
            ['string', 'string'],
        ];
    }
}