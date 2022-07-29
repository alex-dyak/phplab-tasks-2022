<?php

use PHPUnit\Framework\TestCase;

class GroupByTagTest extends TestCase
{
    protected $arrays;

    protected function setUp(): void
    {
        $this->arrays = new arrays\Arrays();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->arrays->groupByTag($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
                    ['name' => 'apple', 'tags' => ['fruit', 'green']],
                    ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
                ],
                [
                    'fruit' => ['apple', 'orange'],
                    'green' => ['apple'],
                    'vegetable' => ['potato'],
                    'yellow' => ['orange', 'potato'],
                ]
            ],
            [
                [
                    ['name' => 'Php for the Web: Visual QuickStart Guide', 'tags' => ['php', 'mysql']],
                    ['name' => 'Modern PhP: New Features and Good Practices', 'tags' => ['php']],
                    ['name' => 'Learning php, mysql & JavaScript', 'tags' => ['php', 'mysql', 'javascript']],
                ],
                [
                    'javascript' => [
                        'Learning php, mysql & JavaScript'
                    ],
                    'mysql' => [
                        'Learning php, mysql & JavaScript',
                        'Php for the Web: Visual QuickStart Guide',
                    ],
                    'php' => [
                        'Learning php, mysql & JavaScript',
                        'Modern PhP: New Features and Good Practices',
                        'Php for the Web: Visual QuickStart Guide',
                    ],
                ]
            ],
        ];
    }
}