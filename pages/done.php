<?
/*
+-------------------------------------+
|  PHPShop Enterprise 2.1             |
|  Оформление Заказа                  |
+-------------------------------------+
*/


function Summa_cart()
{
global $cart,$LoadItems,$SysValue;
$cid=array_keys($cart);
for ($i=0; $i<count($cid); $i++)
  {
 $j=$cid[$i];
 @$in_cart.="
".$cart[$j]['name']." (".TotalClean($cart[$j]['num'],1)." шт.), ";
 @$sum+=$cart[$j]['price']*$cart[$j]['num'];
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


$dis=array(@$in_cart,@$sum,@$weight);
return @$dis;
}

function Order()
{
global $SysValue,$LoadItems,$_POST,$SERVER_NAME,$sid,$cart;
if(isset($_POST['send_to_order']))
{
// Счет в банк
 if(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==1)
   {
   // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // Подключаем шаблон
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
   
   // Если включено авт. загрузка документов, убираем генерацию счета
   if($LoadItems['System']['1c_load_accounts']!=1)
   @$disp.="
<script language=\"JavaScript1.2\">
miniWinFull('phpshop/forms/1/forma.php?name_person=".$_POST['name_person']."&org_name=".$_POST['org_name']."&ouid=".$_POST['ouid']."&delivery=".$_POST['dostavka_metod']."',650,600);
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
     else    @$disp.="
<script language=\"JavaScript1.2\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
	 
	 
   //session_unregister('cart');
   }
   // Квитанция Сбербанка
   elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==2)
   {
   
   // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // Подключаем шаблон
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
       $disp.="
<script language=\"JavaScript1.2\">
miniWinFull('phpshop/forms/2/forma.php?name_person=".$_POST['name_person']."&org_name=".$_POST['org_name']."&ouid=".$_POST['ouid']."&delivery=".$_POST['dostavka_metod']."',650,550);
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
   //session_unregister('cart');
   }
   // Наличная оплата
    elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==3)
   {
   
   // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // Подключаем шаблон
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
       $disp.="
<script language=\"JavaScript1.2\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
   session_unregister('cart');
   }
   // Rupay
   elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']=="none")
     {
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
 $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 $disp=('
	  <table width=420 align=center bgcolor="#ffffff">
       <tr>
	   <td align=center style="padding-top:30" class=style11>
	  <img src="images/line2.jpg" alt="" width="100" height="1" border="0">
<p><br></p>
	  <form action="http://www.rupay.ru/rupay/pay/index.php" name="pay" method="post">
<input type="hidden" name="pay_id" value="'.$SysValue['rupay']['rupay_id'].'">
<input type="hidden" name="sum_pol" value="'.$sum_pol.'">
<input type="hidden" name="sum_val" value="'.GetValutaIsoOrder().'">
<input type="hidden" name="name_service" value="'.$cart_list[0].'">
<input type="hidden" name="order_id" value="'.$_POST['ouid'].'">
<input type="hidden" name="success_url"  value="http://'.$SERVER_NAME.'/">
<input type="hidden" name="fail_url"  value="http://'.$SERVER_NAME.'/order/">

<BR><A target=_blank href="http://www.e-gold.com/e-gold.asp?cid=161125"><IMG alt=e-gold src="images/bank/egold.gif" border=0></A><IMG src="images/bank/privatmoney.gif" align=absMiddle border=0> <IMG src="images/bank/wunion.gif" align=absMiddle border=0> <IMG src="images/bank/wmz.gif" align=absMiddle border=0> <IMG src="images/bank/paycash.gif" align=absMiddle border=0> <IMG src="images/bank/yandex.gif" align=absMiddle border=0>  <IMG src="images/bank/paypal.gif" align=absMiddle border=0> <BR>
 <p><br></p>
	  <img src="images/line2.jpg" alt="" width="200" height="1" border="0">
<p><br></p>
<table>
<tr>
	<td><img src="images/shop/icon-setup.gif" width="16" height="16" border="0"></td>
	<td align="center"><a href="javascript:history.back(1)"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width="20"></td>
	<td></td>
	<td><img src="images/shop/icon-client-new.gif" alt="" width="16" height="16" border="0" align="left">
	<a href="javascript:pay.submit();">Оплатить через<br>платежную систему</a></td>
</tr>
</table>
</form>
	   </td>
       </tr>
       </table>
	   ');
	 }
	 // CyberPOS 2.0
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==4)
     {
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
 $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 $disp=('
	 <table width=420 align=center bgcolor="#ffffff">
       <tr>
	   <td align=center style="padding-top:30" class=style11>
	   <div align="center">
	   <img src="
	   images/paysyslogo/logo_sm.jpg" alt="" width="96" height="61" border="0">
	   </div>
	  <img src="images/line2.jpg" alt="" width="100" height="1" border="0">
<p><br></p>
<P class=l><BR><IMG height=23 alt=VISA src="images/paysyslogo/card_visa.gif" width=36 border=0> <IMG height=23 alt=EUROCARD hspace=0 src="images/paysyslogo/card_eurocard.gif" width=39 border=0> <IMG height=23 alt=MasterCard hspace=0 src="images/paysyslogo/card_mastercard.gif" width=42 border=0> <IMG height=23 alt="Diners Club" hspace=0 src="images/paysyslogo/card_dinersclub.gif" width=39 border=0> <IMG height=29 alt=JCB hspace=0 src="images/paysyslogo/card_jcblogo.gif" width=24 border=0> <IMG height=23 alt="American Express" hspace=0 src="images/paysyslogo/card_amex.gif" width=39 border=0> <IMG height=23 alt="Union Card" hspace=0 src="images/paysyslogo/card_union.gif" width=34 border=0> <IMG height=23 alt="STB Card" hspace=0 src="images/paysyslogo/card_stb.gif" width=37 border=0>
<p><br></p>
	  <form action="/cgi-bin/Shop/cybercrd.cgi" method="post" name="pay">
	  
<INPUT NAME="OrderID" TYPE=HIDDEN VALUE="'.$_POST['ouid'].'">
<INPUT NAME="Currency" TYPE=HIDDEN VALUE="'.GetValutaIsoOrder().'">
<INPUT NAME="Amount" TYPE=HIDDEN VALUE="'.$sum_pol.'">
<INPUT NAME="PaymentDetails" TYPE=HIDDEN VALUE="'.$cart_list[0].'">
<INPUT NAME="FirstName" TYPE=HIDDEN VALUE="'.$_POST['name_person'].'">
<INPUT NAME="LastName" TYPE=HIDDEN VALUE="'.$_POST['name_person'].'">
<INPUT NAME="Email" TYPE=HIDDEN VALUE="'.$_POST['mail'].'">
<INPUT NAME="Phone" TYPE=HIDDEN VALUE="'.$_POST['tel_code'].'">
<INPUT NAME="return_url" TYPE=HIDDEN VALUE="http://'.$SERVER_NAME.'"">
<table>
<tr>
	<td><img src="images/shop/icon-setup.gif" width="16" height="16" border="0"></td>
	<td align="center"><a href="javascript:history.back(1)"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width="20"></td>
	<td></td>
	<td><img src="images/shop/icon-client-new.gif" alt="" width="16" height="16" border="0" align="left">
	<a href="javascript:pay.submit();">Продолжить оплату</a></td>
</tr>
</table>
</form>
	   </td>
       </tr>
       </table>
	   ');
	 }
	 // ROBOXchange
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==5)
     {
	 
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
 $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 
	 // регистрационная информация
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //логин
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // пароль1

//параметры магазина
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //номер счета

//описание покупки
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $sum_pol*$SysValue['roboxchange']['mrh_kurs']; //сумма покупки
$shp_item = 2;                //тип товара

// формирование подписи
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_item=$shp_item");

// вывод HTML страницы с кнопкой для оплаты
$disp= "
<div align=\"center\">
<img src=\"images/bank/robot.gif\"  width=\"350\" height=\"72\" border=\"0\">
<p>
<b>ROBOXchange</b> работает с основными платежными системами России и всего мира.
Наши услуги мы разделяем на обменные и платежные. С помощью сервиса ROBOXchange можно осуществить обмен WM - обмен WMZ, обмен WMR, обмен других титульных знаков WebMoney , обмен e-gold, Яндекс Деньги, Money Mail, E-Bullion, Pecunix и других электронных валют. Все обменные операции осуществляются в автоматическом режиме мгновенно и требуют минимального участия пользователя. Используя ROBOXchange, Вы можете быть уверены, что Ваши деньги надежно защищены. 
</p>
<DIV class=buttons>
<A href=\"http://webmoney.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_WebMoney.gif\" border=0></A> <A href=\"http://money.yandex.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_Yandex.gif\" border=0></A> <A href=\"http://rupay.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_RuPay.gif\" border=0></A> <A href=\"https://www.moneymail.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_MoneyMail.gif\" border=0></A> <BR><A href=\"http://www.e-gold.com/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_Egold.gif\" border=0></A> <A href=\"http://www.ukrmoney.com/\" target=_blank><IMG  src=\"images/bank/ban_UkrMoney.gif\" border=0></A> <A href=\"http://www.emoney.md/\" target=_blank><IMG src=\"images/bank/ban_EmoneyMD.gif\" border=0></A> </DIV>
 <p><br></p>



      <form action='https://www.roboxchange.com/ssl/calc.asp' method=POST name=\"pay\">
      <input type=hidden name=mrh value=$mrh_login>
      <input type=hidden name=out_summ value=$out_summ>
      <input type=hidden name=inv_id value=$inv_id>
      <input type=hidden name=inv_desc value=$inv_desc>
	  <input type=hidden name=crc value=$crc>
	  <input type=hidden name=shp_item value=$shp_item>
	  <table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\">Оплатить через платежную систему</a></td>
</tr>
</table>
      </form>
</div>";
	 
	 //session_unregister('cart');
	 }
	 // WebMoney
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==6)
     {
	 
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1]);
 $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 
	 // регистрационная информация
