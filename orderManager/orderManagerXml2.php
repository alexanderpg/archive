<?
// Парсируем установочный файл
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);

// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");


// Проверка пользователя
require("lib/user.lib.php");


// Преобразовываем дату
function dataV($nowtime){
$Months = array("01"=>"января","02"=>"февраля","03"=>"марта", 
 "04"=>"апреля","05"=>"мая","06"=>"июня", "07"=>"июля",
 "08"=>"августа","09"=>"сентября",  "10"=>"октября",
 "11"=>"ноября","12"=>"декабря");
$curDateM = date("m",$nowtime); 
$t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime)." ".date("H:s ",$nowtime); 
return $t;
}



function GetUnicTime($data){
$array=explode("-",$data);
return @mktime(12, 0, 0, $array[1], $array[0], $array[2]);
}

// Заказы
function OrdersArray($p1,$p2,$words,$list)
{
global $SysValue;

$words = MyStripSlashes(base64_decode($words));

if(empty($p1)) $p1=date("U")-86400;
 else $p1=GetUnicTime($p1)-86400;
if(empty($p2)) $p2=date("U");
 else $p2=GetUnicTime($p2)+86400;

 
if($list == "all" or !$list) $sort="";
  elseif($list == "new") $sort="and statusi=0";
       else $sort="and statusi=".$list;
	   
	   
if(!empty($words)){
if(is_int($words)) $sql="select * from ".$SysValue['base']['table_name1']." where uid=".$words;
else $sql="select * from ".$SysValue['base']['table_name1']." where orders REGEXP '".$words."'";
}
  else {
$sql="select * from ".$SysValue['base']['table_name1']." where datas<'$p2' and datas>'$p1' $sort order by id desc";
}
$result=mysql_query($sql) or die("ERROR:".mysql_error()."");
$i=mysql_num_rows($result);
while($row = mysql_fetch_array($result)){
$id=$row['id'];
$datas=$row['datas'];
$uid=$row['uid'];
$order=unserialize($row['orders']);
$status=unserialize($row['status']);

if(empty($row['statusi'])) $statusi=0;
  else $statusi=$row['statusi'];
  
if(empty($status['time'])) $time="-";
  else $time=$status['time'];
  
$array=array(
    "id"=>$id,
    "cart"=>$order['Cart'],
	"order"=>$order['Person'],
	"time"=>$time,
	"statusi"=>$statusi
	);
$i--;
$OrdersArray[$id]=$array;
}
return $OrdersArray;
}


// перекодировка unicode UTF-8 -> win1251 
function MyStripSlashes($s){ 
$out=""; 
$c1=""; 
$byte2=false; 
for ($c=0;$c<strlen($s);$c++){ 
$i=ord($s[$c]); 
if ($i<=127) $out.=$s[$c]; 
if ($byte2){ 
$new_c2=($c1&3)*64+($i&63); 
$new_c1=($c1>>2)&5; 
$new_i=$new_c1*256+$new_c2; 
if ($new_i==1025){ 
$out_i=168; 
}else{ 
if ($new_i==1105){ 
$out_i=184; 
}else { 
$out_i=$new_i-848; 
} 
} 
$out.=chr($out_i); 
$byte2=false; 
} 
if (($i>>5)==6) { 
$c1=$i; 
$byte2=true; 
} 
} 
return str_replace("\"","*",$out); 
} 



