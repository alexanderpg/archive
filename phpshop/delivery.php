<?php

// Подключаем библиотеку поддержки.
//require_once "./lib/config.php";
require_once "./lib/Subsys/JsHttpRequest/Php.php";
// Создаем главный объект библиотеки.
// Указываем кодировку страницы (обязательно!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// Парсируем установочный файл
$SysValue=parse_ini_file("./inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");


// Вывод стоимости доставки
function GetDeliveryPrice($deliveryID,$sum){
global $SysValue;
if(!empty($deliveryID)){
$sql="select * from ".$SysValue['base']['table_name30']." where id='$deliveryID' and enabled='1'";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$row = mysql_fetch_array($result);

if($num == 0){
$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
}}

else
{
$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
}

if($row['price_null_enabled'] == 1 and $sum>=$row['price_null'])
  return 0;
  else return $row['price'];
}

$GetDeliveryPrice=GetDeliveryPrice($_REQUEST['xid'],$_REQUEST['sum']);
$totalsumma=$GetDeliveryPrice+$_REQUEST['sum'];

$_RESULT = array(
  'delivery' => $GetDeliveryPrice,
  'total' => $totalsumma
); 
?>