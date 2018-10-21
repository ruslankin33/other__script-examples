<?php 

$x = array(
    ['id' => '11', 'prihod' => '12.56', 'comment' => 'lala'],
    ['id' => '15', 'prihod' => '8.4', 'comment' => 'lalala'],
    ['id' => '22', 'prihod' => '6.486', 'comment' => 'lalalalf'],
    ['id' => '23', 'prihod' => '8.486', 'comment' => 'laddalalf'],
    ['id' => '29', 'prihod' => '63.7886', 'comment' => 'lafghlalf'],
    ['id' => '109', 'prihod' => '16', 'comment' => 'laguflalf']
);

foreach ($x as $key => $value) {
	$m[$key] = floatval($value ['prihod']);
}

array_multisort($m,$x);
print_r($x);