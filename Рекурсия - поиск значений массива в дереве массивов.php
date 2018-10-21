<?php

$arr = [
		[
			'id' => '12',
			'prihod' => 12.78,
			'comment' => 'lala l lala'
		],		
		[
			'id' => '124',
			'prihod' => 15.782,
			'comment' => 'lala l ala'
		],
		[
			[
				'id' => '137',
				'prihod' => 6.21,
				'comment' => 'lala la lala'
			],
			[
				'id' => '121',
				'prihod' => 12.78,
				'comment' => 'lala lalal'
			],
		],
		[
			[
				[
					'id' => '582',
					'prihod' => 7.1,
					'comment' => 'lala la lala'
				],
				[
					'id' => '38',
					'prihod' => 12.78,
					'comment' => 'lala lala'
				],
			],
			[
				'id' => '1282',
				'prihod' => 12.78,
				'comment' => 'lala l lala'
			],
			[
				'id' => '228',
				'prihod' => 11.784,
				'comment' => 'lala la lala'
			],
		],
	];

function search($array, $key, $value) {
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }
        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }
    return $results;
}

print_r(search($arr, 'prihod', '12.78'));