$LMI_PAYEE_PURSE = $SysValue['webmoney']['LMI_PAYEE_PURSE'];    //кошелек
$wmid = $SysValue['webmoney']['wmid'];    //аттестат

//параметры магазина
//$inv_id    = $_POST['ouid'];       //номер счета

//параметры магазина
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //номер счета


//описание покупки
$inv_desc  = "Оплата заказа №$inv_id";
$out_summ  = $sum_pol*$SysValue['webmoney']['kurs']; //сумма покупки



// вывод HTML страницы с кнопкой для оплаты
$disp= "
<div align=\"center\">

<p>
<img src=\"images/bank/webmoney_logo.gif\" width=\"307\" height=\"63\" border=\"0\">
</p>


<!-- begin WebMoney Transfer : attestation label --> 
<a href=\"https://passport.webmoney.ru/asp/certview.asp?wmid=$wmid\" target=_blank><IMG SRC=\"images/bank/attestated10.gif\" title=\"Здесь находится аттестат нашего WM идентификатора $wmid\" border=\"0\"><br><font size=1>Проверить аттестат</font></a>
<!-- end WebMoney Transfer : attestation label --> 

 <p><br></p>



      <form id=pay name=pay method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" name=\"pay\">


    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
	<input type=hidden name=LMI_SIM_MODE value=\"0\">

	  
	  <table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\">Оплатить через платежную систему</a></td>
