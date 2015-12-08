<?php

$strings = file('8.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$raw = 0;
$slashed = 0;

foreach ($strings as $string) {
    $raw += strlen($string);
    $slashed += strlen(addslashes($string));
}

var_dump(($slashed - $raw) + (2 * count($strings)));
