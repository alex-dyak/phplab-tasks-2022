<?php

namespace basics;

use InvalidArgumentException;

class BasicsValidator implements BasicsValidatorInterface
{

    /**
     * Is Minutes Exception.
     *
     * @param int $minute
     *
     * @throws InvalidArgumentException
     */
    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 || $minute > 60) {
            throw new InvalidArgumentException('Minutes should be in 0 - 60 range.');
        }

    }

    /**
     * Is Year Exception.
     *
     * @param int $year
     *
     * @throws InvalidArgumentException
     */
    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new InvalidArgumentException('Year should be more than 1900.');
        }
    }

    /**
     * Is Valid String Exception.
     *
     * @param string $input
     *
     * @throws InvalidArgumentException
     */
    public function isValidStringException(string $input): void
    {
        if (strlen($input) <> 6) {
            throw new InvalidArgumentException('String should be exact 6 symbols');
        }
    }
}
