<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");


function OplataMetod($tip){
if($tip==1) return "Счет в банк";
if($tip==2) return "Квитанция";
if($tip==3) return "Наличная";
}


function ReturnSumma($sum,$disc){
$sum=$sum-($sum*$disc/100);
return $sum;
}

if(isset($orderID)){
$orderID=htmlspecialchars($orderID);
$sql="select * from $table_name1 where id='$orderID'";
$result=mysql_query($sql);
$num=0;
$csv1="Начало личных данных;;;;;;;;;;\n";
$csv2="Начало заказанных товаров;;;;;;;;;;\n";
$row = mysql_fetch_array($result);
    $id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$num=$row['num'];
	$mail=$order['Person']['mail'];
	$name=$order['Person']['name_person'];
	$conpany=str_replace("&quot;","",$order['Person']['org_name']);
	$inn=$order['Person']['org_inn'];
	$tel=$order['Person']['tel_name'];
	$adres=str_replace("&quot;","",$order['Person']['adr_name']);
	$oplata=OplataMetod($order['Person']['order_metod']);
	$sum=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	$discount=$order['Person']['discount'];
	if($discount>0) $discountStr="- скидка $discount%";
	else $discountStr="";
	$csv1.="$uid;$datas;$mail;$name $discountStr;$conpany;$tel;$oplata;$sum;$discount;$inn;\n";

  if(is_array($order['Cart']['cart']))
  foreach($order['Cart']['cart'] as $val){
  $id=$val['id'];
  $uid=$val['uid'];
  $num=$val['num'];
  $sum=ReturnSumma($val['price']*$num,$order['Person']['discount']);
  $csv2.="$id;$uid;$num;$sum;;;;;;;\n";
  }

  $csv=$csv1.$csv2;
  $file=$row['uid'].".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  }
//sleep(1);
//exit("../csv/".$file);
header("Location: ../csv/".$file);
}
?>
