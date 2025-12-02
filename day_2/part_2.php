<?php

$start_time = microtime(true);

$invalidIds = [];
$idRanges = explode(",", file_get_contents("input.txt"));

foreach ($idRanges as $range) {
    preg_match_all("/\d+/", $range, $matches);
    $firstId = $matches[0][0];
    $lastId = $matches[0][1];

    for ($i = $firstId; $i < $lastId + 1; $i++) {
        $id = (string)$i;
        $idLen = strlen($id);
        $chunkLen = intval($idLen / 2);
        $invalidIdFound = false;

        while (!$invalidIdFound && $chunkLen > 0){
            if ($idLen % $chunkLen === 0) {
                $chunks = str_split($id, $chunkLen);
                $uniqueValues = array_unique($chunks);
                if(count($uniqueValues) === 1){
                    $invalidIdFound = true;
                    $invalidIds[] = $i;
                }
            }
            $chunkLen--;
        }
    }
}

$solution = array_sum($invalidIds);

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Shop (2)</title>
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