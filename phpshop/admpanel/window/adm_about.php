<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");

require("../enter_to_admin.php");
require("../class/xml.class.php");

// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");



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

// Срок действия тех. поддержки
$GetFile=GetFile("../../../license/");
@$License=parse_ini_file("../../../".$GetFile,1);
$TechPodUntilUnixTime = $License['License']['SupportExpires'];
$TechPodUntil=dataV($TechPodUntilUnixTime,"update");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>О Программе</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,670,530);
</script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">

<table id="loader">
<tr>
	<td valign="middle" align="center">
		<div id="loadmes" onclick="preloader(0)">
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

<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>О программе</span> <?= $ProductName?></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>Версии модулей и лицензионное соглашение</span>.
	</td>
	<td align="right">
	<img src="../img/i_addremove_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table cellSpacing=0 cellPadding=0 width="100%">
<tr>
	<td>

<TABLE cellSpacing=0 cellPadding=0 width="100%">
<TR>
<TD vAlign=top >
<table width="100%" cellpadding="0" cellspacing="1" height="100%">
<tr>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>Модуль</span></td>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>Версия</span></td>
</tr>
<tr bgcolor="#ffffff">
	<td>AdminPanel</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Engen</td>
	<td>2.1.6</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Parser</td>
	<td>2.1.6</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Baner</td>
	<td>2.1.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Order</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Links</td>
	<td>2.0.5</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Map</td>
	<td>2.0.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Search</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Catalog</td>
	<td>2.0.5</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Cache</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>News</td>
	<td>2.0.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Display</td>
	<td>2.1.8</td>
</tr>
<tr>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>Поддержка</span></td>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>Дата</span></td>
</tr>
<tr bgcolor="#ffffff">
	<td><span name=txtLang id=txtLang>Окончание</span></td>
	<td>
	<?=$TechPodUntil;?>
	</td>
</tr>
</table>
<div align="center" style="padding:10">
<a href="http://www.phpshop.ru/docs/techpod.html" target="_blank" style="color:blue" title="Перейти на сайт разработчика для подробной информации"><span name=txtLang id=txtLang>Пролонгация технической поддержки</span></a>
</div>
</td>
	<td valign="top">
<table cellSpacing=0 cellPadding=0 width="100%">
<tr>
   <td id=pane align=center>
   <img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>Лицензионное соглашение</span>:
   </td>
</tr>
<tr>
	<td>
	<div style="width:98%;HEIGHT: 290;overflow:auto;background-color:#ffffcc;padding:5px">
	<span id=license>
	<P>Настоящее лицензионное соглашение (далее, Соглашение) является договором между Вами и компанией «PHPShop» (далее, Автор). Соглашение относится ко всем коммерчески распространяемым версиям и модификациям программного продукта PHPShop. 
