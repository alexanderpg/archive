<?
/*
+-------------------------------------+
|  PHPShop 2.1 Enterprise             |
|  Модуль ResultUrl                   |
+-------------------------------------+
*/


function UpdateNumOrder($uid){
$last_num = substr($uid, -2);
$total=strlen($uid);
$ferst_num = substr($uid,0,($total-2));
return $ferst_num."-".$last_num;
}

// ROBOXchange
if(isset($crc)){

// as a part of ResultURL script
// your registration data
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //логин
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // пароль2

// HTTP parameters: $out_summ, $inv_id, $crc
$crc = strtoupper($crc);   // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

}
// WebMoney
elseif(isset($LMI_PAYMENT_NO)){

$my_crc = "NoN";
$crc = "NoN";
$inv_id = $LMI_PAYMENT_NO;
}
// RBS
elseif(isset($inv)){
$my_crc = "NoN";
$crc = "NoN";
$d_hash1=base64_decode($inv);
$mH=substr($d_hash1,2,strlen($d_hash1));
$mT=substr($mH,0,strlen($mH)-5);
$inv_id=base64_decode($mT);
}
// Interkassa
elseif(isset($ik_payment_id)){

$my_crc = "NoN";
$crc = "NoN";
$inv_id = $ik_payment_id;
}
else { 
$my_crc=1;
$crc=2;
$inv_id="NoNe";
}


if (strtoupper(@$my_crc) != strtoupper(@$crc))
{
 $SysValue['other']['orderNum']=TotalClean($inv_id,4);
 $SysValue['other']['mycrc']=$my_crc;
 $SysValue['other']['crc']=$crc;
 $SysValue['other']['DispShop']= ParseTemplateReturn("error/error_payment.tpl");
}
else {
$inv_id=TotalClean($inv_id,4);
$inv_id=UpdateNumOrder($inv_id);

// Приверяем сущ. заказа
$sql="select uid from ".$SysValue['base']['table_name1']." where uid='$inv_id'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
$row=mysql_fetch_array($result);
$uid=$row['uid'];

if($num>0){

$SysValue['other']['numOrder']=$uid;
// print OK signature
$SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_payment_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_payment_mesage_2'];
$SysValue['other']['orderMesage']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);
session_unregister('cart');
}
else {
      $SysValue['other']['DispShop']= ParseTemplateReturn("error/error_payment.tpl");
     }
}

// Подключаем шаблон 
@ParseTemplate($SysValue['templates']['shop']);
?>
