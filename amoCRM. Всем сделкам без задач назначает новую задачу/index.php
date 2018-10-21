<?php
require_once ('auth.php');

$subdomain = 'less777';
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';
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
$Response = $Response['_embedded']['items'];
$massiv = [];

foreach($Response as $value) {
  if ($value['closest_task_at'] == 0) {
    $massiv[] = [
      'element_id' => $value['id'],
      'element_type' => 2,
      'task_type' => 1,
      'text' => 'Сделка без задачи',
      'responsible_user_id' => 2833873,
      'complete_till_at' => (time() + (24 * 60 * 60))
    ];
  }
}

$tasks['add'] = $massiv;
$subdomain = 'less777';
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/tasks';
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($tasks));
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  'Content-Type: application/json'
));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt');
curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$out = curl_exec($curl);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
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
  if ($code != 200 && $code != 204) throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
}

catch(Exception $E) {
  die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
}
