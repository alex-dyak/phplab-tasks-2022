<?php

namespace basics;

use InvalidArgumentException;

class Basics implements BasicsInterface
{

    private BasicsValidator $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * Get Minute Quarter.
     *
     * @param int $minute
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        if (0 < $minute && $minute <= 15) {
            return 'first';
        } elseif (15 < $minute && $minute <= 30) {
            return 'second';
        } elseif (30 < $minute && $minute <= 45) {
            return 'third';
        } else {
            return 'fourth';
        }
    }

    /**
     * Is Leap Year.
     *
     * @param int $year
     *
     * @return boolean
     *
     * @throws InvalidArgumentException
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        $leap = date('L', mktime(0, 0, 0, 1, 1, $year));

        return (bool)$leap;
    }

    /**
     * Is Sum Equal.
     *
     * @param string $input
     *
     * @return boolean
     *
     * @throws InvalidArgumentException
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $array_numbers = str_split($input, 3);

        $sum_1 = array_sum(str_split($array_numbers[0]));
        $sum_2 = array_sum(str_split($array_numbers[1]));

        return $sum_1 == $sum_2;

    }
}
