<?php

$boxes = file('2.txt', FILE_IGNORE_NEW_LINES);

$total = 0;

foreach ($boxes as $box) {
    list ($length, $width, $height) = explode('x', $box);
    $side1 = 2 * ($length + $width);
    $side2 = 2 * ($length + $height);
    $side3 = 2 * ($width + $height);

    $total += min($side1, $side2, $side3) + ($length * $width * $height);
}

var_dump($total);