</tr>
</table>
      </form>
</div>";
	 
	 //session_unregister('cart');
	 }
	  // Z-Payment
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==7)
     {
	 
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1]);
     $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 
	 // регистрационная информация
$LMI_PAYEE_PURSE = $SysValue['z-payment']['LMI_PAYEE_PURSE'];    //кошелек
$LMI_ID = $SysValue['z-payment']['LMI_ID']; 
//$wmid = $SysValue['webmoney']['wmid'];    //аттестат

//параметры магазина
$inv_id    = $_POST['ouid'];       //номер счета

//описание покупки
$inv_desc  = "Оплата заказа №$inv_id";
$out_summ  = $sum_pol*$SysValue['z-payment']['kurs']; //сумма покупки



// вывод HTML страницы с кнопкой для оплаты
$disp= "
<div align=\"center\">

<!-- Аттестат Z-PAYMENT --> 
<a href=\"http://www.z-payment.ru/info.php?zp=$LMI_ID\" target=_blank><IMG SRC=\"images/bank/attestat.gif\" alt=\"Аттестован системой Z-PAYMENT \" border=\"0\" align=\"left\" hspace=\"5\" vspace=\"5\"></a>
<!-- end Аттестат Z-PAYMENT --> 
<strong>Z-PAYMENT</strong> - это универсальная процессинговая система, интегрирующая множество видов оплаты в единый унифицированный алгоритм. Мы предлагаем нашим клиентам гибкий и надежный инструмент для <strong>on-line расчетов</strong>, приема платежей на сайтах, оплаты различных услуг и товаров. 



 <p><br></p>



      <form id=pay name=pay method=\"POST\" action=\"https://z-payment.ru/merchant.php\" name=\"pay\">


    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
    <input type=hidden name=CLIENT_MAIL value=\"".$_POST['mail']."\">
	  
	  <table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\">Оплатить через платежную систему</a></td>
