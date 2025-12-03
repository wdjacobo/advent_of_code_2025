<?php

$start_time = microtime(true);

$joltages = [];
$banksFile = fopen("input.txt", "r");


while (($bank = fgets($banksFile)) !== false) {
    preg_match("/\d+/", $bank, $matches); // preg_split is not working well with the raw input whitespaces
    $bank = $matches[0];
    $digits = preg_split("//", $bank, -1, PREG_SPLIT_NO_EMPTY);
    $maxPos = array_search(max($digits), $digits);
    $max1 = -1;
    $max2 = -1;


    if ($maxPos != (count($digits) - 1)) {
        $max1 = $digits[$maxPos];
        $digits = array_slice($digits, $maxPos + 1);
    } else {
        $max2 = $digits[$maxPos];
        array_splice($digits, $maxPos, 1);
    }

    $maxPos2 = array_search(max($digits), $digits);

    if ($max1 < 0) {
        $max1 = $digits[$maxPos2];
    } else {
        $max2 = $digits[$maxPos2];
    }

    $value = $max1 . $max2;

    $joltages[] = intval($value);
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
    <title>Lobby (1)</title>
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