<?php

$instructions = file('7.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$wires = [];

$wires['b'] = 956;

while (!isset($wires['a'])) {
    foreach ($instructions as $instruction) {
        list($lhs, $destination) = explode(' -> ', $instruction);

        $lhs = explode(' ', $lhs);

        if (!isset($wires[$destination])) {
            if (count($lhs) == 3) {
                //AND OR SHIFT

                $value1 = wireValueOrNumber($lhs[0], $wires);
                $value2 = wireValueOrNumber($lhs[2], $wires);

                if ($value1 !== null && $value2 !== null) {
                    switch ($lhs[1]) {
                        case 'AND':
                            $wires[$destination] = $value1 & $value2;
                            break;
                        case 'OR':
                            $wires[$destination] = $value1 | $value2;
                            break;
                        case 'LSHIFT':
                            $wires[$destination] = $value1 << $value2;
                            break;
                        case 'RSHIFT':
                            $wires[$destination] = $value1 >> $value2;
                            break;
                        default:
                            var_dump('BAD THREE PART INSTRUCTION');
                            break;
                    }
                }
            } else if (count($lhs) == 2) {
                //NOT
                $value = wireValueOrNumber($lhs[1], $wires);
                if ($value !== null) {
                    $wires[$destination] = ~$value;
                }
            } else if (count($lhs) == 1) {
                //ASSIGN
                $value = wireValueOrNumber($lhs[0], $wires);
                if ($value !== null) {
                    $wires[$destination] = $value;
                }
            } else {
                var_dump("CAN'T PARSE INSTRUCTION");
            }
        }
    }
}

function wireValueOrNumber($input, $wires) {
    $output = null;
    if (ctype_digit($input)) {
        $output = (int)$input;
    } else if (isset($wires[$input])) {
        $output = $wires[$input];
    }

    return $output;
}

var_dump($wires['a']);
