<?php

include 'vendor/autoload.php';

$input = file('9.txt', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);

$distances = [];

foreach ($input as $line) {
    list($lhs, $distance) = explode(' = ', $line);
    list($start, $end) = explode (' to ', $lhs);

    if (!isset($distances[$start])) {
        $distances[$start] = [];
    }

    $distances[$start][$end] = $distance;

    if (!isset($distances[$end])) {
        $distances[$end] = [];
    }

    $distances[$end][$start] = $distance;
}

$permutations = new \NajiDev\Permutation\PermutationIterator(array_keys($distances));

$longest = 0;

foreach ($permutations as $cities) {
    $total = 0;

    for ($i = 0; $i < count($cities) - 1; ++$i) {
        $total += $distances[$cities[$i]][$cities[$i + 1]];
    }

    if ($total > $longest) {
        $longest = $total;
    }
}

var_dump($longest);
