<?
error_reporting(0);
// Парсируем установочный файл
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<title><?= $SysValue['license']['product_name']?> -> Установка</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<LINK href="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/css/texts.css" type=text/css rel=stylesheet>
<style>
BODY, li, a, div {
	FONT-SIZE: 12px;
	COLOR: #000000;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}
.ok{
color: green;
font-weight: bold;
}
.error{
color: red;
font-weight: bold;
}
a{
	COLOR: #0066cc;
}
a:hover{
	COLOR: CC6600;
}
</style>
<script>

// PhpGoToAdmin v2.1	
function getKey(e){

	if (e == null) { // ie
		key = event.keyCode;
	} else { // mozilla
		key = e.which;
	}
	if(key=='123') window.open('../phpshop/admpanel/');
}



function Warning(){
return alert("Внимание!\nНе забудте поменять префиксы баз данных в установочном файле config.ini");
}

function InstallOk(){
window.opener.location.replace("../");
window.close();
}

function Readonlys(){
return alert("Внимание!\nДанные редактирируются только в файле /phpshop/inc/config.ini");
}

function ChekRegLic(){
var s1=window.document.forms.regForma.selectLic.checked;
if(s1 == false){
  if(confirm("Внимание!\nВы  согласны с  лицензионным соглашением?"))
     window.document.forms.regForma.selectLic.checked = true;
	 }
         else document.regForma.submit();
}


function ChekApi(){
var s1=window.document.forms.regForma.errors.value;
if(s1 == 1){
  if(confirm("Внимание!\nТест системных требований не пройден, настоятельно рекомендуем добиться прохождения теста.\nВсе равно продолжить установку?"))
     window.document.forms.regForma.submit();
	 }
         else document.regForma.submit();
}

function GenPassword(a){
document.getElementById("pas1").value=a;
document.getElementById("pas2").value=a;
alert("Сгенерирован пароль: " +a);
}

function TestPas(){
var pas1=document.getElementById("pas1").value;
var pas2=document.getElementById("pas2").value;
var login=document.getElementById("login").value;
var mail=document.getElementById("mail").value;
var mes_zag="Внимание, обнаружены ошибки при заполнении формы:\n";
var mes="";
var pattern=/\w+@\w+/;
if(pas1.length <6 || pas2.length < 6) 
mes+="-> Пароль должен содержать не менее 6 символов\n";
if(pas1 != pas2)
mes+="-> Пароли должны совпадать\n";
if(login.length <4)
mes+="-> Логин должен содержать не менее 4 символов\n";
if(pattern.test(mail)==false) mes+="-> Не правильно указано поле 'E-mail'\n";
if(mes != "") alert(mes_zag+mes);
else document.install.submit();
}

// Копировать в буфер
function copyToClipboard(){
try{
document.getElementById('adm_option').select();
var CopiedTxt=document.selection.createRange();
CopiedTxt.execCommand("Copy");
alert("Данные скопированы в буфер обмена.");
}catch(e){alert("Функция копирования доступна только для браузера IE");}
}

</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">

<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b>Установка интернет-магазина <?= $SysValue['license']['product_name']?></b><br>
	&nbsp;&nbsp;&nbsp;Настройка интернет-магазина (версия 2.2.1)
	</td>
	<td align="right">
	<img src="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/img/i_server_info_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<?


// Подключаем модули
include("../".$SysValue['file']['error']);            // Модуль ошибок

// Выбор файла
function GetFile(){
$dir="./";
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "sql")
		 @$disp=$file;
        }
        closedir($dh);
    }
return @$disp;
}

