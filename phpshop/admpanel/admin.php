<?
require("connect.php");
// Отключаем ошибки
if($SysValue['my']['error_reporting']=="true")
error_reporting(0);
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");

require("enter_to_admin.php");
require("class/xml.class.php");

// Выбор файла
function GetFile($dir){
global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "lic")
		  return $SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
}

$num=explode(" ",$SysValue['license']['product_name']);
$product_num =  str_replace(".","",trim($num[1]));


// Срок действия тех. поддержки
$GetFile=GetFile("../../license/");
@$License=parse_ini_file("../../".$GetFile,1);
define("EXPIRES",$License['License']['SupportExpires']);


$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("./language/".$Lang."/language.php");


// Проверяем update
if($option['update_enabled'] == 1) $ChekUpdate="ChekUpdate('false');";
if($License['License']['RegisteredTo']!="Trial NoName"  and !getenv("COMSPEC"))
if(@$db=readDatabase(PATH,"update")){

foreach ($db as $k=>$v){
     if($db[$k]['num'] > $product_num)
     $UpadateContent.="Обновление ".$db[$k]['num']." - ".$db[$k]['name']."".$db[$k]['content'];
	 }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$ProductName?></title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<META name="copyright" content="<?=$RegTo?>">
<META name="engine-copyright" content="PHPSHOP.RU, <?=$ProductName;?>">
<LINK href="css/texts.css" type=text/css rel=stylesheet>
<LINK href="css/dateselector.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script type="text/javascript" language="JavaScript" 
  src="/phpshop/lib/JsHttpRequest/JsHttpRequest.js"></script>
<SCRIPT language="JavaScript" src="java/popup_lib.js"></SCRIPT>
<SCRIPT language="JavaScript" src="java/dateselector.js"></SCRIPT>
<script language="JavaScript" src="java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript" src="java/stm31.js"></script>
<script type="text/javascript" language="JavaScript" src="java/sorttable.js"></script>
<script type="text/javascript" language="JavaScript" src="language/<?=$Lang?>/language_interface.js"></script>
<script type="text/javascript" language="JavaScript">

// Проверка обновлений
function ChekUpdate(flag){
var update="<?=$UpadateContent;?>";
var version="<?=$ProductName;?>";
var path ="<?=PATH?>";
var soft = "<?=$SysValue['license']['product_name']?>";
var pathD="./update/update.php";
var expir="<?=EXPIRES?>";
var expirUntil = "<?=dataV(EXPIRES,"update"); ?>";
var cookieValue=GetCookie('update');
if(update !=''){
window.status="Внимание!\nДоступно обновление для "+version;
  if(!cookieValue | flag=="true")
    if(confirm("Внимание!\nДоступно обновление для "+version+"\n\n"+update+"\n\nЗагрузить обновление с сервера разработчика?")){
     if(expir > <?=date("U")?>){window.open("./update/update.php");}
	   else {alert("Период технической поддержки закончился "+expirUntil)}
   SetCookie('update', 2, 5);
    }
    else SetCookie('update', 2, 5);
} 
else if( flag=="true") alert("Для "+soft+" обновления отсутствуют.");
}


// На весь экран
window.moveTo(0,0);
window.resizeTo(screen.availWidth,screen.availHeight);
window.status="<?=$SysValue['Lang']['System']['status']." ".@$logPHPSHOP." ".$SysValue['Lang']['System']['status2']." ".$SERVER_NAME?>";
//document.onmousedown=mp;

// Подсказка
function show(hintHeader, hintContent) {
if(document.all){
document.getElementById("CSCHint").style.visibility="visible";
document.getElementById("CSCHint").style.position="absolute";
document.getElementById("CSCHint").style.width="200px";
document.getElementById("CSCHint").style.height="auto";
document.getElementById("CSCHint").innerHTML="<table cellpadding=2 cellspacing=1 style='background-color:#cccccc;color:black;font-family:tahoma,verdana,sans-serif;font-size:8pt;font-weight:normal;padding:2px;'><tr bgcolor='C0D2EC'><td valign=top><center>"+hintHeader+"</center></td></tr><tr bgcolor='#ffffff'><td valign=top>"+hintContent+"</td></tr></table>";
document.getElementById("CSCHint").style.left=document.body.scrollLeft+event.x+5+"px";
document.getElementById("CSCHint").style.top=document.body.scrollLeft+event.y+5+"px";
}
} function hide() {
if(document.getElementById("CSCHint"))document.getElementById("CSCHint").style.visibility="hidden";}
</script>
</head>
<body style="background: threedface; color: windowtext;" topmargin="0" rightmargin="3" leftmargin="3" onload="<?=@$ChekUpdate?>DoCheckInterfaceLang('icon',1);preloader(0)"  oncontextmenu="return false;" onresize="ResizeWin('prders')">
<span id="cartwindow" style="position:absolute;left:10px;top:0;visibility:hidden; width: 250px; height: 68px;Z-INDEX: 3;BACKGROUND: #C0D2EC;padding:10px;border: solid;border-width: 1px; border-color:#4D88C8;FILTER: revealTrans  (duration=1,transition=4);" > 
<table width="100%" height="100%">
<tr>
	<td width="40" vAlign=center>
	<img src="img/i_visa_med[1].gif" alt="" width="32" height="32" border="0" align="absmiddle">
	</td>
	<td><b>Внимание...</b><br>Обнаружены новые заказы</td>
</tr>
</table>
</span>
<script>
// Проверка новых заказов
<?
if($option['message_enabled']==1)
echo 'setInterval("DoMessage()",'.($option['message_time']*1000).');'
?>
</script>
<table id="loader" style="margin-top: 57px;">
<tr>
	<td valign="middle" align="center">
		<div id="loadmes" style="margin-bottom: 50px;" onclick="preloader(0)">
<table width="100%" height="100%">
<tr>
	<td id="loadimg"></td>
	<td ><b><?=$SysValue['Lang']['System']['loading']?></b><br><?=$SysValue['Lang']['System']['loading2']?></td>
</tr>
</table>
		</div>
</td>
</tr>
</table>



<SCRIPT language=JavaScript type=text/javascript>preloader(1);</SCRIPT>


<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset; Z-INDEX: 1">
<tr>
    <td>
	<script type="text/javascript" language="JavaScript" src="language/<?=$Lang?>/menu.js"></script>
	</td>
    <td align="right" id="phpshop">
	<a href="http://www.phpshop.ru" target="_blank" class="phpshop" title="Все права защищены
© www.PHPShop.ru">
	<?= $ProductName?></a>
	</td>
    
</tr>
</table>
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;" >
<tr>
	 <td style="padding-left:5">
	<table cellpadding="0" cellspacing="0">
<tr>
    <td id="but0"  class="butoff"><img name="iconLang" src="icon/folder_images.gif" alt="Каталог" width="16" height="16" border="0" onmouseover="ButOn(0)" onmouseout="ButOff(0)" onclick="DoReload('cat_prod')" ></td>
   <td width="3"></td>
  <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
   <td id="but3"  class="butoff"><img name="iconLang" src="icon/creditcards.gif" alt="Заказы" width="16" height="16" border="0" onmouseover="ButOn(3)" onmouseout="ButOff(3)" onclick="DoReload('orders')"></td>
 <td width="3"></td>
   <td id="but18"  class="butoff"><img name="iconLang" src="icon/chart_bar.gif" alt="Отчеты" width="16" height="16" border="0" onmouseover="ButOn(18)" onmouseout="ButOff(18)" onclick="DoReload('stats1')"></td>
  <td width="3"></td>
  <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
   <td id="but4"  class="butoff"><img name="iconLang" src="icon/page_code.gif" alt="Загрузка прайса" width="16" height="16" border="0" onmouseover="ButOn(4)" onmouseout="ButOff(4)" onclick="DoReload('csv')"></td>
 <td width="3"></td>
   <td id="but5"  class="butoff"><img name="iconLang" src="icon/page_save.gif" alt="Выгрузка прайса" width="16" height="16" border="0" onmouseover="ButOn(5)" onmouseout="ButOff(5)" onclick="miniWin('export/adm_csv.php?IDS=all',300,300)"></td>
<td width="3"></td>
  <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
   <td id="but6"  class="butoff"><img name="iconLang" src="icon/joystick.gif" alt="Системные настройки" width="16" height="16" border="0" onmouseover="ButOn(6)" onmouseout="ButOff(6)" onclick="miniWin('system/adm_system.php',550,430)"></td>
<td width="3"></td>
<td id="butxhtml"  class="butoff"><img name="iconLang" src="icon/xhtml.gif" alt="Keywords & Titles" width="16" height="16" border="0" onmouseover="ButOn('xhtml')" onmouseout="ButOff('xhtml')" onclick="miniWin('system/adm_system_promo.php',650,630)"></td>
<td width="3"></td>
 <td id="but7"  class="butoff"><img name="iconLang" src="icon/telephone.gif" alt="Реквизиты" width="16" height="16" border="0" onmouseover="ButOn(7)" onmouseout="ButOff(7)" onclick="miniWin('system/adm_system_recvizit.php',500,500)"></td>
<td width="3"></td>
   <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
   <td id="but8"  class="butoff"><img name="iconLang" src="icon/page.gif" alt="Страницы" width="16" height="16" border="0" onmouseover="ButOn(8)" onmouseout="ButOff(8)" onclick="DoReload('page_site_catalog')"></td>
 <td width="3"></td>
   <td id="but9"  class="butoff"><img name="iconLang" src="icon/page_lightning.gif" alt="Новости" width="16" height="16" border="0" onmouseover="ButOn(9)" onmouseout="ButOff(9)" onclick="DoReload('news')"></td>
 <td width="3"></td>
   <td id="but10"  class="butoff"><img name="iconLang" src="icon/page_refresh.gif" alt="Баннеры" width="16" height="16" border="0" onmouseover="ButOn(10)" onmouseout="ButOff(10)" onclick="DoReload('baner')"></td>
 <td width="3"></td>
   <td id="but11"  class="butoff"><img name="iconLang" src="icon/page_attach.gif" alt="Текстовые блоки" width="16" height="16" border="0" onmouseover="ButOn(11)" onmouseout="ButOff(11)" onclick="DoReload('page_menu')"></td>
<td width="3"></td>
   <td id="but14"  class="butoff"><img name="iconLang" src="icon/page_link.gif" alt="Ссылки" width="16" height="16" border="0" onmouseover="ButOn(14)" onmouseout="ButOff(14)" onclick="DoReload('links')"></td>
<td width="3"></td>
   <td id="but21"  class="butoff"><img name="iconLang" src="icon/page_edit.gif" alt="Опросы" width="16" height="16" border="0" onmouseover="ButOn(21)" onmouseout="ButOff(21)" onclick="DoReload('opros')"></td>
<td width="3"></td>
   <td id="but45"  class="butoff"><img name="iconLang" src="icon/page_key.gif" alt="Комментарии" width="16" height="16" border="0" onmouseover="ButOn(45)" onmouseout="ButOff(45)" onclick="DoReload('comment')"></td>
<td width="3"></td>
   <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
     <td id="but41"  class="butoff"><img name="iconLang" src="icon/folder_user.gif" alt="Пользователи" width="16" height="16" border="0" onmouseover="ButOn(41)" onmouseout="ButOff(41)" onclick="DoReload('shopusers')"></td>
<td width="3"></td>
  <td id="but42"  class="butoff"><img name="iconLang" src="icon/user.gif" alt="Администраторы" width="16" height="16" border="0" onmouseover="ButOn(42)" onmouseout="ButOff(42)" onclick="DoReload('users')"></td>
   <td width="3"></td>
   <td id="but43"  class="butoff"><img name="iconLang" src="icon/vcard.gif" alt="Журнал авторизации" width="16" height="16" border="0" onmouseover="ButOn(43)" onmouseout="ButOff(43)" onclick="DoReload('users_jurnal')"></td>
   <td width="3"></td>
    <td id="but44"  class="butoff"><img name="iconLang" src="icon/page_find.gif" alt="Журнал поиска" width="16" height="16" border="0" onmouseover="ButOn(44)" onmouseout="ButOff(44)" onclick="DoReload('search_jurnal')"></td>
   <td width="3"></td>
   <td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <td width="3"></td>
      <td id="but15"  class="butoff"><img name="iconLang" src="icon/database_key.gif" alt="SQL" width="16" height="16" border="0" onmouseover="ButOn(15)" onmouseout="ButOff(15)" onclick="miniWin('sql/adm_sql.php',500,400)"></td>
<td width="3"></td>
      <td id="but22"  class="butoff"><img name="iconLang" src="icon/database_save.gif" alt="Создание резевной копии" width="16" height="16" border="0" onmouseover="ButOn(22)" onmouseout="ButOff(22)" onclick="miniWin('dumper/dumper.php',500,430)"></td>
<td width="3"></td>
<td width="1" bgcolor="#ffffff"></td>
   <td width="1" bgcolor="#808080" ></td>
   <?if($SysValue['cnstats']['enabled'] == "true"){?>
    <td width="3"></td>
    <td id="but40"  class="butoff"><img name="iconLang" src="icon/chart_curve.gif" alt="Статистика" width="16" height="16" border="0" onmouseover="ButOn(40)" onmouseout="ButOff(40)" onclick="window.open('/cnstats/')"></td>
<?}?>
   <td width="3"></td>
   <td id="but17"  class="butoff"><img name="iconLang" src="icon/house.gif" alt="Магазин" width="16" height="16" border="0" onmouseover="ButOn(17)" onmouseout="ButOff(17)" onclick="window.open('../../')"></td>
 <td width="3"></td>
    <td id="but16"  class="butoff"><img name="iconLang" src="icon/door.gif" alt="Выход" width="16" height="16" border="0" onmouseover="ButOn(16)" onmouseout="ButOff(16)" onclick="window.close()"></td>
<td width="3"></td>
    
</tr>
</table>
	</td>
	<td align="right"><img src="icon/time.gif"  border="0" align="absmiddle" ></td>
	<td style="border: 1px;border-style: inset;padding-right:17px" align="right" width="200">
	<script language="JavaScript">clockRus();</script>
	</td>
</tr>
</table>
<div align="center" id="interfaces" name="interfaces">
<script>
setTimeout("DoReload('orders')",500);
</script>
</A>
</div>
<div id="CSCHint"></div>
</body>
</html>