</tr>
</table>
      </form>
</div>";
	 
	 //session_unregister('cart');
	 }
	  // PBC
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==8)
     {
	 
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1]);
     $sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
	 
	 // регистрационная информация
$MERCHANTNUMBER = $SysValue['rbs']['MERCHANTNUMBER'];    //кошелек
$MERCHANTPASSWD = $SysValue['rbs']['MERCHANTPASSWD']; 
$KEY=$SysValue['rbs']['KEY']; 

//параметры магазина
$inv_id    = $_POST['ouid'];       //номер счета

//описание покупки
$inv_desc  = "$inv_id";
$out_summ  = $sum_pol*$SysValue['rbs']['kurs']; //сумма покупки


$HASH=$MERCHANTNUMBER.$MERCHANTPASSWD.$inv_id.$KEY;
$LMI_HASH = substr(strtoupper(md5("$HASH")),0,10);
$MY_BACKURL=base64_encode("id=$inv_id&h=$LMI_HASH&s=$out_summ");
$url="/bpcservlet/Merchant2Rbs?MERCHANTNUMBER=$MERCHANTNUMBER&ORDERNUMBER=$inv_id&AMOUNT=$out_summ&BACKURL=http://$SERVER_NAME/payment/rbs/result.php?my=$MY_BACKURL&\$ORDERDESCRIPTION=$inv_desc&LANGUAGE=RU&DEPOSITFLAG=0&MERCHANTPASSWD=$MERCHANTPASSWD";
$fp = fsockopen("engine.paymentgate.ru", 80, $errno, $errstr);
if (!$fp) {
   return exit("Ошибка соединения с сервером PHPShop");
} else {
   fputs($fp, "GET $url HTTP/1.0\r\n"); 
   fputs($fp, "Host: engine.paymentgate.ru\r\n"); 
   fputs($fp, "Connection: close\r\n\r\n");
    $i=0;
    $mdOrder = "";
    $srch = "NAME=MDORDER VALUE=";
   while (!feof ($fp)) {
        $i++;
        $line = fgets ($fp, 1024);
        $i1 = strpos($line, $srch);
        if (is_integer($i1)) {
                $i1 = $i1+strlen($srch);
                $mdOrder = substr($line, $i1, strpos($line, ">",$i1)-$i1);
        }
    }
fclose($fp);
}


