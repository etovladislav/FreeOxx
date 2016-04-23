<?php
require_once "index.php";

$im = imageCreateFromJpeg('image2.jpg');
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

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<canvas id="myCanvas" width="500" height="375"></canvas>

<script>

    canvas = document.getElementById('myCanvas');
    obCanvas = canvas.getContext('2d');
    function circle(x, y) {
        var obCanvas = canvas.getContext('2d');
        obCanvas.beginPath();
        obCanvas.arc(y, x, 5, 0, 2 * Math.PI, false);
        obCanvas.fillStyle = 'rgba(0,0,0,0.1)';
        obCanvas.fill();
    }

    var img = new Image();   // Создать новый объект Image
    img.src = 'image2.jpg';
    img.onload = function () {
        obCanvas.drawImage(img, 0, 0);
        <?php

        for ($i = 0; $i < sizeof($b); $i++) {
        for ($j = 0; $j < sizeof($b[$i]); $j++) {
        if ($b[$i][$j] != 0) {
        ?>
        circle(<?php echo $i; ?>, <?php echo $j; ?>);
        <?php
        }
        }
        }
        ?>
    }
</script>
</body>
</html>