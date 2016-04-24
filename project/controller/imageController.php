<?php
require_once "lib/getTree.php";

$im = @imagecreatefromjpeg($_REQUEST["url"]);
$y = imagesy($im);
$x = imagesx($im);

function isGreen($r, $g, $b)
{
    if ((($r < 210) && $g > 200 && $b < 180) || ($r == 202 && $b == 223 && $g == 170)) {
        return true;
    }
    return false;
}

$array = Array(Array());

for ($i = 0; $i < $y; $i++) {
    for ($j = 0; $j < $x; $j++) {
        $rgb = imagecolorat($im, $j, $i);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        if (isGreen($r, $g, $b)) {
            $array[$i][$j] = 0;
        } else {
            $array[$i][$j] = 1;
        }
    }
}
$b = getShapes($array);
$arrayObjet = Array();


for ($i = 0; $i < sizeof($b); $i++) {
    for ($j = 0; $j < sizeof($b[$i]); $j++) {
        if ($b[$i][$j] != 0) {
            $arrayObjet[$b[$i][$j]][sizeof($arrayObjet[$b[$i][$j]])] = Array(
                "x" => $j,
                "y" => $i
            );
        }
    }
}
echo json_encode($arrayObjet);
?>
