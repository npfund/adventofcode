<?php

$directions = file('6.txt', FILE_IGNORE_NEW_LINES);

$lights = array_pad([], 1000, array_pad([], 1000, false));

foreach ($directions as $direction) {
    $parts = explode(' ', $direction);

    if ($parts[0] == 'turn') {
        if ($parts[1] === 'on') {
            $delta = 1;
        } else {
            $delta = -1;
        }
        change($parts[2], $parts[4], $delta);
    } else {
        change($parts[1], $parts[3], 2);
    }
}

function change($start, $end, $delta)
{
    global $lights;
    list($startX, $startY) = explode(',', $start);
    list($endX, $endY) = explode(',', $end);

    for ($x = (int)$startX; $x <= (int)$endX; ++$x) {
        for ($y = (int)$startY; $y <= (int)$endY; ++$y) {
            $lights[$x][$y] = max(0, $lights[$x][$y] + $delta);
        }
    }
}

function sumLights()
{
    global $lights;
    $total = 0;

    for ($x = 0; $x < 1000; ++$x) {
        for ($y = 0; $y < 1000; ++$y) {
            $total += $lights[$x][$y];
        }
    }

    var_dump($total);
}

sumLights();
