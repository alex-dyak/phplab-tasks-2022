<?php
require_once './functions.php';

$airports = require './airports.php';

// Set query string.
$query_args = [];
$page = 1;
$sort_column = '';
// Unset 'page' and 'sort' GET params to build correct query string for filtering and sorting.
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
if ($page) {
    unset($_GET['page']);
}
$sort_column = filter_input(INPUT_GET, 'sort');
if ($sort_column) {
    unset($_GET['sort']);
}
// Build query string without page number and without sort.
$query_string = http_build_query($_GET);
// For unfiltered pages airports per page is 20. For filtered is 5.
$offset = (!isset($_GET['filter_by_first_letter']) && !isset($_GET['filter_by_state'])) ? 20 : 5;

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */
// Filtering tasks 1.
if (isset($_GET['filter_by_first_letter'])) {
    $temp = [];
    foreach ($airports as $airport) {
        if (substr($airport['name'], 0, 1) === $_GET['filter_by_first_letter']) {
            $temp[] = $airport;
        }
    }
    $airports = $temp;
}
// Filtering tasks 2.
if (isset($_GET['filter_by_state'])) {
    $temp = [];
    foreach ($airports as $airport) {
        if ($airport['state'] === $_GET['filter_by_state']) {
            $temp[] = $airport;
        }
    }
    $airports = $temp;
}
// End Filtering

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */
if ($sort_column) {
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
    $airports = array_replace($airports, $airports_on_page);
}
// End Sorting

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */
$page_num = ceil(count($airports) / $offset);
// Replace $airports per page.
$airports = getAirportsPerPage($airports, $offset, $page);
// End Pagination

/**
 * Get Airports function.
 * Getting part of $airports array to use it in sort and pagination.
 *
 * @param $airports
 * @param $offset
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <?php
            if ($query_string) {
                $href = str_contains($query_string, 'filter_by_first_letter')
                    ? $_SERVER['SCRIPT_NAME'] . '?' . substr_replace($query_string, $letter, -1, 1)
                    : $_SERVER['SCRIPT_NAME'] . '?' . $query_string . '&filter_by_first_letter=' . $letter;
            } else {
                $href = $_SERVER['SCRIPT_NAME'] . '?filter_by_first_letter=' . $letter;
            }
            ?>
            <a href="<?php echo $href ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="<?= $_SERVER['SCRIPT_NAME'] ?>" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <?php $href = $query_string ? $_SERVER['SCRIPT_NAME'] . '?' . $query_string . '&sort=' : $_SERVER['SCRIPT_NAME'] . '?sort='; ?>
        <tr>
            <th scope="col"><a href="<?= $href . 'name' ?>">Name</a></th>
            <th scope="col"><a href="<?= $href . 'code' ?>">Code</a></th>
            <th scope="col"><a href="<?= $href . 'state' ?>">State</a></th>
            <th scope="col"><a href="<?= $href . 'city' ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
        <?php
            if ($query_string) {
                $href = str_contains($query_string, 'filter_by_state')
                    ? $_SERVER['SCRIPT_NAME'] . '?' . $query_string
                    : $_SERVER['SCRIPT_NAME'] . '?filter_by_state=' . $airport['state'] .'&' . $query_string;
            } else {
                $href = $_SERVER['SCRIPT_NAME'] . '?filter_by_state=' . $airport['state'];
            }
            ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="<?php echo $href ?>"><?= $airport['state'] ?></a></td>
            <td><?= $airport['city'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $page_num; $i++) : ?>
                <?php
                $active = ($i == $page) || (!isset($page) && $i == 1) ? 'active' : '';
                if ($query_string) {
                    $href = $_SERVER['SCRIPT_NAME'].'?page='.$i.'&'.$query_string;
                } else {
                    $href = $_SERVER['SCRIPT_NAME'].'?page='.$i;
                }
                ?>
                <li class="page-item <?php echo $active ?>">
                    <a class="page-link" href="<?php echo $href ?>">
                        <?php echo $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

</main>
</html>
