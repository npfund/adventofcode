<?php

include 'vendor/autoload.php';

$input = file('13.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$chart = [];

foreach ($input as $line) {
    $parts = explode(' ', $line);

    $person = $parts[0];
    if (!isset($chart[$person])) {
        $chart[$person] = [];
    }

    $direction = $parts[2] === 'gain' ? 1 : -1;
    $points = $parts[3] * $direction;

    $neighbor = trim($parts[10], '.');

    $chart[$person][$neighbor] = $points;
}

$permutations = new \NajiDev\Permutation\PermutationIterator(array_keys($chart));

$happiest = 0;
foreach ($permutations as $permutation) {
    $total = happiness($permutation, $chart);
    if ($total > $happiest) {
        $happiest = $total;
    }
}

function happiness($permutation, $chart) {
    $total = 0;
    $count = count($permutation);

    for ($i = 0; $i < $count - 1; ++$i) {
        $total += $chart[$permutation[$i]][$permutation[$i + 1]];
        $total += $chart[$permutation[$i + 1]][$permutation[$i]];
    }

    $total += $chart[$permutation[0]][$permutation[$count - 1]];
    $total += $chart[$permutation[$count - 1]][$permutation[0]];

    return $total;
}

var_dump($happiest);
