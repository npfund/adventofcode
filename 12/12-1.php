<?php

$input = trim(file_get_contents('12.txt'));

$input = preg_replace('/[^0-9\-]/', ' ', $input);
$input = preg_replace('/\s+/', ' ', $input);

$input = explode(' ', $input);

var_dump(array_sum($input));