// Устанавливаем базу
if(@$install == 3){


// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");


//Отправка почты
if($_POST['pas_send'] == 1 and !empty($_POST['pas_send'])){

$codepage  = "windows-1251";              
$header  = "MIME-Version: 1.0\n";
$header .= "From:   <no_reply@phpshop.ru>\n";
$header .= "Content-Type: text/plain; charset=$codepage\n";
$header .= "X-Mailer: PHP/";
$zag="PHPShop: данные установки на сервер ".$SERVER_NAME;
$content="
Доброго времени!
---------------------------------------------------------

".$SysValue['license']['product_name']." упешно установлен на сервер ".$SERVER_NAME."

Административная панель доступна по адресу:  http://$SERVER_NAME".$SysValue['dir']['dir']."/phpshop/admpanel/
или нажатием клавиши F12
Логин: ".$_POST['user']."
Пароль: ".$_POST['password']."

---------------------------------------------------------
Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($mail,$zag,$content,$header);

}



//$fileBase=GetFile();
@$fp = fopen($fileBase, "r");



  if ($fp) {
  stream_set_write_buffer($fp, 0);
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  $CsvContent=eregi_replace("phpshop_",$prefix,$CsvContent);
  $CsvContent=eregi_replace("support@phpshop.ru",$_POST['mail'],$CsvContent);
  fclose($fp);
  }
$IdsArray2=split(";\n",$CsvContent);
array_pop($IdsArray2);
while (list($key, $val) = each($IdsArray2))
$result=mysql_query($val);
$result=mysql_query("INSERT INTO ".$prefix."users VALUES ('', 0x613a32333a7b733a353a2267626f6f6b223b733a353a22312d312d31223b733a343a226e657773223b733a353a22312d312d31223b733a373a2276697369746f72223b733a373a22312d312d312d31223b733a353a227573657273223b733a373a22312d312d312d31223b733a393a2273686f707573657273223b733a353a22312d312d31223b733a383a226361745f70726f64223b733a31313a22312d312d312d312d312d31223b733a363a22737461747331223b733a353a22312d312d31223b733a353a227275706179223b733a353a22302d302d30223b733a31313a226e6577735f777269746572223b733a353a22312d312d31223b733a393a22706167655f73697465223b733a353a22312d312d31223b733a393a22706167655f6d656e75223b733a353a22312d312d31223b733a353a2262616e6572223b733a353a22312d312d31223b733a353a226c696e6b73223b733a353a22312d312d31223b733a333a22637376223b733a353a22312d312d31223b733a353a226f70726f73223b733a353a22312d312d31223b733a363a22726174696e67223b733a353a22312d312d31223b733a333a2273716c223b733a353a22302d312d31223b733a363a226f7074696f6e223b733a333a22302d31223b733a383a22646973636f756e74223b733a353a22312d312d31223b733a363a2276616c757461223b733a353a22312d312d31223b733a383a2264656c6976657279223b733a353a22312d312d31223b733a373a2273657276657273223b733a353a22312d312d31223b733a31303a227273736368616e656c73223b733a353a22312d312d31223b7d, '".$user."', '".base64_encode($password)."', '".$mail."', '1', '', '', '1', '', '1');");
if(@$result){
$copy="
Данные доступа к PHPShop
------------------------
Административная панель доступна по адресу: http://$SERVER_NAME".$SysValue['dir']['dir']."/phpshop/admpanel/ или нажатием клавиши F12
Логин: ".$_POST['user']."
Пароль: ".$_POST['password']."
";
$disp= "<h4>Базы установлены полностью. Магазин готов к запуску.</h4>
<FIELDSET id=fldLayout>
<DIV style=\"margin:10px;padding: 10px;background-color: #FFFFFF;\" >
Административная панель доступна по адресу:  <a href=\"http://$SERVER_NAME".$SysValue['dir']['dir']."/phpshop/admpanel/\" target=\"_blank\">http://$SERVER_NAME".$SysValue['dir']['dir']."/phpshop/admpanel/</a><br>
или нажатием клавиши F12<br><br>
Логин: <strong>".$_POST['user']."</strong><br>
Пароль: <strong>".$_POST['password']."</strong><br><br>
<textarea id=\"adm_option\" style=\"width: 0px; height: 1px\">$copy</textarea>
<INPUT  type=button value=\"Скопировать в буфер обмена\" onclick=\"copyToClipboard()\"> 
</DIV>
</FIELDSET>
<script>
document.onkeydown = getKey; 
</script>

";
$d="";
}
else {
$disp="<h4>Ошибка установки: ".mysql_error()." </h4>";
$d="disabled";
}
?>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
<FORM method=post>
<TBODY>
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET >
<div align="center" style="padding:10">
<?=@$disp?>
</div>
</FIELDSET>
</TD>
</TR></FORM></TBODY></TABLE></TD></TR></TBODY></TABLE>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:170">
<tr>
   <td><hr></td>
</tr>
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="&laquo; Назад" onclick="history.back(1)"> 
<INPUT class=but type=button id="close" value="Готово" onclick="InstallOk()" <?=$d?>> 
	</td>
</tr>
</form>
</table>
<?
}

