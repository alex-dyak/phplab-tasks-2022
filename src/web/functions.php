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
function getUniqueFirstLetters(array $airports): array
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

/**
 * Filter Airports.
 *
 * @param $airports
 * @param $letter
 * @param $state
 *
 * @return array
 */
function filterAirports($airports, $letter, $state): array
{
    $filtered_airports = [];
    foreach ($airports as $airport) {
        if (substr($airport['name'], 0, 1) === $letter) {
            $filtered_airports[] = $airport;
        }
        if ($airport['state'] === $state) {
            $filtered_airports[] = $airport;
        }
    }

    return $filtered_airports;
}

/**
 * Sort Airports.
 *
 * @param $airports
 * @param $sort_column
 * @param $page
 * @param $offset
 *
 * @return array
 */
function sortAirports($airports, $sort_column, $page, $offset): array
{
    $sort_airports = getAirportsPerPage($airports, $offset, $page);
    // Get values by column name.
    $sort_column_values = array_column($sort_airports, $sort_column);
    array_multisort($sort_column_values, SORT_ASC, $sort_airports);
    // Set new keys for items for replacing in $airports.
    $airports_on_page = [];
    foreach ($sort_airports as $key => $air) {
        $new_key = $page > 1 ? $offset * ($page - 1) + $key : $key;
        $airports_on_page[$new_key] = $air;
    }

    return array_replace($airports, $airports_on_page);
}

/**
 * Get Airports function.
 * Getting part of $airports array to use it in sort and pagination.
 *
 * @param $airports
 * @param $offset
 * @param $page
 *
 * @return array
 */
function getAirportsPerPage ($airports, $offset, $page): array
{
    if (!$page) {
        $airports = array_slice($airports, 0, $offset);
    } else {
        $airports = array_slice($airports, ($page - 1) * $offset, $offset);
    }

    return $airports;
}
