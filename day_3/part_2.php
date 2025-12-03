<?php

$start_time = microtime(true);

define("BATTERIES_NEEDED", 12);

$joltages = [];
$banksFile = fopen("input.txt", "r");

while (($bank = fgets($banksFile)) !== false) {
    $joltage = "";
    $searchingDigit = 9;
    $batteriesTurned = 0;
    preg_match("/\d+/", $bank, $matches);
    $bank = $matches[0];

    while ($batteriesTurned < BATTERIES_NEEDED) {
        $limit = BATTERIES_NEEDED - $batteriesTurned - 1;

        if (preg_match("/" . preg_quote($searchingDigit) . "[\d]{" . preg_quote($limit) . "}/", $bank)) {

            $batteriesTurned++;
            $joltage .= $searchingDigit;

            preg_match("/" . preg_quote($searchingDigit) . "([\d]*)/", $bank, $matches);
            $bank = $matches[1];

            $searchingDigit = 9;
        } else {
            $searchingDigit--;
        }
    }

    $joltages[] = intval($joltage);
}

$solution = array_sum($joltages);

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby (2)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .solution {
            font-size: xx-large;
        }
    </style>
</head>

<body>
    <p class="solution mt-3 ms-3"><?= "The solution is: $solution"; ?></p>
    <p class="mt-3 ms-3"><?= "Script Execution Time = $execution_time sec"; ?></p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>