elseif(@$install==2){
?>
<div style="padding:5">
<FIELDSET>
<LEGEND id=lgdLayout ><u>M</u>ySQL</LEGEND>
<br>
<table cellSpacing=1 cellPadding=5  border=0 width="100%">
<FORM method="post" name="install">
<tr>
	<td align="right" width="100">Хост:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly value="<?= $SysValue['connect']['host']?>" name="host"></td>
</tr>
<tr>
	<td align="right">Пользователь:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="user_db" value="<?= $SysValue['connect']['user_db']?>"></td>
</tr>
<tr>
	<td align="right">Пароль базы:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="pass_db" value="<?= $SysValue['connect']['pass_db']?>"></td>
</tr>
<tr>
	<td align="right">Имя базы:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="dbase" value="<?= $SysValue['connect']['dbase']?>"></td>
</tr>
<tr>
	<td align="right">Префикс:</td>
	<td align="left"><input type="text" style="width:300" name="prefix" value="phpshop_" onchange="Warning()"></td>
</tr>
</table>
<br>
<input type="hidden" name="fileBase" value="<?= GetFile()?>">
</FIELDSET>
<br>
<FIELDSET>
<LEGEND id=lgdLayout ><u>А</u>дминистрирование</LEGEND>
<br>
<table cellSpacing=1 cellPadding=5  border=0 width="100%">
<tr>
	<td align="right" width="100">Пользователь</td>
	<td align="left"><input type="text" id="login" style="width:150" value="root" name="user"> ( не менее 4 символов )</td>
</tr>
<tr>
	<td align="right">E-mail:</td>
	<td align="left"><input type="text" style="width:150" name="mail" id="mail" value=""> <input type="checkbox" value="1" name="pas_send" id="pas_send" checked> отослать рег. данные на почту</td>
</tr>
<tr>
	<td align="right">Пароль:</td>
	<td align="left"><input type="password" id="pas1" style="width:150" name="password" value=""> ( не менее 6 символов )</td>
</tr>
<tr>
	<td align="right">Пароль еще раз:</td>
	<td align="left"><input type="password" id="pas2" style="width:150" value="">
	
	<INPUT class=but type=button value="Сгенерировать" style="width:100" onclick="GenPassword('<?="P".substr(md5(date("U")),0,6)?>')"> 
	 </td>
</tr>
</table>
<br>
</FIELDSET>

</div>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:5">
<tr>
   <td><hr></td>
</tr>
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="&laquo; Назад" onclick="history.back(1)"> 
<INPUT class=but type=button value="Отмена" onclick="window.close()"> 
<INPUT class=but type="button" value="Далее &raquo;" onclick="TestPas()"> 
<input type="hidden" name="install" value="3">
	</td>
</tr>
</table>
</form>


<?
}
elseif(@$install==1){

while (list($val) = each($SysValue['base']))
@$bases.=$SysValue['base'][$val].", ";

$bases=substr($bases,0,strlen($bases)-2);
$bases2=ereg_replace("phpshop_system","",$bases);
?>
<TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
<FORM method="post" name="regForma">
<TR class=adm vAlign=top align=middle>
<TD align=left width="100%">
<FIELDSET><LEGEND id=lgdLayout><u>Л</u>ицензионное соглашение</LEGEND>
<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
<textarea style="width:99%;height:300">
Настоящее лицензионное соглашение (далее, Соглашение) является договором между Вами и компанией «PHPSHOP» (далее, Автор). Соглашение относится ко всем коммерчески распространяемым версиям и модификациям программного продукта PHP SHOP. 


1. Программный продукт PHP SHOP (далее, Продукт) представляет собой код программы Интернет магазина, воспроизведенный в файлах или на бумаге, включая электронную или распечатанную документацию, а также текст данного Соглашения. 


2. Покупка Продукта свидетельствует о том, что Вы ознакомились с содержанием Соглашения, принимаете его положения, и будете использовать Продукт на условиях данного Соглашения. 


3. Соглашение вступает в законную силу непосредственно в момент покупки Продукта, т.е. получения Вами Продукта посредством электронных средств передачи данных либо на физических носителях, на усмотрение Автора. 


4. Все авторские права на Продукт принадлежат Автору. Продукт в целом или по отдельности является объектом авторского права и подлежит защите согласно российскому и международному законодательству. Использование Продукта с нарушением условий данного Соглашения, является нарушением законов об авторском праве, и будет преследоваться в соответствии с действующим законодательством. 


5. Продукт поставляется на условиях "КАК ЕСТЬ" ("AS IS") без предоставления гарантий производительности, покупательной способности, сохранности данных, а также иных явно выраженных или предполагаемых гарантий. Автор не несет какой-либо ответственности за причинение или возможность причинения вреда Вам, Вашей информации или Вашему бизнесу вследствие использования или невозможности использования Продукта. 


6. Данное Соглашение дает Вам право на использование только одной копии Продукта для обеспечения работы одного Интернет магазина на одном web-сервере. Для каждой новой установки Продукта должна быть приобретена отдельная Лицензия. Любое распространение Продукта без предварительного согласия Автора, включая некоммерческое, является нарушением данного Соглашения и влечет ответственность согласно действующему законодательству. Допускается возможность создания и использования Вами дополнительной копии Продукта исключительно в целях тестирования или внесения изменений в исходный код, при условии, что такая копия не будет доступна третьим лицам. 


7. Вы вправе вносить любые изменения в исходный код Продукта по Вашему усмотрению. При этом последующее использование Продукта должно осуществляться в соответствии с данным Соглашением и при условии сохранения всех авторских прав. Автор не несет ответственности за работоспособность Продукта в случае внесения Вами каких бы то ни было изменений. 


8. Автор не несет ответственность, связанную с привлечением Вас к административной или уголовной ответственности за использование Продукта в противозаконных целях (включая, но не ограничиваясь, продажей через Интернет магазин объектов, изъятых из оборота или добытых преступным путем, предназначенных для разжигания межрасовой или межнациональной вражды; и т.д.). 


9. Прекращение действия данного Соглашения допускается в случае удаления Вами всех полученных файлов и документации, а так же их копий. Прекращение действия данного Соглашения не обязывает Автора возвратить средства, потраченные Вами на приобретение Продукта. 
</textarea>

</FIELDSET> </TD>
</TR>
</TABLE><br>
&nbsp;&nbsp;<input type="checkbox" name="selectLic">Я принимаю условия лицензионного соглашения
</DIV>
<br>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10"><br>
	<INPUT class=but type=button value="&laquo; Назад" onclick="history.back(1)"> 
<INPUT class=but type=button value="Отмена" onclick="window.close()"> 
<INPUT class=but type="button" value="Далее &raquo;" onclick="ChekRegLic()"> 
<input type="hidden" name="install" value="2">
	</td>
</tr>
</table>
</form>
<?
}
else{

$AllError=0;

// Глобалсы
if(ini_get('register_globals') == 1) $register_globals="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else {$register_globals="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}

