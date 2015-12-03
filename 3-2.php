<?php

$directions = file_get_contents('3.txt');

$length = strlen($directions);

$santa = ['x' => 0, 'y' => 0];
$robot = ['x' => 0, 'y' => 0];
$houses = ['0,0'];

for ($i = 0; $i < $length; ++$i) {
     ($i % 2 == 0 ? $position = &$santa : $position = &$robot);
    switch ($directions[$i]) {
        case '^':
            ++$position['y'];
            break;
        case 'v':
            --$position['y'];
            break;
        case '<':
            --$position['x'];
            break;
        case '>':
            ++$position['x'];
            break;
    }

    $house = implode(',', $position);

    if (!in_array($house, $houses)) {
        $houses[] = $house;
    }
}

var_dump(count($houses));
