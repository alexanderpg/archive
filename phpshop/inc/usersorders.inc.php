<?

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


// Вывод заказов
function GetUsersOrdersList($n,$tip){
global $SysValue,$_GET;
$n=TotalClean($n,1);
if($tip==2) $sql="select * from ".$SysValue['base']['table_name1']." where uid='".htmlspecialchars($n)."'";
if($tip==1) $sql="select * from ".$SysValue['base']['table_name1']." where user='$n' order by datas desc";
$result=mysql_query($sql) or die("Брось эту затею, пофиксино...<br>Техническая поддержка: <A href=\"mailto:support@phpshop.ru\">support@phpshop.ru</A>");
while(@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$statusi=$row['statusi'];
	if($tip==1) $link="?orderId=$uid#PphpshopOrder";
	else $link="/users/register.html";
	
	$GetOrderStatusArray=GetOrderStatusArray();
	if($statusi==0){ 
	$bg="C0D2EC";
	$status_name="Новый заказ";
	}
	else{
	$bg=$GetOrderStatusArray[$statusi]['color'];
	$status_name=$GetOrderStatusArray[$statusi]['name'];
	}
	
	
	$docsLink2='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/2/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_dialog.gif" alt="Квитанция Сбербанка" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
	$docsLink1='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/1/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_browser.gif" alt="Счет в банк" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
    if($order['Person']['order_metod']==3)  $docsLink="";
	
	$SummaOrder=ReturnSummaNal($order['Cart']['sum'],$order['Person']['discount']);
	
@$dis.='

<tr>
	<td id=allspecwhite>
	<a href="'.$link.'" class="b" title="Информация о заказе № '.$uid.'"><img src="images/shop/icon-setup.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">'.$uid.'</a>
	</td>
	<td id=allspecwhite>
	'.dataV($datas).'
	</td>
	<td id=allspecwhite>
	'.(0+$order['Cart']['num']).'
	</td>
	<td id=allspecwhite>
	'.$order['Person']['discount'].'
	</td>
	<td id=allspecwhite>
	'.($SummaOrder+$order['Cart']['dostavka']).' '.GetValutaOrder().'
	</td>
	<td  bgcolor="'.$bg.'">
	'.$status_name.'
	</td>
';
}
$dis='
<table width="100%" id=allspecwhite cellpadding=3>
<tr>
	<td id=allspec>
	<b>№ Заказа</b>
	</td>
	<td id=allspec>
	<b>Дата</b>
	</td>
	<td id=allspec>
	<b>Кол-во</b>
	</td>
	<td id=allspec>
	<b>Скидка %</b>
	</td>
	<td id=allspec>
	<b>Сумма</b>
	</td>
	<td id=allspec>
	<b>Статус</b>
	</td>
</tr>
'.$dis.'
</table>';
return $dis;
}