<P>1. Программный продукт PHPShop (далее, Продукт) представляет собой код программы Интернет магазина, воспроизведенный в файлах или на бумаге, включая электронную или распечатанную документацию, а также текст данного Соглашения. 
<P>2. Покупка Продукта свидетельствует о том, что Вы ознакомились с содержанием Соглашения, принимаете его положения, и будете использовать Продукт на условиях данного Соглашения. 
<P>3. Соглашение вступает в законную силу непосредственно в момент покупки Продукта, т.е. получения Вами Продукта посредством электронных средств передачи данных либо на физических носителях, на усмотрение Автора. 
<P>4. Все авторские права на Продукт принадлежат Автору. Продукт в целом или по отдельности является объектом авторского права и подлежит защите согласно российскому и международному законодательству на основании свидетельства о государственной регистрации программы для ЭВМ "PHPShop" № 2006614274. <b>Автор оставляет за собой право требовать размещения обратной ссылки<SUP style="font-weight:normal">(1)</SUP> с указанием Авторского права на сайте, где используется Продукт</b>. Использование Продукта с нарушением условий данного Соглашения, является нарушением законов об авторском праве, и будет преследоваться в соответствии с действующим законодательством. <b>Отказ от размещения обратной ссылки с указанием Авторского права является нарушением Соглашения и ограничивает Продукт в предоставлении технической поддержки Автором.</b>
<P>5. Продукт поставляется на условиях "КАК ЕСТЬ" ("AS IS") без предоставления гарантий производительности, покупательной способности, сохранности данных, а также иных явно выраженных или предполагаемых гарантий. Автор не несет какой-либо ответственности за причинение или возможность причинения вреда Вам, Вашей информации или Вашему бизнесу вследствие использования или невозможности использования Продукта. 
<P>6. <B>Данное Соглашение дает Вам право на использование неограниченного<SUP style="font-weight:normal">(2)</SUP> количества  копии Продукта  на одном web-сервере в пределах <br>
одного домена<SUP style="font-weight:normal">(3)</SUP>. Для каждой новой установки Продукта на другой адрес web-сервера  должна быть приобретена отдельная Лицензия. Любое распространение Продукта без предварительного согласия Автора, включая некоммерческое, является нарушением данного Соглашения и влечет ответственность согласно действующему законодательству.</B> Допускается возможность создания и использования Вами дополнительной копии Продукта исключительно в целях тестирования или внесения изменений в исходный код, при условии, что такая копия не будет доступна третьим лицам. 
<P>7. Вы вправе вносить любые изменения в исходный код Продукта по Вашему усмотрению. При этом последующее использование Продукта должно осуществляться в соответствии с данным Соглашением и при условии сохранения всех авторских прав. Автор не несет ответственности за работоспособность Продукта в случае внесения Вами каких бы то ни было изменений. 
<P>8. Автор не несет ответственность, связанную с привлечением Вас к административной или уголовной ответственности за использование Продукта в противозаконных целях (включая, но не ограничиваясь, продажей через Интернет магазин объектов, изъятых из оборота или добытых преступным путем, предназначенных для разжигания межрасовой или межнациональной вражды; и т.д.). 
<P>9. Прекращение действия данного Соглашения допускается в случае удаления Вами всех полученных файлов и документации, а так же их копий. Прекращение действия данного Соглашения не обязывает Автора возвратить средства, потраченные Вами на приобретение Продукта. 
<p>10. Правом использования продукта <?=$ProductName?> на сервере <?=$SERVER_NAME?> обладает "<?if(!empty($License['License']['RegisteredTo'])) echo $License['License']['RegisteredTo'];
 else echo "Trial NoName";
?>"</p>

<p>
<strong>Пояснения:</strong><br><br>
1.	Вид ссылки и размещение строго задается Автором, код ссылки не поддается изменению. В целях сохранения визуализации с персональным дизайном возможно изменение цвета ссылки (задается лицензией). <strong>Для официальных партнеров возможна выписка лицензии без копирайтов Автора</strong>. Ссылка в таком случае размещается в согласовании с Автором партнерами в удобной для них месте каждой страницы сайта. Лицензия без копирайтов автора обговаривается отдельно, стоимость такой лицензии назначается персонально.
<p>
2. Только версии Enterprise и Enterprise Pro поддерживают размещение в некорневые директории. Версии Start и Catalog, Catalog Pro поддерживают размещение только в корневой папке или поддомене.
</p>
<p>3. Имеется в виду размещение в пределах одного домена seamply.ru. 
Лицензия допускает размещение вида seamply.ru/market1/, seamply.ru/market2/ и т.д.<br>
Размещение типа market1.seamply.ru и т.д. требует покупки отдельной Лицензии. Техническая поддержка распространяется только на одну копию Продукта, приоритетное размещение для технической поддержки в корневую директорию. Для каждого нового экземпляра магазина требуется покупка новой технической поддержки по тарифам.</p>
</p>

</span></div>
<br>
<input type="checkbox" checked disabled><span name=txtLang id=txtLang>Я принимаю условия лицензионного соглашения</span>
	</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>
<table width="100%" cellpadding="0" cellpadding="0">
<tr>
   <td style="padding-left:10px">
   <?
   if($License['License']['RegisteredTo']=="Trial NoName"){
   ?>
   <BUTTON style="width: 15em; height: 2.2em; margin-top:5" type=submit onClick="window.open('http://www.phpshop.ru/order/2.html','_blank');" name="btnLang"><img src="../icon/key_add.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">Купить лицензию</BUTTON>
<?}?>
</td>
	<td align="right" style="padding:10">	<BUTTON style="width: 7em; height: 2.2em; margin-top:5" type=submit onClick="return onCancel();" name="btnLang">Закрыть</BUTTON></td>
</tr>
</table>

</body>
</html>
