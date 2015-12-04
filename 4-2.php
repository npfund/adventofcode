<?php

$input = 'bgvyzdsv';

$number = 0;

$hash = '';

do {
    $number += 1;
    $hash = md5($input . $number);
} while (substr($hash, 0, 6) !== '000000');

var_dump([$number, $hash]);