function OrderUpdateXml(){
global $SysValue,$_POST;

$sql="select * from ".$SysValue['base']['table_name1']." where id='".$_POST['id']."'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$status=unserialize($row['status']);
$order=unserialize($row['orders']);

// Время изменения
$Status=array(
"maneger"=>MyStripSlashes($_POST['manager']),
"time"=>date("d-m-y H:i a")
);


$order['Person']['name_person']=MyStripSlashes($_POST['name_person']);
$order['Person']['adr_name']=MyStripSlashes($_POST['adr_name']);
$order['Person']['dos_ot']=MyStripSlashes($_POST['dos_ot']);
$order['Person']['dos_do']=MyStripSlashes($_POST['dos_do']);
$order['Person']['tel_code']=MyStripSlashes($_POST['tel_code']);
$order['Person']['tel_name']=MyStripSlashes($_POST['tel_name']);
$order['Person']['org_name']=MyStripSlashes($_POST['org_name']);
$order['Person']['order_metod']=MyStripSlashes($_POST['metod_id']);

$sql="UPDATE ".$SysValue['base']['table_name1']."
SET 
orders='".serialize($order)."',
status='".serialize($Status)."',
statusi='".$_POST['statusi']."'
where id='".$_POST['id']."'";
$result=mysql_query($sql);
}


// Вывод доставки
function GetDelivery($deliveryID,$name){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name30']." where id='$deliveryID'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row[$name];
}

// Статус заказа
function GetOrderStatusArray(){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name32'];
$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	$array=array(
	"id"=>$row['id'],
	"name"=>$row['name'],
	"color"=>$row['color'],
	"sklad"=>$row['sklad_action']
	);
	$Status[$row['id']]=$array;
	}
return @$Status;
}

$GetOrderStatusArray=GetOrderStatusArray();


function Clean($s){
$a = htmlspecialchars($s,ENT_QUOTES);
return $a;
}



// Данные по заказу
function OrdersReturn($id){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name1']." where id=$id";
$result=mysql_query($sql) or die("ERROR:".mysql_error()."");
$row = mysql_fetch_array($result);
$id=$row['id'];
$datas=$row['datas'];
$uid=$row['uid'];
$order=unserialize($row['orders']);
$status=unserialize($row['status']);

if(empty($row['statusi'])) $statusi=0;
  else $statusi=$row['statusi'];
  
if(empty($status['time'])) $time="-";
  else $time=$status['time'];
  
$array=array(
    "id"=>$id,
    "cart"=>$order['Cart'],
	"order"=>$order['Person'],
	"time"=>$time,
	"datas"=>$datas,
	"dos_ot"=>Clean($status['dos_ot']),
	"dos_do"=>Clean($status['dos_do']),
	"manager"=>Clean($status['maneger']),
	"statusi"=>$statusi
	);
	
return $array;
}


function OplataMetod($tip){ 
if($tip==1) return "Счет в банк";
if($tip==2) return "Квитанция";
if($tip==3) return "Наличная";
if($tip==4) return "CyberPlat";
if($tip==5) return 'ROBOXchange';
if($tip==6) return 'WebMoney';
if($tip==7) return 'Z-Payment';
if($tip==8) return 'RBS';
else return "NoN";
}


// Изображение товара
function ReturnPic($id){
global $SysValue;
$sql="select pic_big from ".$SysValue['base']['table_name2']." where id=$id";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$pic_big=$row['pic_big'];
return $pic_big;
}


