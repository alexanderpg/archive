<?
require("../../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../../enter_to_admin.php");


class inwords { //класс преобразует числовое представление денег в строковое

var $diw=Array(    0 =>    Array(    0  => Array( 0=> "ноль",    1=>1), 
                1  => Array( 0=> "",        1=>2), 
                2  => Array( 0=> "",        1=>3), 
                3  => Array( 0=> "три",        1=>0), 
                4  => Array( 0=> "четыре",    1=>0), 
                5  => Array( 0=> "пять",    1=>1), 
                6  => Array( 0=> "шесть",    1=>1), 
                7  => Array( 0=> "семь",    1=>1), 
                8  => Array( 0=> "восемь",    1=>1), 
                9  => Array( 0=> "девять",    1=>1), 
                10 => Array( 0=> "десять",    1=>1), 
                11 => Array( 0=> "одинадцать",    1=>1), 
                12 => Array( 0=> "двенадцать",    1=>1), 
                13 => Array( 0=> "тринадцать",    1=>1), 
                14 => Array( 0=> "четырнадцать",1=>1), 
                15 => Array( 0=> "пятнадцать",    1=>1), 
                16 => Array( 0=> "шестнадцать",    1=>1), 
                17 => Array( 0=> "семнадцать",    1=>1), 
                18 => Array( 0=> "восемнадцать",1=>1), 
                19 => Array( 0=> "девятнадцать",1=>1) 
            ), 
        1 =>    Array(    2  => Array( 0=> "двадцать",    1=>1), 
                3  => Array( 0=> "тридцать",    1=>1), 
                4  => Array( 0=> "сорок",    1=>1), 
                5  => Array( 0=> "пятьдесят",    1=>1), 
                6  => Array( 0=> "шестьдесят",    1=>1), 
                7  => Array( 0=> "семьдесят",    1=>1), 
                8  => Array( 0=> "восемьдесят",    1=>1), 
                9  => Array( 0=> "девяносто",    1=>1)  
            ), 
        2 =>    Array(    1  => Array( 0=> "сто",        1=>1), 
                2  => Array( 0=> "двести",    1=>1), 
                3  => Array( 0=> "триста",    1=>1), 
                4  => Array( 0=> "четыреста",    1=>1), 
                5  => Array( 0=> "пятьсот",    1=>1), 
                6  => Array( 0=> "шестьсот",    1=>1), 
                7  => Array( 0=> "семьсот",    1=>1), 
                8  => Array( 0=> "восемьсот",    1=>1), 
                9  => Array( 0=> "девятьсот",    1=>1) 
            ) 
); 

var $nom=Array(    0 => Array(0=>"копейки",  1=>"копеек",    2=>"одна копейка", 3=>"две копейки"), 
        1 => Array(0=>"рубля",    1=>"рублей",    2=>"один рубль",   3=>"два рубля"), 
        2 => Array(0=>"тысячи",   1=>"тысяч",     2=>"одна тысяча",  3=>"две тысячи"), 
        3 => Array(0=>"миллиона", 1=>"миллионов", 2=>"один миллион", 3=>"два миллиона"), 
        4 => Array(0=>"миллиарда",1=>"миллиардов",2=>"один миллиард",3=>"два миллиарда"), 
/* :))) */ 
        5 => Array(0=>"триллиона",1=>"триллионов",2=>"один триллион",3=>"два триллиона") 
); 

var $out_rub; 

function get($summ){ 
 if($summ>=1) $this->out_rub=0; 
 else $this->out_rub=1; 
 $summ_rub= doubleval(sprintf("%0.0f",$summ)); 
 if(($summ_rub-$summ)>0) $summ_rub--; 
 $summ_kop= doubleval(sprintf("%0.2f",$summ-$summ_rub))*100; 
 $kop=$this->get_string($summ_kop,0); 
 $retval=""; 
 for($i=1;$i<6&&$summ_rub>=1;$i++): 
  $summ_tmp=$summ_rub/1000; 
  $summ_part=doubleval(sprintf("%0.3f",$summ_tmp-intval($summ_tmp)))*1000; 
  $summ_rub= doubleval(sprintf("%0.0f",$summ_tmp)); 
  if(($summ_rub-$summ_tmp)>0) $summ_rub--; 
  $retval=$this->get_string($summ_part,$i)." ".$retval; 
 endfor; 
 if(($this->out_rub)==0) $retval.=" рублей"; 
 return $retval." ".$kop; 
} 

function get_string($summ,$nominal){ 
 $retval=""; 
 $nom=-1; 
 $summ=round($summ); 
 if(($nominal==0&&$summ<100)||($nominal>0&&$nominal<6&&$summ<1000)): 
  $s2=intval($summ/100); 
  if($s2>0): 
   $retval.=" ".$this->diw[2][$s2][0]; 
   $nom=$this->diw[2][$s2][1]; 
  endif; 
  $sx=doubleval(sprintf("%0.0f",$summ-$s2*100)); 
  if(($sx-($summ-$s2*100))>0) $sx--; 
  if(($sx<20&&$sx>0)||($sx==0&&$nominal==0)): 
   $retval.=" ".$this->diw[0][$sx][0]; 
   $nom=$this->diw[0][$sx][1]; 
  else: 
   $s1=doubleval(sprintf("%0.0f",$sx/10)); 
   if(($s1-$sx/10)>0)$s1--; 
   $s0=doubleval($summ-$s2*100-$s1*10); 
   if($s1>0): 
    $retval.=" ".$this->diw[1][$s1][0]; 
    $nom=$this->diw[1][$s1][1]; 
   endif; 
   if($s0>0): 
    $retval.=" ".$this->diw[0][$s0][0]; 
    $nom=$this->diw[0][$s0][1]; 
   endif; 
  endif; 
 endif; 
 if($nom>=0): 
  $retval.=" ".$this->nom[$nominal][$nom]; 
  if($nominal==1) $this->out_rub=1; 
 endif; 
 return trim($retval); 
} 

} 


