<?php

$input = trim(file_get_contents('12.txt'));

$json = json_decode($input);

function killRed(&$json)
{
    if ($json instanceof stdClass && in_array('red', get_object_vars($json), true)) {
        $json = 0;
    } else {
        foreach ($json as &$child) {
            if ($child instanceof stdClass || is_array($child)) {
                killRed($child);
            }
        }
    }
}

killRed($json);

$input = json_encode($json);

$input = preg_replace('/[^0-9\-]/', ' ', $input);
$input = preg_replace('/\s+/', ' ', $input);

$input = explode(' ', $input);

var_dump(array_sum($input));
