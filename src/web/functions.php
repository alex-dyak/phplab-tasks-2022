<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports)
{
    $first_letters = [];

    foreach ($airports as $airport) {
        $name_first_letter = substr($airport['name'], 0, 1);
        if (!in_array($name_first_letter, $first_letters)) {
            $first_letters[] = $name_first_letter;
        }
    }

    sort($first_letters);

    return $first_letters;
}