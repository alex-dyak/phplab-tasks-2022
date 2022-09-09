<?php
/**
 * Connect to DB
 */
/** @var \PDO $pdo */
require_once './pdo_ini.php';

/**
 * SELECT the list of unique first letters using https://www.w3resource.com/mysql/string-functions/mysql-left-function.php
 * and https://www.w3resource.com/sql/select-statement/queries-with-distinct.php
 * and set the result to $uniqueFirstLetters variable
 */
function getUniqueFirstLetters($pdo): array
{
    $first_letters = [];

    $sth = $pdo->prepare('SELECT DISTINCT LEFT(name, 1) as letter FROM cities ORDER BY letter');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();

    foreach ($sth as $row) {
        $first_letters[] = $row['letter'];
    }

    return $first_letters;
}
$uniqueFirstLetters = getUniqueFirstLetters($pdo);

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 *
 * For filtering by first_letter use LIKE 'A%' in WHERE statement
 * For filtering by state you will need to JOIN states table and check if states.name = A
 * where A - requested filter value
 */

$first_letter = filter_input(INPUT_GET, 'filter_by_first_letter');
$state = filter_input(INPUT_GET, 'filter_by_state');

// For unfiltered pages airports per page is 20. For filtered is 5.
$limit = (!$first_letter && !$state) ? 20 : 5;

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 *
 * For sorting use ORDER BY A
 * where A - requested filter value
 */

// Unset 'sort' GET params to build correct query string for filtering and sorting.
$sort_column = filter_input(INPUT_GET, 'sort');
if ($sort_column) {
    unset($_GET['sort']);
}

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 *
 * For pagination use LIMIT
 * To get the number of all airports matched by filter use COUNT(*) in the SELECT statement with all filters applied
 */

// Unset 'page' GET params to build correct query string for filtering and sorting.
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
if ($page) {
    unset($_GET['page']);
}

// Build query string without page number and without sort.
$query_string = http_build_query($_GET);

/**
 * Build a SELECT query to DB with all filters / sorting / pagination
 * and set the result to $airports variable
 *
 * For city_name and state_name fields you can use alias https://www.mysqltutorial.org/mysql-alias/
 */

$airports = [];
$air_num = 0;
$offset = $page ? ($page - 1) * $limit : 0;

// Get state id.
if ($state) {
    $sql_state = "SELECT id FROM states WHERE name=:state";
    $st = $pdo->prepare($sql_state);
    $st->bindParam(':state', $state, \PDO::PARAM_STR);
    $st->execute();
    $result = $st->fetch();
    $state_id = $result['id'];
}

// Airports number query.
$sql_num = "SELECT COUNT(id) AS 'num' FROM airports AS a ";
// Airports per page query.
$sql = "SELECT a.id, a.name, a.code, c.name AS city, s.name AS state, a.address, a.timezone 
FROM airports AS a 
    JOIN cities AS c ON a.city_id = c.id 
    JOIN states AS s ON a.state_id = s.id ";
if ($first_letter){
    $letter_pattern = $first_letter . '%';
    $sql_num .= "WHERE a.name LIKE :letter_pattern ";
    $sql     .= "WHERE a.name LIKE :letter_pattern ";
}
if ($state) {
    $connector = $first_letter ? 'AND' : 'WHERE';
    $sql_num   .= $connector." state_id = :state_id ";
    $sql       .= $connector." state_id = :state_id ";
}

$sql .= "ORDER BY a.id ";
$sql .= "LIMIT :limit OFFSET :offset;";


$st = $pdo->prepare($sql_num);
if ($first_letter) {
    $st->bindParam(':letter_pattern', $letter_pattern, \PDO::PARAM_STR);
}
if ($state) {
    $st->bindParam(':state_id', $state_id, \PDO::PARAM_STR);
}
// Get airports number.
$st->execute();
$result = $st->fetch();
$air_num = $result['num'];
// Get airports per page.
$sth = $pdo->prepare($sql);
$sth->bindParam(':limit', $limit, \PDO::PARAM_INT);
$sth->bindParam(':offset', $offset, \PDO::PARAM_INT);
if ($first_letter) {
    $sth->bindParam(':letter_pattern', $letter_pattern, \PDO::PARAM_STR);
}
if ($state) {
    $sth->bindParam(':state_id', $state_id, \PDO::PARAM_STR);
}

$sth->setFetchMode(\PDO::FETCH_ASSOC);
$sth->execute();

foreach ($sth as $row) {
    $airports[] = $row;
}

$page_num = ceil($air_num / $limit);

/**
 * Sort Airports on the page.
 *
 * @param $airports
 * @param $sort_column
 * @param $page
 * @param $offset
 *
 * @return array
 */
function sortAirportsOnPage($airports, $sort_column): array
{
    // Get values by column name.
    $sort_column_values = array_column($airports, $sort_column);
    array_multisort($sort_column_values, SORT_ASC, $airports);
    // Set new keys for items for replacing in $airports.
    $airports_sorted = [];
    foreach ($airports as $key => $air) {
        $airports_sorted[] = $air;
    }

    return $airports_sorted;
}
if ($sort_column) {
    $airports = sortAirportsOnPage($airports, $sort_column);
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

        <?php foreach ($uniqueFirstLetters as $letter): ?>
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
        <?php
        $page_param = $page ? 'page=' . $page . '&' : '';
        $href = $query_string ? $_SERVER['SCRIPT_NAME'] . '?' . $page_param . $query_string . '&sort=' : $_SERVER['SCRIPT_NAME'] . '?' . $page_param . 'sort=';
        ?>
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
