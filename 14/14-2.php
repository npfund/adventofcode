<?php

$input = file('14.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$reindeer = [];

foreach ($input as $line) {
    $parts = explode(' ', $line);

    $name = $parts[0];
    $reindeer[$name] = [];

    $speed = (int)$parts[3];
    $time = (int)$parts[6];

    $reindeer[$name]['speed'] = $speed;
    $reindeer[$name]['time'] = $time;

    $rest = (int)$parts[13];
    $reindeer[$name]['rest'] = $rest;

    $reindeer[$name]['flightTimer'] = $time;
    $reindeer[$name]['restTimer'] = 0;
    $reindeer[$name]['position'] = 0;
    $reindeer[$name]['score'] = 0;
}

$time = 2503;

while ($time > 0) {
    foreach ($reindeer as &$deer) {
        if ($deer['flightTimer'] > 0) {
            $deer['position'] += $deer['speed'];

            $deer['flightTimer'] -= 1;

            if ($deer['flightTimer'] == 0) {
                $deer['restTimer'] = $deer['rest'];
            }
        } elseif ($deer['restTimer'] > 0) {
            $deer['restTimer'] -= 1;

            if ($deer['restTimer'] == 0) {
                $deer['flightTimer'] = $deer['time'];
            }
        } else {
            die('!!!');
        }
    }

    $bestDeerPosition = 0;

    foreach ($reindeer as &$deer) {
        if ($deer['position'] > $bestDeerPosition) {
            $bestDeerPosition = $deer['position'];
        }
    }

    foreach ($reindeer as &$deer) {
        if ($deer['position'] == $bestDeerPosition) {
            $deer['score'] += 1;
        }
    }

    $time -= 1;
}

$maxDeer = '';
$max = 0;

foreach ($reindeer as $name => $deer) {
    if ($deer['score'] > $max) {
        $maxDeer = $name;
        $max = $deer['score'];
    }
}

var_dump($reindeer[$maxDeer]['score']);
