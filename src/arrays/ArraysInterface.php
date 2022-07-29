<?php
/**
 * Create the Arrays Class and implement the ArraysInterface and following methods:
 * repeatArrayValues(), getUniqueValue(), groupByTag()
 * See details below.
 *
 * Note: Use next namespace for Arrays Class - "namespace arrays;" (Like in this Interface)
 * About composer autoloading and namespaces you can read here -
 * https://www.phptutorial.net/php-oop/php-composer-autoload/
 */

namespace arrays;

interface ArraysInterface
{
    /**
     * The $input variable contains an array of digits
     * Return an array which will contain the same digits but repetitive by its value
     * without changing the order.
     * Example: [1,3,2] => [1,3,3,3,2,2]
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param array $input
     * @return array
     */
    public function repeatArrayValues(array $input): array;

    /**
     * The $input variable contains an array of digits
     * Return the lowest unique value or 0 if there is no unique values or array is empty.
     * Example: [1, 2, 3, 2, 1, 5, 6] => 3
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param array $input
     * @return int
     */
    public function getUniqueValue(array $input): int;

    /**
     * The $input variable contains an array of arrays
     * Each sub array has keys: name (contains strings), tags (contains array of strings)
     * Return the list of names grouped by tags
     * !!! The 'names' in returned array must be sorted ascending.
     *
     * Example:
     * [
     *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
     *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
     *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
     * ]
     *
     * Should be transformed into:
     * [
     *  'fruit' => ['apple', 'orange'],
     *  'green' => ['apple'],
     *  'vegetable' => ['potato'],
     *  'yellow' => ['orange', 'potato'],
     * ]
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param array $input
     * @return array
     */
    public function groupByTag(array $input): array;

}