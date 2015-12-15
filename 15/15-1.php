<?php

$input = file('15.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$ingredients = [];

foreach ($input as $line) {
    $matches = [];
    preg_match('/(\w+): (\w+ -?\d+), (\w+ -?\d+), (\w+ -?\d+), (\w+ -?\d+), (\w+ -?\d+)/i', $line, $matches);

    array_shift($matches);
    $ingredient = array_shift($matches);
    $ingredients[$ingredient] = [];
    foreach ($matches as $quality) {
        list($name, $value) = explode(' ', $quality);
        if ($name == 'calories') { continue; } //Skip calories for part 1
        $ingredients[$ingredient][$name] = (int)$value;
    }
}

$equations = [];

$qualities = array_keys(reset($ingredients));
$args = join(', ', array_map(function($item) { return '$' . $item;}, array_keys($ingredients)));
foreach ($qualities as $quality) {
    $equation = '';
    $parts = [];
    foreach ($ingredients as $name => $ingredient) {

        $parts[] = '($' . $name . ' * ' . $ingredient[$quality] . ')';
    }

    $equation = join(' + ', $parts);

    $equations[$quality] = create_function($args, 'return ' . $equation . ';');
}

function total($equations, $u, $p, $a, $h) {
    return array_reduce($equations, function($carry, $item) use ($u, $p, $a, $h) {
        return $carry * max($item($u, $p, $a, $h), 0);
    }, 1);
}

$max = 0;

for ($sugar = 1; $sugar <= 100; ++$sugar) {
    for ($sprinkles = 1; $sprinkles <= 100; ++$sprinkles) {
        for ($candy = 1; $candy <= 100; ++$candy) {
            for ($chocolate = 1; $chocolate <= 100; ++$chocolate) {
                if ($sugar + $sprinkles + $candy + $chocolate === 100) {
                    $total = total($equations, $sugar, $sprinkles, $candy, $chocolate);
                    if ($total > $max) {
                        $max = $total;
                    }
                }
            }
        }
    }
}

var_dump($max);