// вывод HTML страницы с кнопкой для оплаты
$disp= "
<div align=\"center\">

 <p><br></p>
 
 <img src=\"images/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"images/bank/mastercard.gif\" border=\"0\" hspace=5>
   <img src=\"images/bank/set.gif\" border=\"0\" hspace=5>
  <p><br></p>

<form name=PaymentForm action=\"https://engine.paymentgate.ru/bpcservlet/BPC/AcceptPayment.jsp\"> 
    <INPUT TYPE=Hidden NAME=MDORDER VALUE=\"$mdOrder\"> 
	<table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:PaymentForm.submit();\">Оплатить через платежную систему</a></td>
</tr>
</table>
</form> 
</div>";
	 
	 //session_unregister('cart');
	 }
	 // Interkassa
	  elseif(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart and @$_POST['order_metod']==9)
     {
	 
	 $cart_list=Summa_cart();
	 $ChekDiscount=ChekDiscount($cart_list[1]);
     $GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1]);
$sum_pol=(ReturnSummaNal($cart_list[1],$order['Person']['discount'])+$GetDeliveryPrice);
//$sum_pol=$cart_list[1];


 
	 // регистрационная информация
$LMI_PAYEE_PURSE = $SysValue['interkassa']['LMI_PAYEE_PURSE'];    //кошелек
$LMI_SECRET_KEY = $SysValue['interkassa']['LMI_SECRET_KEY'];    //кошелек

//параметры магазина
//$inv_id    = $_POST['ouid'];       //номер счета

//параметры магазина
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //номер счета


//описание покупки
$inv_desc  = "Оплата заказа №$inv_id";
$out_summ  = $sum_pol; //сумма покупки


// Тест
//$out_summ=0.5;



$ik_shop_id = $LMI_PAYEE_PURSE;
$ik_payment_amount = $out_summ;
$ik_payment_id = $inv_id;
$ik_payment_desc = $inv_desc;
$ik_paysystem_alias = '';
$ik_sign_hash = '';
$ik_baggage_fields = '';
$secret_key = $LMI_SECRET_KEY;

$ik_sign_hash_str = $ik_shop_id.':'.
$ik_payment_amount.':'.
$ik_payment_id.':'.
$ik_paysystem_alias.':'.
$ik_baggage_fields.':'.
$secret_key;

$ik_sign_hash = md5($ik_sign_hash_str);



// вывод HTML страницы с кнопкой для оплаты
$disp= "
<div align=\"center\">

 <p><br></p>

<form name=\"pay\" action=\"https://interkassa.com/lib/payment.php\" method=\"post\" target=\"_top\">
<input type=\"hidden\" name=\"ik_shop_id\" value=\"$LMI_PAYEE_PURSE\">
<input type=\"hidden\" name=\"ik_payment_amount\" value=\"$out_summ\">
<input type=\"hidden\" name=\"ik_payment_id\" value=\"$inv_id\">
<input type=\"hidden\" name=\"ik_payment_desc\" value=\"$inv_desc\">
<input type=\"hidden\" name=\"ik_paysystem_alias\" value=\"\">
<input type=\"hidden\" name=\"ik_sign_hash\" value=\"$ik_sign_hash\">

	  <table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\"><u>Оплатить через платежную систему</u></a></td>
</tr>
</table>
      </form>
</div>";
	 
	 //session_unregister('cart');
	 }
   else
      {
	  // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2'];
   
   // Подключаем шаблон
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
	  $disp.="
	  <table>
<tr>
	<td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	Вернуться к оформлению<br>
	покупки</u></a></td>
</tr>
</table>
	   ";
	  }
}
elseif(!@$cart)
     {
	 // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_cart_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // Подключаем шаблон
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
	 }
return @$disp;
}

// Определяем переменые
$SysValue['other']['orderMesage']=Order();
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);
$SysValue['other']['catalogCat']= "Оформление заказа";
$SysValue['other']['catalogCategory']= "Заказ оформлен";

// Подключаем шаблон 
@ParseTemplate($SysValue['templates']['shop']);
?>

	