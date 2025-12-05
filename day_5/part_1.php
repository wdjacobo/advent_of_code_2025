<?php

$start_time = microtime(true);

$freshRanges = [];
$avIngredients = [];
$freshIngredientesAv = [];
$getRanges = true;
$dbFile = fopen("input.txt", "r");

while (($line = fgets($dbFile)) !== false) {
    $line = trim($line);
    if ($getRanges) {
        if (empty($line)) {
            $getRanges = false;
        } else {
            preg_match("/(\d+)-(\d+)/", $line, $matches);
            $freshRanges[] = [
                "start" => $matches[1],
                "end" => $matches[2],
            ];
        }
    } else {
        $avIngredients[] = $line;
    }
}

foreach ($avIngredients as $ingredient) {
    $isFresh = false;
    foreach ($freshRanges as $range) {
        if (!$isFresh) {
            $isFresh = $range["start"] <= $ingredient && $ingredient <= $range["end"];
        }
    }
    if ($isFresh) {
        $freshIngredientesAv[] = $ingredient;
    }
};

$solution = count($freshIngredientesAv);

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria (1)</title>
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