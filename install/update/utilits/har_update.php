<?
//
// Обновление характеристик старого типа на многомерные
//


$is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
if (!$is_safe_mode) @set_time_limit(600);

// Парсируем установочный файл
$SysValue=parse_ini_file("../../../phpshop/inc/config.ini",1);

// Глобалс он
@extract($_GET);
@extract($_POST);
@extract($_FORM);
@extract($_FILES);


// Подключаем базу MySQL
@mysql_pconnect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");

$i=0;



$sql="select id,vendor_array from ".$SysValue['base']['table_name2'];
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
	$vendor_array=unserialize($row['vendor_array']);
	$vendor_array_new=array();
	if(is_array($vendor_array)){
	  foreach($vendor_array as $k=>$v) $vendor_array_new[$k][]=$v;
	
$sql2="UPDATE ".$SysValue['base']['table_name2']." 
SET 
vendor_array='".serialize($vendor_array_new)."', 
parent_enabled='0', 
parent='' where id=$id";
$resul2t=mysql_query($sql2) or die(mysql_error());
$i++;
	}
	}
Echo "Обновление выполнено, затронутых записей: $i";

?>

