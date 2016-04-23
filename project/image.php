<?php
session_start();

$im = imageCreateFromPng('image2.png');
$y = imagesy($im);
$x = imagesx($im);

function isGreen($x, $y, $im)
{
    $im = imageCreateFromPng('image2.png');
    $rgb = imagecolorat($im, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    if ((($r < 210) && $g > 200 && $b < 180) || ($r == 202 && $b == 223 && $g == 170)) {
        return true;
    }
    return false;
}

$_SESSION["array"] = [[]];

for ($i = 0; $i < $y; $i++) {
    for ($j = 0; $j < $x; $j++) {
        $_SESSION["array"][$i][$j] = 0;
    }
}
function isExit($i, $j)
{

    $im = imageCreateFromPng('image2.png');

    $y = imagesy($im);
    $x = imagesx($im);
    if ($i < 0 || $j < 0 || $i > $x || $j > $y) {
        return false;
    } else {
        return true;
    }
}

function findNeighbourhood($x, $y, $im)
{
    $_SESSION["array"][$x][$y] = 1;

    if ($_SESSION["array"][$x - 1][$y - 1] != 1 && isExit($x - 1, $y - 1) && isGreen($x - 1, $y - 1, $im)) {
        findNeighbourhood($x - 1, $y - 1, $im);
        return false;
    }
    if ($_SESSION["array"][$x][$y - 1] != 1 && isExit($x, $y - 1) && isGreen($x, $y - 1, $im)) {
        findNeighbourhood($x, $y - 1, $im);
        return false;

    }
    if ($_SESSION["array"][$x + 1][$y - 1] != 1 && isExit($x + 1, $y - 1) && isGreen($x + 1, $y - 1, $im)) {
        findNeighbourhood($x + 1, $y - 1, $im);
        return false;

    }
    if ($_SESSION["array"][$x - 1][$y] != 1 && isExit($x - 1, $y) && isGreen($x - 1, $y, $im)) {
        findNeighbourhood($x, $y, $im);
        return false;

    }
    if ($_SESSION["array"][$x + 1][$y] != 1 && isExit($x + 1, $y) && isGreen($x + 1, $y, $im)) {
        findNeighbourhood($x + 1, $y, $im);
        return false;

    }
    if ($_SESSION["array"][$x - 1][$y + 1] != 1 && isExit($x - 1, $y + 1) && isGreen($x - 1, $y + 1, $im)) {
        findNeighbourhood($x - 1, $y + 1, $im);
        return false;

    }
    if ($_SESSION["array"][$x][$y + 1] != 1 && isExit($x, $y + 1) && isGreen($x, $y + 1, $im)) {
        findNeighbourhood($x, $y + 1, $im);
        return false;

    }
    if ($_SESSION["array"][$x + 1][$y + 1] != 1 && isExit($x + 1, $y + 1) && isGreen($x + 1, $y + 1, $im)) {
        findNeighbourhood($x + 1, $y + 1, $im);
        return false;

    }

}

for ($i = 0; $i < $y; $i++) {
    for ($j = 0; $j < $x; $j++) {
        $rgb = imagecolorat($im, $j, $i);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        if (isGreen($r, $g, $b) && $_SESSION["array"][$i][$j] != 1) {
            findNeighbourhood($j, $i, $im);
        }

    }
}

