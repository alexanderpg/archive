<?php
// Стартуем сессию.

@extract($_SESSION);
@extract($_REQUEST);

session_start();

// Подключаем библиотеку поддержки.
//require_once "./lib/config.php";
require_once "./lib/Subsys/JsHttpRequest/Php.php";
// Создаем главный объект библиотеки.
// Указываем кодировку страницы (обязательно!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");
// Получаем запрос.
$q = $_REQUEST['q'];
$xid = $_REQUEST['xid'];
$_num = $_REQUEST['num'];

// Подключаем корзину
//session_register('cart');

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
@mysql_query("SET NAMES cp1251");

$SysValue['nav']['nav'] = $NAV;


// Подключаем модули
include("./inc/engine.inc.php");            // Модуль движка
include("./inc/cache.inc.php");


// Подключаем кеш
$LoadItems=CacheReturnBase("cart");

function Chek($stroka)// проверка вводимых цифр
{
if (!ereg ("([0-9])", $stroka)) 
 {
 $stroka="0";
 }
return abs($stroka);
}

function Chek2($stroka)// проверка вводимых цифр
{
if (!ereg ("([0-9])", $stroka)) 
 {
 $stroka="0";
 }
return number_format(abs($stroka),"2",".","");
}

$sql="select * from ".$SysValue['base']['table_name2']." where id=$xid";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=$row['name'];
$price=$row['price'];
$price=($price+(($price*$LoadItems['System']['percent'])/100));
$uid=$row['uid'];
$id=$row['id'];
$user=$row['user'];

// Выборка из базы нужной колонки цены
	if(session_is_registered('UsersStatus')){
    $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
	  if($GetUsersStatusPrice>1){
	   $pole="price".$GetUsersStatusPrice;
	   $pricePersona=$row[$pole];
	   if(!empty($pricePersona)) 
	     $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
	   }
	}

$num=@$cart[$xid]['num']+$_num;
$cart_new=array(
"id"=>"$id",
"name"=>"$name",
"price"=>$price,
"uid"=>"$uid",
"num"=>"$num",
"user"=>$user
	);
$cart[$xid]=$cart_new;

// Подключаем корзину
if(is_array($cart))
session_register('cart');


if(is_array($cart))// вывод корзины
foreach($cart as $j=>$v)
  {
 $price=$cart[$j]['price']*$cart[$j]['num'];
 @$sum+=$price_now;
 @$sum=number_format($sum,"2",".","");
 @$num+=$cart[$j]['num'];
 }

function ReturnNum($cart)
{
while (list($key, $value) = @each($cart)) @$num+=$cart[$key]['num'];
return @$num;
}

function ReturnSumma($sum){ // Поправки по курсу
$kurs=GetKursOrder();
$sum*=$kurs;
return number_format($sum,"2",".","");
}

function GetKursOrder(){ // Курс
global $LoadItems;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];
  
return  $LoadItems['Valuta'][$valuta]['kurs'];
}


function ReturnSum($cart)
{
while (list($key, $value) = @each($cart)) @$sum+=$cart[$key]['price']*$cart[$key]['num'];
@$sum=number_format($sum,"2",".","");
$sum=ReturnSumma($sum);
return @$sum;
}

function ReturnSum_R($cart)
{
global $LoadItems;
while (list($key, $value) = @each($cart)) @$sum+=$cart[$key]['price']*$cart[$key]['num']*$LoadItems['System']['kurs'];
@$sum=number_format($sum,"2",".","");
return @$sum;
}

// Формируем результат прямо в виде PHP-массива!
$_RESULT = array(
  "q"     => $q,
  "md5"   => md5($q),
  "num"   => ReturnNum($cart),
  "sum" => ReturnSum($cart),
  "sum_r" => ReturnSum_R($cart)
); 
?>