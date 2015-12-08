<?php

$strings = file('8.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$raw = 0;
$parsed = 0;

foreach ($strings as $string) {
    $raw += strlen($string);
    $parsed += eval('return strlen(' . $string . ');');
}

var_dump($raw - $parsed);