$LoadItems['System']=GetSystems();

function GetValutaOrder(){ // Валюта основная
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['code'];
}


function ReturnLogo(){
global $LoadItems;
if(empty($LoadItems['System']['logo'])) return "../../img/phpshop_logo.gif";
 else return $LoadItems['System']['logo'];
}

function ReturnSumma($sum,$disc){ // Поправки по курсу
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}


// Подключаем реквизиты
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];


$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderID'";
$n=1;
@$result=mysql_query($sql) or die($sql);
$row = mysql_fetch_array(@$result);
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);

 foreach($order['Cart']['cart'] as $val){
 @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>".$val['name']."</td>
		<td class=tablerow align=center>шт.&nbsp;</td>
		<td align=right class=tablerow>".$val['num']."</td>
		<td align=right class=tablerow nowrap>".ReturnSumma($val['price'],0)."</td>
		<td class=tableright>".ReturnSumma($val['price']*$val['num'],0)."</td>
	</tr>
  ";
  @$sum+=$val['price']*$val['num'];
  @$num+=$val['num'];
  $n++;
 }
 $deliveryPrice=GetDeliveryPrice($order['Person']['dostavka_metod'],$sum);
  @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>Доставка - ".GetDelivery($order['Person']['dostavka_metod'],"city")."</td>
		<td class=tablerow align=center>шт.&nbsp;</td>
		<td align=right class=tablerow>1</td>
		<td align=right class=tablerow nowrap>".$deliveryPrice."</td>
		<td class=tableright>".$deliveryPrice."</td>
	</tr>
  ";
  if($LoadItems['System']['nds_enabled']){
 $nds=$LoadItems['System']['nds'];
 @$nds=number_format($sum*$nds/(100+$nds),"2",".","");
 }
 @$sum=number_format($sum,"2",".","");
 
 $summa_nds_dos=number_format($deliveryPrice*$nds/(100+$nds),"2",".","");
 

 $name_person=$order['Person']['name_person'];
 $org_name=$order['Person']['org_name'];
 $datas=dataV($datas,"false");
 
 function OplataMetod($tip){
if($tip==1) return "Счет в банк";
if($tip==2) return "Квитанция";
if($tip==3) return "Наличная оплата";
}
?>
<head>
<title>Бланк Заказа №<?=@$ouid?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<style type="text/css">
body {text-decoration: none;font: normal 11px x-small/normal Verdana, Arial, Helvetica, sans-serif;text-transform: none}
TABLE {font: normal 11px Verdana, Arial, Helvetica, sans-serif;}
p {font: normal 11px Verdana, Arial, Helvetica, sans-serif;word-spacing: normal;white-space: normal;margin: 5px 5px 5px 5px;letter-spacing : normal;} 
TD {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	background: #FFFFFF;
}
H4 {
	font: Verdana, Arial, Helvetica, sans-serif;
	background: #FFFFFF;
}
.tablerow {
	border: 0px;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
}
.tableright {
	border: 0px;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
	border-right: 1px solid #000000;
	text-align: right;
}
</style>
<style media="print" type="text/css">
<!-- 
.nonprint {
	display: none;
}
 -->
