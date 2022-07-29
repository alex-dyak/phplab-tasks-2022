<?php

use PHPUnit\Framework\TestCase;

class IsSumEqualTest extends TestCase
{
    protected $validator;
    protected $basics;

    protected function setUp(): void
    {
        $this->validator = new basics\BasicsValidator();
        $this->basics = new basics\Basics($this->validator);
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->basics->isSumEqual($input));
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->basics->isSumEqual('1234');
    }

    public function positiveDataProvider()
    {
        return [
            ['123456', false],
            ['385934', true],
            ['456366', true],
            ['789564', false],
        ];
    }
}