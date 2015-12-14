<?php

$input = file('14.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$reindeer = [];

foreach ($input as $line) {
    $parts = explode(' ', $line);

    $deer = $parts[0];
    $reindeer[$deer] = [];

    $speed = (int)$parts[3];
    $time = (int)$parts[6];

    $distance = $speed * $time;
    $reindeer[$deer]['distance'] = $distance;
    $reindeer[$deer]['time'] = $time;

    $rest = (int)$parts[13];
    $reindeer[$deer]['rest'] = $rest;
}

$max = 0;

foreach ($reindeer as $deer) {
    $travel = fly($deer);
    if ($travel > $max) {
        $max = $travel;
    }
}

function fly($deer) {
    $total = 0;
    $remaining = 2503;

    while ($remaining > 0) {
        $take = $deer['time'];
        $remaining -= $take;
        if ($remaining < 0) {
            $take += $remaining;
        }

        $total += $deer['distance'] * ($take / (float)$deer['time']);

        $remaining -= $deer['rest'];
    }

    return $total;
}

var_dump($max);
