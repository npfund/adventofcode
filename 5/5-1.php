<?php

$strings = file('5.txt', FILE_IGNORE_NEW_LINES);

$nice = 0;

foreach ($strings as $string) {
    if (preg_match('/[aeiou].*[aeiou].*[aeiou]/', $string)
        && preg_match('/(.)\1/', $string)
        && !preg_match('/ab|cd|pq|xy/', $string)
    ) {
        $nice += 1;
    }
}

var_dump($nice);
