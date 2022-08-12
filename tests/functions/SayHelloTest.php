<?php

namespace functions;

use functions;
use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    public function testPositive()
    {
        $this->assertEquals('Hello', $this->functions->sayHello());
    }
}
