<?php

$directions = file('6.txt', FILE_IGNORE_NEW_LINES);

$lights = array_pad([], 1000, array_pad([], 1000, false));

foreach ($directions as $direction) {
    $parts = explode(' ', $direction);

    if ($parts[0] == 'turn') {
        setValue($parts[2], $parts[4], $parts[1] === 'on');
    } else {
        toggle($parts[1], $parts[3]);
    }
}

function setValue($start, $end, $value)
{
    global $lights;
    list($startX, $startY) = explode(',', $start);
    list($endX, $endY) = explode(',', $end);

    for ($x = (int)$startX; $x <= (int)$endX; ++$x) {
        for ($y = (int)$startY; $y <= (int)$endY; ++$y) {
            $lights[$x][$y] = $value;
        }
    }
}

function toggle($start, $end)
{
    global $lights;
    list($startX, $startY) = explode(',', $start);
    list($endX, $endY) = explode(',', $end);

    for ($x = (int)$startX; $x <= (int)$endX; ++$x) {
        for ($y = (int)$startY; $y <= (int)$endY; ++$y) {
            $lights[$x][$y] = !$lights[$x][$y];
        }
    }
}

function countLights()
{
    global $lights;
    $count = 0;

    for ($x = 0; $x < 1000; ++$x) {
        for ($y = 0; $y < 1000; ++$y) {
            if ($lights[$x][$y] === true) {
                $count += 1;
            }
        }
    }

    var_dump($count);
}

countLights();
