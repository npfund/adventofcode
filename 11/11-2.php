<?php

require 'Sexavigintidecimal.php';

$input = 'cqjxxyzz';

$number = new Sexaviginitidecimal($input);

$match = false;

while (!$match) {
    $number->increment();

    if ($number->containsSequentialTriplet()
        && !preg_match('/[iol]/', $number)
        && preg_match('/(.)\1.*(.)\2/', $number)
    ) {
        $match = true;
    }
}

var_dump($number->__toString());
