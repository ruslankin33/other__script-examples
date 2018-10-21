<?php

function get_element($array,$element) {
    $new_array = array_slice($array, $element, 1);
    return end($new_array);
}

for ($i = 1; $i <= 20; $i++) {
    $m[] = rand(-1000,805);
}

print_r($m);

$min = get_element($m,0);

foreach ($m as $i) {
    if ($i < $min) {
        $min = $i;
    }
}
echo $min;