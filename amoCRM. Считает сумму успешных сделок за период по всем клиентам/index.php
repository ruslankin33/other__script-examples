<?php

$date_from = strtotime("10 September 2016");
$date_to = strtotime("10 October 2018");

//Функция получает суммарный бюджет по сделкам со статусом "Успешно реализован" в заданном периоде
function getSummLeads($api, $date_from, $date_to) {
  $link='https://test.api.yadrocrm.ru/tmp/crm/lead/list?status[]=142&key='.$api.'';
  $curl=curl_init();
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl);
  $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
  curl_close($curl);
  $code=(int)$code;
  $errors=array(
    301=>'Moved permanently',
    400=>'Bad request',
    401=>'Unauthorized',
    403=>'Forbidden',
    404=>'Not found',
    500=>'Internal server error',
    502=>'Bad gateway',
    503=>'Service unavailable'
  );
  try
  {
    if($code!=200 && $code!=204) {
      throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error',$code);
    }
  }
  catch(Exception $E)
  {
    die('Ошибка: '.$E->getMessage().PHP_EOL.'Код ошибки: '.$E->getCode());
  }

  $Response=json_decode($out,true);
  $allLeads=$Response['result'];
  $summ = 0;
  foreach ($allLeads as $value) {
    if (!empty($value['price'])) {
      if (($value['date_close'] > $date_from) && ($value['date_close'] < $date_to)) {
      $summ += $value['price'];
      }
    }
  }
  return($summ);
}

function getClients() {
    return [
        [
            'id' => 1,
            'name' => 'intrdev',
            'api' => 'a68eb01d5aa7d40ae45af4825d8d713a',
        ],
        [
            'id' => 2,
            'name' => 'artedegrass0',
            'api' => 'a68eb01d5aa7d40ae45af4825d8d713a', //второго api нет, поэтому для наглядности использую один и тот же
        ],
    ];
}
$clients = getClients();

//Цикл проверяет клиента на актуальность и, при положительном ответе, записывает в массив значение, равное сумме успешно реализованных сделок в заданном периоде
$allSummLeads = 0;
foreach ($clients as $key => $value) {
  $link='https://test.api.yadrocrm.ru/tmp/crm/account?key='. $value['api'] .'';
  $curl=curl_init();
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
  curl_setopt($curl,CURLOPT_URL,$link);
  curl_setopt($curl,CURLOPT_HEADER,false);
  curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
  curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
  curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
  curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
  $out=curl_exec($curl);
  $Response=json_decode($out,true);
  if (is_array($Response)) {
    $clients[$key]['summLeads'] = getSummLeads($value['api'], $date_from, $date_to);
    $allSummLeads += $clients[$key]['summLeads']; //сумма сделок всех клиентов
  }
}

require_once ('./table.php');