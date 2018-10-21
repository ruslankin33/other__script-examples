<?php

/*$x = array(
    ['id' => '11', 'prihod' => '12.56', 'comment' => 'lala'],
    ['id' => '15', 'prihod' => '8.4', 'comment' => 'lalala'],
    ['id' => '22', 'prihod' => '6.486', 'comment' => 'lalalalf'],
    ['id' => '23', 'prihod' => '8.486', 'comment' => 'laddalalf'],
    ['id' => '29', 'prihod' => '63.7886', 'comment' => 'lafghlalf'],
    ['id' => '109', 'prihod' => '16', 'comment' => 'laguflalf']
);*/

$x = [
	'dima' => 'ivanov',
	'egor' => 'petrov',
	'stas' => 'tutaev',
	'timur' => 'aslaev',
	'ruslan' => 'bikov',
	'radmir' => 'joke'
];

if (! function_exists("array_key_first")) {
    function array_key_first($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }
        
        return array_keys($array)[0];
    }
}

if (! function_exists("array_key_last")) {
    function array_key_last($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }
        
        return array_keys($array)[count($array)-1];
    }
}

print_r($x);

$last_value = end($x);
$last_key = array_key_last($x);
$y = array($last_key=>'muzafarov');
print_r($y);print_r($x);
$x = array_merge($y,$x);
print_r($x);
/*array_unshift($x, $last_value);*/
/*unset($x[$last_key]);*/