function ReturnSumma($sum,$disc){
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

switch ($command){
case ("loadListOrder"):
error_reporting(0);
$OrdersArray=OrdersArray($p1,$p2,$words,$list);
$GetOrderStatusArray[0]['name']="Новый заказ";
$GetOrderStatusArray[0]['color']="C0D2EC";
$XML='<?xml version="1.0" encoding="windows-1251"?>
<orderdb>';

foreach ($OrdersArray as $val){
$XML.='<order>
	      <data>'.dataV($val['order']['data']).'</data>
		  <datas>'.$val['order']['data'].'</datas>
		  <uid>'.$val['order']['ouid'].'</uid>
		  <id>'.$val['id'].'</id>
		  <name>'.Clean($val['order']['name_person']).'</name>
		  <mail>'.Clean($val['order']['mail']).'</mail>
		  <tel>'.Clean($val['order']['tel_code']).' '.Clean($val['order']['tel_name']).'</tel>
		  <adres>'.Clean($val['order']['adr_name']).'</adres>
		  <place>'.GetDelivery($val['order']['dostavka_metod'],"city").'</place>
		  <metod>'.$val['order']['order_metod'].'</metod>
		  <status>'.$GetOrderStatusArray[$val['statusi']]['name'].'</status>
		  <color>'.$GetOrderStatusArray[$val['statusi']]['color'].'</color>
		  <time>'.$val['time'].'</time>
		  <summa>'.ReturnSumma($val['cart']['sum'],$val['order']['discount']).'</summa>
		  <num>'.$val['cart']['num'].'</num>
		  <kurs>'.$val['cart']['kurs'].'</kurs>';
$XML.='</order>
';
}
$XML.='</orderdb>';
echo $XML;
break;


case("loadNumNew"):
$sql="select id from ".$SysValue['base']['table_name1']." where statusi=0";
$result=mysql_query($sql);
$num=mysql_numrows($result);
if($num==0) echo "";
  else echo $num;
break;

// Данные по заказу
case ("loadIdOrder"):
//error_reporting(0);
if(!empty($id)){
$OrdersReturn=OrdersReturn($id);
$XML='<?xml version="1.0" encoding="windows-1251"?>
<orderdb>';

foreach ($GetOrderStatusArray as $status)
 @$XMLS.='
  <status>
    <sid>'.$status['id'].'</sid>
	<sname>'.$status['name'].'</sname>
 </status>
 ';

$XML.='<order>
	      <data>'.dataV($OrdersReturn['order']['data']).'</data>
          <datas>'.$OrdersReturn['datas'].'</datas>
		  <uid>'.$OrdersReturn['order']['ouid'].'</uid>
		  <name>'.Clean($OrdersReturn['order']['name_person']).'</name>
		  <mail>'.Clean($OrdersReturn['order']['mail']).'</mail>
		  <tel_code>'.Clean($OrdersReturn['order']['tel_code']).'</tel_code>
		  <tel_name>'.Clean($OrdersReturn['order']['tel_name']).'</tel_name>
		  <adres>'.Clean($OrdersReturn['order']['adr_name']).'</adres>
		  <dos_ot>'.Clean($OrdersReturn['order']['dos_ot']).'</dos_ot>
		  <dos_do>'.Clean($OrdersReturn['order']['dos_do']).'</dos_do>
		  <discount>'.Clean($OrdersReturn['order']['discount']).'</discount>
		  <manager>'.$OrdersReturn['manager'].'</manager>
		  <place>'.GetDelivery($OrdersReturn['order']['dostavka_metod'],"city").'</place>
		  <place_price>'.GetDelivery($OrdersReturn['order']['dostavka_metod'],"price").'</place_price>
		  <metod>'.OplataMetod($OrdersReturn['order']['order_metod']).'</metod>
		  <metod_id>'.$OrdersReturn['order']['order_metod'].'</metod_id>
		  <org_name>'.Clean($OrdersReturn['order']['org_name']).'</org_name>
		  <statusi>'.$OrdersReturn['statusi'].'</statusi>
		  <time>'.$OrdersReturn['time'].'</time>
		  <statuslist2>
		  '.$XMLS.'
		  </statuslist2>
		  </order>
		  <productlist>
		  ';



if(is_array($OrdersReturn['cart']['cart']))
foreach ($OrdersReturn['cart']['cart'] as $vals)
  $XML.='
  <product>
    <id>'.$vals['id'].'</id>
	<art>#'.$vals['uid'].'</art>
	<p_name>'.$vals['name'].'</p_name>
	<pic>'.ReturnPic($vals['id']).'</pic>
	<price>'.ReturnSumma($vals['price'],$OrdersReturn['order']['discount']).'</price>
	<num>'.$vals['num'].'</num>
 </product>
 ';
$XML.='
</productlist>
</orderdb>';
echo $XML;
}
break;

case("orderUpdate"):
OrderUpdateXml();
break;

}
?>
