<?php

$start_time = microtime(true);

define("IS_ROLL", "@");
define("MAX_ADJACENT_ROLLS", 3);

$accesibleRolls = [];
$removedRolls = 0;


function getGridFromFile(string $file): array
{
    $grid = [];
    $gridContent = fopen($file, "r");

    while (($line = fgets($gridContent)) !== false) {
        $line = trim($line);
        $row = preg_split("//", $line);
        $grid[] = $row;
    }

    return $grid;
}


function rollIsAccesible(array $grid, int $row, int $col): bool
{

    $adjacentRolls = 0;

    if (isset($grid[$row - 1][$col]) && $grid[$row - 1][$col] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row - 1][$col + 1]) && $grid[$row - 1][$col + 1] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row][$col + 1]) && $grid[$row][$col + 1] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row + 1][$col + 1]) && $grid[$row + 1][$col + 1] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row + 1][$col]) && $grid[$row + 1][$col] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row + 1][$col - 1]) && $grid[$row + 1][$col - 1] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row][$col - 1]) && $grid[$row][$col - 1] === IS_ROLL) {
        $adjacentRolls++;
    }
    if (isset($grid[$row - 1][$col - 1]) && $grid[$row - 1][$col - 1] === IS_ROLL) {
        $adjacentRolls++;
    }

    if ($adjacentRolls <= MAX_ADJACENT_ROLLS) {
        return true;
    } else {
        return false;
    }
}


function getAccesibleRollsPositions(array $grid): array
{

    $cols = count($grid[1]);
    $rows = count($grid);
    $accesibleRollsPos = [];

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            if ($grid[$i][$j] === IS_ROLL) {
                if (rollIsAccesible($grid, $i, $j)) {
                    $accesibleRollsPos[] = [
                        "row" => $i,
                        "col" => $j,
                    ];
                }
            }
        }
    }

    return $accesibleRollsPos;
}

$grid = getGridFromFile("input.txt");

while (!empty(getAccesibleRollsPositions($grid))) {
    foreach (getAccesibleRollsPositions($grid) as $roll) {
        $grid[$roll["row"]][$roll["col"]] = ".";
        $removedRolls++;
    }
}

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printing Department (2)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .solution {
            font-size: xx-large;
        }
    </style>
</head>

<body>
    <p class="solution mt-3 ms-3"><?= "The solution is: $removedRolls"; ?></p>
    <p class="mt-3 ms-3"><?= "Script Execution Time = $execution_time sec"; ?></p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>