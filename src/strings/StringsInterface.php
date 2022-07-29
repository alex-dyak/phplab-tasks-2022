<?php
/**
 * Create the Strings Class and implement the StringsInterface and following methods:
 * snakeCaseToCamelCase(), mirrorMultibyteString(), getBrandName()
 * See details below.
 *
 * Note: Use next namespace for Strings Class - "namespace strings;" (Like in this Interface)
 * About composer autoloading and namespaces you can read here -
 * https://www.phptutorial.net/php-oop/php-composer-autoload/
 */

namespace strings;

interface StringsInterface
{
    /**
     * The $input variable contains text in snake case (i.e. hello_world or this_is_home_task)
     * Transform it into camel cased string and return (i.e. helloWorld or thisIsHomeTask)
     * @see http://xahlee.info/comp/camelCase_vs_snake_case.html
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string;

    /**
     * The $input variable contains multibyte text like 'ФЫВА олдж'
     * Mirror each word individually and return transformed text (i.e. 'АВЫФ ждло')
     * !!! do not change words order
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param string $input
     * @return string
     */
    public function mirrorMultibyteString(string $input): string;

    /**
     * My friend wants a new band name for her band.
     * She likes bands that use the formula: 'The' + a noun with first letter capitalized.
     * However, when a noun STARTS and ENDS with the same letter,
     * she likes to repeat the noun twice and connect them together with the first and last letter,
     * combined into one word like so (WITHOUT a 'The' in front):
     * dolphin -> The Dolphin
     * alaska -> Alaskalaska
     * europe -> Europeurope
     * Implement this logic.
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string;

}
