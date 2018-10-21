<?php

function getLeads() {
	date_default_timezone_set('Etc/GMT+1');
	$date = time();
	$link = 'https://test.api.yadrocrm.ru/tmp/crm/lead/list?status[]=15175270&key=a68eb01d5aa7d40ae45af4825d8d713a';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
	curl_setopt($curl, CURLOPT_URL, $link);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
	curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	  'IF-MODIFIED-SINCE: Mon, 01 Aug 2013 07:07:23'
	));
	$out = curl_exec($curl);
	$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	$code = (int)$code;
	$errors = array(
	  301 => 'Moved permanently',
	  400 => 'Bad request',
	  401 => 'Unauthorized',
	  403 => 'Forbidden',
	  404 => 'Not found',
	  500 => 'Internal server error',
	  502 => 'Bad gateway',
	  503 => 'Service unavailable'
	);
	try {
	  if ($code != 200 && $code != 204) {
	    throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
	  }
	}

	catch(Exception $E) {
	  die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
	}

	$Response = json_decode($out, true);
	$massiv = $Response['result'];
	$month = [];
	for($i = $date; $i < $date + 30 * 24 * 60 * 60; $i += 86400) {
		$month[] = ['day' => date('Y-m-d 00:00:00', $i), 'sum' => 0];
	}
	foreach ($massiv as $value) {
		foreach ($value['custom_fields'] as $val) {
			if ($val['id'] == 475981) {
				foreach ($month as $key => $day) {
					if ($day['day'] == $val['values'][0]['value']) {
						$month[$key]['sum'] += 1;
					}
				}
			}
		} 
	}
	return $month;
}

$x = getLeads();
/*print_r($x);*/

foreach ($x as $value) {
	if ($value['sum'] < 5) {
		$y = strtotime($value['day']);
		$m[] = date("Y, n, j", $y);
	}
}
/*print_r($m);*/
echo json_encode($m);