</style>
</head>
<body onload="window.focus()" bgcolor="#FFFFFF" text="#000000" marginwidth=5 leftmargin=5 style="padding: 2px;">
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" ><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif">Распечатать</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;">Сохранить на диск<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>
<div align="center"><table align="center" width="100%">
<tr>
	<td align="center"><img src="<?echo ReturnLogo();?>" alt="" border="0"></td>
	<td align="center"><h4 align=center>Заказ&nbsp;№&nbsp;<?= $ouid?>&nbsp;от&nbsp;<?=$datas?></h4></td>
</tr>
</table>
</div>


<br />
<table width=99% cellpadding=2 cellspacing=0 align=center>
	<tr class=tablerow>
		<td class=tablerow width="150">Заказчик:</td>
		<td class=tableright><?=@$order['Person']['name_person']?></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>Компания:</td>
		<td class=tableright>&nbsp;<?=@$order['Person']['org_name']?></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>Почта:</td>
		<td class=tableright><a href="mailto:<?=$order['Person']['mail']?>"><?=$order['Person']['mail']?></a></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>ИНН:</td>
		<td class=tableright>&nbsp;<?=@$order['Person']['org_inn']?></td>
	</tr>
		<tr class=tablerow>
		<td class=tablerow>КПП:</td>
		<td class=tableright>&nbsp;<?=@$order['Person']['org_kpp']?></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>Тел:</td>
		<td class=tableright><?=@$order['Person']['tel_code']."-".@$order['Person']['tel_name']?></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>Адрес:</td>
		<td class=tableright><?=@$order['Person']['adr_name']?></td>
	</tr>
	<tr class=tablerow>
		<td class=tablerow>Грузополучатель:</td>
		<td class=tableright><?=GetDelivery($order['Person']['dostavka_metod'],"city")?></td>
	</tr>
		<tr class=tablerow>
		<td class=tablerow>Время доставки:</td>
		<td class=tableright><?=$order['Person']['dos_ot']?> - <?=$order['Person']['dos_do']?></td>
	</tr>
	<tr class=tablerow >
		<td class=tablerow>Тип оплаты:</td>
		<td class=tableright><?=OplataMetod($order['Person']['order_metod'])?></td>
	</tr>
	<tr class=tablerow >
		<td class=tablerow style="border-bottom: 1px solid #000000;">Комментарии:</td>
		<td class=tableright style="border-bottom: 1px solid #000000;">&nbsp;<?=$status['maneger']?></td>
	</tr>
</table>
<p><br></p>
<table width=99% cellpadding=2 cellspacing=0 align=center>
	<tr class=tablerow>
		<td class=tablerow>№</td>
		<td width=50% class=tablerow>Наименование</td>
		<td class=tablerow>Единица измерения&nbsp;</td>
		<td class=tablerow>Количество</td>
		<td class=tablerow>Цена</td>
		<td class=tableright>Сумма</td>
	</tr>
	<?
  echo @$dis;
 $my_total=ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice;
 $my_nds=number_format($my_total*$LoadItems['System']['nds']/(100+$LoadItems['System']['nds']),"2",".","");
  ?>
       <tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">Скидка:</td>
			<td class=tableright nowrap><b><?= @$order['Person']['discount']?>%</b></td>
		</tr>
		<tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">Итого:</td>
			<td class=tableright nowrap><b><?=$my_total?></b></td>
		</tr>
	<?if($LoadItems['System']['nds_enabled']){?>
		<tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">В т.ч. НДС: <?=$LoadItems['System']['nds']?>%</td>
			<td class=tableright nowrap><b><?=$my_nds?></b></td>
		</tr>
	<?}?>
	<tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
</table>
<p><b>Всего наименований <?=($num+1)?>, на сумму <?=(ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice)." ".GetIsoValutaOrder()?>
<br />
<?
$iw=new inwords;  
$s=$iw->get(ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice); 
$v=GetIsoValutaOrder();
if (eregi("руб", $v)) echo $s;
?>
</b></p><br>
<p>Дата <u><?=date("d-m-y H:m a")?></u></p>
<p>Руководитель<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<p>Главный бухгалтер<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<br>
<table>
<tr>
	<td style="padding:50px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center">М.П.</td>
</tr>
</table>


</body>
</html>