// Апач
if(eregi('Apache', $_SERVER['SERVER_SOFTWARE'])) $API="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else {$API="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}

// Версия PHP
$phpversion=substr(phpversion(),0,1);
if($phpversion >= 4) $php="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else {$php="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}


// Версия MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
@mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");

if(@mysql_get_server_info()){
$mysqlversion=substr(@mysql_get_server_info(),0,1);
if($mysqlversion >= 4) $mysql="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else {$mysql="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}
}else $mysql="...............?";

// Rewrite
$path_parts = pathinfo($PHP_SELF);
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/test.html";
if (@fopen($filename,"r")) $rewrite="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else {$rewrite="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}


// Версия Zend
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/rewritemodtest.php";
$html = implode('', file ($filename));
if (eregi('Zend Optimizer', $html)) $zend="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
   else {$zend="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}


$GD=gd_info();

//GD Support
if($GD['GD Version']!="")
 $gd_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  {$gd_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}
 
//FreeType Support
if($GD['FreeType Support'] === true)
 $gd_freetype_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  {$gd_freetype_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}

//FreeType Linkage
if($GD['FreeType Linkage'] == "with freetype")
 $gd_freetype_linkage="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  {$gd_freetype_linkage="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";$AllError=1;}

?>
<TABLE cellSpacing=1 cellPadding=5 width="100%" height="400" align=center border=0>
<FORM method="post" name="regForma">
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET id=fldLayout><LEGEND id=lgdLayout><u>Т</u>ест системных требований</LEGEND>
<DIV style="margin:10px;padding: 10px;background-color: #FFFFFF;">
<ol>
<li id="line1" style="visibility:hidden"> Apache => 1.3.*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$API?></li>
<li id="line2" style="visibility:hidden"> PHP => 4.* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$php?></li>
<li id="line3" style="visibility:hidden"> ZendOptimizer => 2.1.5.3 &nbsp;&nbsp;&nbsp;&nbsp;<?=$zend?></li>
<li id="line4" style="visibility:hidden"> RewriteEngine ON для Apache&nbsp;&nbsp;&nbsp;<?=$rewrite?></li>
<li id="line5" style="visibility:hidden"> Register Globals ON для PHP &nbsp;&nbsp;&nbsp;<?=$register_globals?></li>
<li id="line6" style="visibility:hidden">GD Support для PHP <?=$gd_support?></li>
<li id="line7" style="visibility:hidden">FreeType Support для PHP <?=$gd_freetype_support?></li>
<li id="line8" style="visibility:hidden">FreeType Linkage для PHP <?=$gd_freetype_linkage?></li>
<br><br>
<ol>
</DIV>
<div style="padding: 20px"><strong>Расшифровка</strong>: <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle> <b class='ok'>Ok</b> - тест пройден, 
<img src="rewritemodtest/errormessage.gif"  border=0 align=absmiddle> <b class='error'>Error</b> - тест не пройден (возможны проблемы при работе скрипта, обратитесь к документации сервера или свяжитесь с администратором сервера)
</div>
</FIELDSET> </TD>
</TR>
</TABLE>


<br>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="Отмена" onclick="window.close()"> 
<input type="hidden" name="errors" id="error" value="<?=$AllError?>">
<INPUT class=but type="button" value="Далее &raquo;" onclick="ChekApi()"> 
<input type="hidden" name="install" value="1">
	</td>
</tr>

</table>
</form>
<script>
function LoadTest(i){
document.getElementById("line"+i).style.visibility = 'visible';
if(i != 8) setTimeout("LoadTest("+(i+1)+")",300);}
setTimeout("LoadTest(1)",300);
</script>
<?}?>


</body>
</html>
