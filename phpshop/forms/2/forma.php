<?
session_start();

// Сбербанк

// Парсируем установочный файл
$SysValue=parse_ini_file("./../../inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
@mysql_query("SET NAMES 'cp1251'");

// Подключаем модули
include("../../inc/engine.inc.php");            // Модуль движка
include("../../inc/order.inc.php");            // Модуль движка
include("../../inc/cache.inc.php");
include("../../inc/mail.inc.php");

// Подключаем кеш
$LoadItems=CacheReturnBase($sid);

function dataV($nowtime){
$Months = array("01"=>"января","02"=>"февраля","03"=>"марта", 
 "04"=>"апреля","05"=>"мая","06"=>"июня", "07"=>"июля",
 "08"=>"августа","09"=>"сентября",  "10"=>"октября",
 "11"=>"ноября","12"=>"декабря");
$curDateM = date("m",$nowtime); 
$t=date("d",$nowtime).".".$curDateM.".".date("y",$nowtime).""; 
return $t;
}

// Подключаем реквизиты
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];

if($org_name=="") $org_name=$name_person;

if(isset($tip) and isset($orderId) and isset($datas)){
$orderId=TotalClean($orderId,5);
$UsersId=TotalClean($_SESSION['UsersId'],1);

if(@$tip==2)
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and datas=".$datas;

if(@$tip==1 and isset($_SESSION['UsersId']))
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and user=$UsersId";

@$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
@$num=mysql_num_rows(@$result);
if($num==0) exit("Неавторизованный пользователь!");
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	@$sum=number_format($order['Cart']['sum'],"2",".","");
	 $name_person=$order['Person']['name_person'];
	$ChekDiscount=ChekDiscount($sum);
	$deliveryPrice=GetDeliveryPrice($order['Person']['dostavka_metod'],$sum,$order['Cart']['weight']);
    //$Summa=GetPriceOrder($ChekDiscount[1])+$deliveryPrice;
	$Summa=(ReturnSummaBeznal($sum,$order['Person']['discount'])+$deliveryPrice);
 sscanf(number_format($Summa,"2",".",""), "%d.%s", $sum_rub, $sum_kop); // получаем копейки
}
// Всплывающее окно
else
if(count(@$cart)>0)// вывод корзины
  {
$cid=array_keys($cart);
for ($i=0,$n=1; $i<count($cid); $i++,$n++)
  {
  $j=$cid[$i];
   @$sum+=$cart[$j]['price']*$cart[$j]['num'];
   @$num+=$cart[$j]['num'];

//Определение и суммирование веса
 $goodid=$cart[$j]['id'];
 $goodnum=$cart[$j]['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //Один из товаров имеет нулевой вес!
 $weight+=$cweight;


  }

//Обнуляем вес товаров, если хотя бы один товар был без веса
if ($zeroweight) {$weight=0;}


 @$nds=number_format($sum*18/118,"2",".","");
 @$sum=number_format($sum,"2",".","");
 
 // Скидка
 $ChekDiscount=ChekDiscount($sum);
 
 // Доставка
 $deliveryPrice=GetDeliveryPrice($_GET['delivery'],$sum,$weight);
 
 // получаем копейки
 $Summa=(ReturnSummaBeznal($sum,$ChekDiscount[0])+$deliveryPrice);
 sscanf(number_format($Summa,"2",".",""), "%d.%s", $sum_rub, $sum_kop); 
  }
if(!$_SESSION['sid']) header("Location: /");
$GetIsoValutaOrder=GetIsoValutaOrder();


if(!$datas) $datas=date("d-m-y");
else $datas=dataV($datas);
?>
<html>
<head>
<title>Квитанция Сбербанка заказ № <?=@$ouid?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">

<style type="text/css">
<!-- 
body {
	text-decoration: none;
	font: normal 9px x-small/normal Verdana, Arial, Helvetica, sans-serif;
	text-transform: none;
}
TABLE {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
}
P {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	word-spacing: normal;
	white-space: normal;
	margin: 5px 5px 5px 5px;
	letter-spacing : normal;
}
TD {
	white-space: nowrap;
}
.comment {
	font-size: 7px;
}
.data {
	border-bottom: 1px solid #000000;
	white-space: nowrap;
}
--></style>
<style media="print" type="text/css">
<!-- 
.nonprint {
	display: none;
}
 -->
</style>
<script>
window.resizeTo(650, 550);
</script>
</head>
<body  onload="window.focus()" bgcolor="#FFFFFF" text="#000000">
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" style="color: #0078BD;"><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif" >Распечатать</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;" style="color: #0078BD;">Сохранить на диск<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>
<table cellpadding=2 cellspacing=0>
	<col style="padding-bottom: 5px;" width=30% height=50%>
	<col width=70% height=50%>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" valign=top height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr><td width=100% height=100% valign=top align=right>ИЗВЕЩЕНИЕ</td></tr>
			<tr><td width=100% align=left valign=bottom>Кассир</td></tr>
		</table></td>
		<td style="border-bottom: 1px solid #000000; padding-right: 0px;" height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr>
				<td class=data align=center width=100%><div style="width: 100%;"><?=$SysValue['bank']['org_name']?></div></td>
			</tr>
			<tr>
				<td align=center class=comment>(наименование получателя платежа)</td>
			</tr>
			<tr>
				<td width=100%><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td></td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_inn']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>№</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2 class=comment>(ИНН получателя платежа)</td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(номер счета получателя платежа)</td>
					</tr>
					<tr>
						<td colspan=6><?=$SysValue['bank']['org_bank']?></td>
					</tr>
					<tr>
						<td>БИК</td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_bic']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>№</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_bank_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2></td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(номер кор./с банка получателя платежа)</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 16px;">Плательщик</td>
					<td class=data width=100%><?=@$name_person?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 5px;" nowrap>Назначение платежа</td>
					<td class=data width=100%>Оплата заказа № <?=@$ouid?> от <?=$datas?></td>
				</table></td>
			</tr>
<?

?>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>Сумма платежа</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>коп.</td>
						<td width=100%></td>
					</tr>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>Итого</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>коп.</td>
						<td width=100%></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><div height=20>&nbsp;</div></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<td style="padding-right: 4px;">Плательщик</td>
					<td width=80 class=data><div width=80>&nbsp;</div></td>
					<td style="padding-left: 2px;">(подпись)</td>
					<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
					<td class=data width=85><div width=85>&nbsp;</div></td>
					<td>200&nbsp;&nbsp;г.</td>
				</table></td>
			</tr>
			<tr>
				<td align=left>С условием приема банком суммы, указанной в платежном документе, </td>
			</tr>
			<tr>
				<td><table cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td>ознакомлен и согласен.</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>200&nbsp;&nbsp;г.</td>
					</tr>
					<tr>
						<td colspan=2 align=right style="padding-right: 10px;" class=comment>(подпись плательщика)</td>
						<td></td>
						<td class=comment align=center>(Дата)</td>
						<td></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" valign=top height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr><td width=100% height=100% valign=bottom align=right>КВИТАНЦИЯ</td></tr>
			<tr><td width=100% align=left valign=bottom>Кассир</td></tr>
		</table></td>
		<td style="border-bottom: 1px solid #000000; padding-right: 0px;" height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr>
				<td class=data align=center width=100%><div style="width: 100%;"><?=$SysValue['bank']['org_name']?></div></td>
			</tr>
			<tr>
				<td align=center class=comment>(наименование получателя платежа)</td>
			</tr>
			<tr>
				<td width=100%><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td></td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_inn']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>№</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2 class=comment>(ИНН получателя платежа)</td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(номер счета получателя платежа)</td>
					</tr>
					<tr>
						<td colspan=6><?=$SysValue['bank']['org_bank']?></td>
					</tr>
					<tr>
						<td>БИК</td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_bic']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>№</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_bank_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2></td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(номер кор./с банка получателя платежа)</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 16px;">Плательщик</td>
					<td class=data width=100%><?=@$name_person?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 5px;" nowrap>Назначение платежа</td>
					<td class=data width=100%>Оплата заказа № <?=@$ouid?> от <?=$datas?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>Сумма платежа</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>коп.</td>
						<td width=100%></td>
					</tr>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>Итого</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>коп.</td>
						<td width=100%></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><div height=20>&nbsp;</div></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<td style="padding-right: 4px;">Плательщик</td>
					<td width=80 class=data><div width=80>&nbsp;</div></td>
					<td style="padding-left: 2px;">(подпись)</td>
					<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
					<td class=data width=85><div width=85>&nbsp;</div></td>
					<td>200&nbsp;&nbsp;г.</td>
				</table></td>
			</tr>
			<tr>
				<td align=left>С условием приема банком суммы, указанной в платежном документе, </td>
			</tr>
			<tr>
				<td><table cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td>ознакомлен и согласен.</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>200&nbsp;&nbsp;г.</td>
					</tr>
					<tr>
						<td colspan=2 align=right style="padding-right: 10px;" class=comment>(подпись плательщика)</td>
						<td></td>
						<td class=comment align=center>(Дата)</td>
						<td></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table>
<?
//session_unregister('cart');
?>
</body>
</html>