// Вывод заказов инфо
function GetUsersOrdersInfo($n,$tip=1){
global $SysValue,$_GET,$LoadItems;
$n=TotalClean($n,1);
$sql="select * from ".$SysValue['base']['table_name1']." where uid=$n";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
$row = mysql_fetch_array(@$result);
	$id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$statusi=$row['statusi'];
	$GetOrderStatusArray=GetOrderStatusArray();
	if($statusi==0){ 
	$bg="C0D2EC";
	$status_name="Новый заказ";
	}
	else{
	$bg=$GetOrderStatusArray[$statusi]['color'];
	$status_name=$GetOrderStatusArray[$statusi]['name'];
	}
	
$cart=$order['Cart']['cart'];
  if(sizeof($cart)!=0)
  foreach(@$cart as $val){
  $disCart.="
<tr>
  <td id=allspecwhite><a href=\"/shop/UID_".$val['id'].".html\" target=\"_blank\" class=b title=\"".$val['name']."\">".$val['name']."</a></td>
  <td id=allspecwhite>".$val['num']."</td>
  <td id=allspecwhite>".ReturnSummaNal($val['price']*$val['num'],$order['Person']['discount'])." 
 ".GetValutaOrder()."</td>
</tr>
";
@$num+=$val['num'];
@$sum+=$val['price']*$val['num'];
}

// Итоговая сумма
$TotalSumOrder = (ReturnSummaNal($sum,$order['Person']['discount'])+$order['Cart']['dostavka']);

$disCart.="
<tr>
  <td id=allspecwhite>Доставка -  ".GetDeliveryBase($order['Person']['dostavka_metod'],"city")."</td>
  <td id=allspecwhite>1</td>
  <td id=allspecwhite>".$order['Cart']['dostavka']." 
 ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite>Итого с учетом скидки <b>".$order['Person']['discount']."</b>%</td>
  <td id=allspecwhite><b>".$num."</b> шт.</td>
  <td colspan=\"2\" id=allspecwhite><b>".$TotalSumOrder."</b> ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite><img src=\"images/shop/icon_clock.gif\" alt=\"Время изменения статуса заказа\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5>Время обработки заказа: ".$status['time']."</td>
  <td colspan=\"3\" bgcolor=".$bg.">
	".$status_name."
	</td>
</tr>
<tr>
  <td id=allspec><strong>Документооборот</strong> ".$status['time']."</td>
  <td colspan=\"3\" id=allspecwhite>
  <table cellpadding=1 cellspacing=1>
</td>
</tr>
";

  $option=unserialize($LoadItems['System']['admoption']);
  if($option['oplata_2'] == 1)
  $disCart.="<tr>
	<td><a href=\"javascript:void(0)\"  class=b  title=\"Квитанция Сбербанка\" onclick=\"miniWinFull('phpshop/forms/2/forma.html?orderId=$id&tip=$tip&datas=$datas',650,550);\" ><img src=\"images/shop/interface_dialog.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5 alt=\"Квитанция Сбербанка\">Квитанция Сбербанка</a></td>
</tr>";
  if($option['oplata_1'] == 1)
  $disCart.="<tr>
	<td><a href=\"javascript:void(0)\" class=b title=\"Счет в банк\" onclick=\"miniWinFull('phpshop/forms/1/forma.html?orderId=$id&tip=$tip&datas=$datas',650,550);\" ><img src=\"images/shop/interface_browser.gif\" alt=\"Счет в банк\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" vspace=3  hspace=5>Счет в банк</a></td>
</tr>";
  if($option['oplata_5'] == 1){
  
 // регистрационная информация
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //логин
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // пароль1

//параметры магазина
$inv_id    = $uid;       //номер счета

//описание покупки
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $TotalSumOrder*$SysValue['roboxchange']['mrh_kurs']; //сумма покупки
$shp_item = 2;                //тип товара

// формирование подписи
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_item=$shp_item");
  
  $disCart.="<tr>
	<td>
	 <form action='https://www.roboxchange.com/ssl/calc.asp' method=POST name=\"payrobots\">
      <input type=hidden name=mrh value=$mrh_login>
      <input type=hidden name=out_summ value=$out_summ>
      <input type=hidden name=inv_id value=$inv_id>
      <input type=hidden name=inv_desc value=$inv_desc>
	<a href=\"javascript:void(0)\" class=b title=\"Оплатить ROBOXchange\" onclick=\"javascript:payrobots.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"Обменная касса ROBOXchange\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>Обменная касса ROBOXchange</a></form></td>
</tr>";
}
  if($option['oplata_6'] == 1){ // WebMoney
   
   // регистрационная информация
   $LMI_PAYEE_PURSE = $SysValue['webmoney']['LMI_PAYEE_PURSE'];    //кошелек
   $wmid = $SysValue['webmoney']['wmid'];    //аттестат
   
   //параметры магазина
   $inv_id    = $uid;       //номер счета
   
    //описание покупки
    $inv_desc  = "Оплата заказа №$inv_id";
    $out_summ  = $TotalSumOrder*$SysValue['webmoney']['kurs']; //сумма покупки
	
   $disCart.="<tr>
	<td>
	 <form id=pay name=paywebmoney method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" name=\"paywebmoney\">
    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
	<input type=hidden name=LMI_SIM_MODE value=\"0\">
	<a href=\"javascript:void(0)\" class=b title=\"Оплатить WebMoney\" onclick=\"javascript:paywebmoney.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"WebMoney\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>WebMoney</a>
</form>
</td>
</tr>";
   }

$disCart.="  </table></td>
</tr>";

$disCart='<table width="100%" id=allspecwhite cellpadding=3>
<tr>
  <td id=allspec><b>Наименование</b></td>
  <td id=allspec><b>Кол-во</b></td>
  <td id=allspec><b>Сумма</b></td>
</tr>
'.$disCart.'
</table>';

if(!empty($status['maneger']))
$disCart.='
<div id=allspec>
<img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>Дополнительная информация</b>
</div>
<p>
<img src="images/shop/icon_user.gif" alt="Менеджер" width="16" height="16" border="0" hspace="5" align="absmiddle"><a href="/users/message.html" title="Связь с менеджером" class="b">Менеджер</a>: '.$status['maneger'].'
</p>
';

if($num>0) return $disCart;
else return "<font color=#FF0000>Некорректный номер заказа</font>";
}

// Вывод заказов пользователей
function UsersOrders($UsersId){
global $SysValue,$_POST,$_GET;
$UsersId=TotalClean($UsersId,1);
$dis='
<div id=allspec>
<img src="images/shop/date.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>Архив заказов</b>
</div>
<p>
'.GetUsersOrdersList($UsersId,1).'
</p>';
if(!empty($_GET['orderId']))
$dis.='
<div id=allspec>
<A id="PphpshopOrder"></A>
<img src="images/shop/icon_info.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>Информация по заказу № '.TotalClean($_GET['orderId'],1).'</b>
</div>
<p>
'.GetUsersOrdersInfo($_GET['orderId']).'
</p>
';
return $dis;
}
?>