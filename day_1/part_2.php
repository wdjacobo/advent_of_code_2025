<?php

include_once "../functions.php";

define("DIRECTION_LEFT", "L");
define("DIRECTION_RIGHT", "R");
define("MIN_NUMBER", 0);
define("MAX_NUMBER", 99);
define("UPDATING_PASS_VALUE", 0);

$pos = 50;
$pass = 0;
$seqFile = fopen("input.txt", "r");

function getRotationDirection(string $rotation): string
{
    if (preg_match("/^" . DIRECTION_RIGHT . "/", $rotation)) {
        return DIRECTION_RIGHT;
    } else {
        return DIRECTION_LEFT;
    }
}

function getRotationClicks(string $rotation): int
{
    preg_match("/\d+/", $rotation, $match);
    return intval($match[0]);
}

function fixPos(int $pos): int
{
    if ($pos > MAX_NUMBER) {
        $pos = MIN_NUMBER;
    } else if ($pos < MIN_NUMBER) {
        $pos = MAX_NUMBER;
    }
    return $pos;
}

function updatePass(): void
{
    global $pass;
    $pass++;
}

function rotateDialAndUpdatePass(&$pos, $direction, $clicks) : void
{
    if ($direction == DIRECTION_RIGHT) {
        for ($i = 0; $i < $clicks; $i++) {
            $pos++; // Rotate right
            $pos = fixPos($pos);
            if ($pos === UPDATING_PASS_VALUE) {
                updatePass();
            }
        }
    } else {
        for ($i = 0; $i < $clicks; $i++) {
            $pos--; // Rotate left
            $pos = fixPos($pos);
            if ($pos === UPDATING_PASS_VALUE) {
                updatePass();
            }
        }
    }
}

if ($seqFile) {
    while (($rotation = fgets($seqFile)) !== false) {
        $direction = getRotationDirection($rotation);
        $clicks = getRotationClicks($rotation);
        rotateDialAndUpdatePass($pos, $direction, $clicks);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Entrance (2)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background-color: #010101;
            background-image: url("img/door_open.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }

        .solution {
            font-size: xx-large;
        }
    </style>
</head>

<body>
    <p class="solution mt-3 ms-3"><?= "The door's real password is: $pass"; ?></p>
    <p class="d-none">Image by <a href="https://unsplash.com/es/@langao?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Lan Gao</a> in <a href="https://unsplash.com/es/fotos/una-puerta-abierta-en-una-habitacion-oscura-con-luz-entrando-KBuWjEVavM8?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>