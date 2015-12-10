<?php

$input = '1113122113';

$output = $input;

for ($outer = 0; $outer < 40; $outer++) {
    $temp = '';
    $last = ['char' => $output[0], 'total' => 0];
    $i = 0;
    while ($i < strlen($output)) {
        if ($output[$i] !== $last['char']) {
            $temp .= $last['total'] . $last['char'];
            $last['char'] = $output[$i];
            $last['total'] = 1;
        } else {
            $last['total'] += 1;
        }
        ++$i;
    }
    $temp .= $last['total'] . $last['char'];
    $output = $temp;
}

var_dump($output);
