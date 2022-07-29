<?php
/**
 * Create the Basics Class and implement the BasicsInterface and following methods:
 * getMinuteQuarter(), isLeapYear(), isSumEqual()
 * See details below.
 *
 * Note: Use next namespace for Basics Class - "namespace basics;" (Like in this Interface)
 * About composer autoloading and namespaces you can read here -
 * https://www.phptutorial.net/php-oop/php-composer-autoload/
 *
 * Note: Use aggregation by constructor method to pass the BasicsValidator Class into the Basics Class.
 * (For example, write a BasicsValidator Class Object to the variable using the constructor - $validator and use it in Basics Class methods)
 */

namespace basics;

interface BasicsInterface
{
    /**
     * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
     * Determine in which quarter of an hour the number falls.
     * Return one of the values: "first", "second", "third" and "fourth".
     * Throw InvalidArgumentException if $minute is negative of greater then 60.
     * (Implement this functionality in isMinutesException method from BasicsValidator Class and use it here)
     * @see https://www.php.net/manual/en/class.invalidargumentexception.php
     *
     * Make sure the next PHPDoc instructions will be added or use typehint:
     * @param int $minute
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getMinuteQuarter(int $minute): string;

    /**
     * The $year variable contains a year (i.e. 1995 or 2020 etc).
     * Return true if the year is Leap or false otherwise.
     * Throw InvalidArgumentException if $year is lower then 1900.
     * (Implement this functionality in isYearException method from BasicsValidator Class and use it here)
     * @see https://en.wikipedia.org/wiki/Leap_year
     * @see https://www.php.net/manual/en/class.invalidargumentexception.php
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param int $year
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isLeapYear(int $year): bool;

    /**
     * The $input variable contains a string of six digits (like '123456' or '385934').
     * Return true if the sum of the first three digits is equal with the sum of last three ones
     * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
     * Throw InvalidArgumentException if $input contains more then 6 digits.
     * (Implement this functionality in isValidStringException method from BasicsValidator Class and use it here)
     * @see https://www.php.net/manual/en/class.invalidargumentexception.php
     *
     * Make sure the next PHPDoc instructions will be added:
     * @param string $input
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isSumEqual(string $input): bool;
}