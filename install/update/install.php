<?
// Парсируем установочный файл
$SysValue=parse_ini_file("../../phpshop/inc/config.ini",1);

// Глобалс он
@extract($_GET);
@extract($_POST);
@extract($_FORM);
@extract($_FILES);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<title><?= $SysValue['license']['product_name']?> -> Установка обновления</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<LINK href="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/css/texts.css" type=text/css rel=stylesheet>
<script>
function Warning(){
return alert("Внимание!\nНе забудте поменять префиксы баз данных в установочном файле config.ini");
}

function InstallOk(){
window.opener.location.replace("/");
window.close();
}

function Readonlys(){
return alert("Внимание!\nДанные редактирируются только в файле config.ini");
}

function ChekRegLic(){
var s1=window.document.forms.regForma.selectLic.checked;
if(s1 == false){
  if(confirm("Внимание!\nВы  согласны с  лицензионным соглашением?"))
     window.document.forms.regForma.selectLic.checked = true;
	 }
         else document.regForma.submit();
}

</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b>Обновление интернет-магазина <?= $SysValue['license']['product_name']?></b><br>
	&nbsp;&nbsp;&nbsp;Модуль обновления (версия 0.1).
	</td>
	<td align="right">
	<img src="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/img/i_server_info_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<?


// Подключаем модули
include("../../".$SysValue['file']['error']);            // Модуль ошибок

// Выбор файла
function GetFile($dir){
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "sql")
		 $fileBase=$file;
        }
        closedir($dh);
    }
return "./".$dir."/".$fileBase;
}

function GetUpdate($skin){
global $SysValue;
$dir="./";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and is_dir($file))
            @$name.= "<option value=\"$file\" $sel>$file</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"update_dir\">
".@$name."
</select>
";
return @$disp;
}

// Устанавливаем базу
if(@$install == 2){


// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");


$fileBase=GetFile($update_dir);
$lines=file($update_dir."/file.txt");
@$fp = fopen($fileBase, "r");

  if ($fp) {
  stream_set_write_buffer($fp, 0);
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  $CsvContent=eregi_replace("phpshop_",$prefix,$CsvContent);
  fclose($fp);
  }
$IdsArray2=split(";",$CsvContent);
array_pop($IdsArray2);
while (list($key, $val) = each($IdsArray2))
$result=mysql_query($val);
if(@$result){
$disp= "<h4>Обновление базы прошло успешно.</h4>
$fileInstr
";
foreach ($lines as $line_num => $line) {
    @$disp2.=htmlspecialchars($line) . "<br>\n";
}
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
<TABLE cellSpacing=1 cellPadding=5 width="50%" align=center border=0>
<FORM method=post>
<TBODY>
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<div align="center" style="padding:10">
<?=@$disp?>
</div>
</FIELDSET>
<br>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<LEGEND id=lgdLayout ><u>О</u>бновление файлов:</LEGEND>
<div style="padding:10;WIDTH:100%;height:250px;overflow:auto">
<?=@$disp2?>
</div>
</FIELDSET>
</TD>
</TR></FORM></TBODY></TABLE></TD></TR></TBODY></TABLE>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:50">
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

elseif(@$install==1){
?>
<div style="padding:5">
<FIELDSET id=fldLayout style="WIDTH: 545;">
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
</FIELDSET>
<br>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<LEGEND id=lgdLayout ><u>Д</u>оступные обновления ПО для версий:</LEGEND>
<div style="padding:10px">
<? echo GetUpdate("123")?><br><br>
Выберете свою текущую версию ПО.<br>
Если вашей версии нет в списке, то воспользуйтесь инструкциями  в файле <a href="Update.txt" target="_blank">Update.txt</a> для ручного обновления базы MySQL.<br><br>
<b>Важно: сделать резервную копию базы перед запуском обновления.</b>
</div>

</FIELDSET>

</div>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:60">
<tr>
   <td><hr></td>
</tr>
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="&laquo; Назад" onclick="history.back(1)"> 
<INPUT class=but type=button value="Отмена" onclick="window.close()"> 
<INPUT class=but type="Submit" value="Далее &raquo;"> 
<input type="hidden" name="install" value="2">
	</td>
</tr>
</form>
</table>


<?
}
else{

while (list($val) = each($SysValue['base']))
@$bases.=$SysValue['base'][$val].", ";

$bases=substr($bases,0,strlen($bases)-2);
$bases2=ereg_replace("phpshop_system","",$bases);
?>

<TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
<FORM method="post" name="regForma">
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET id=fldLayout style="WIDTH: 100%;"><LEGEND id=lgdLayout><u>Л</u>ицензионное соглашение</LEGEND>
<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
<textarea style="width=99%;height:320">
Настоящее лицензионное соглашение (далее, Соглашение) является договором между Вами и компанией «PHPSHOP» (далее, Автор). Соглашение относится ко всем коммерчески распространяемым версиям и модификациям программного продукта PHP SHOP. 


1. Программный продукт PHP SHOP (далее, Продукт) представляет собой исходный код программы Интернет магазина, воспроизведенный в файлах или на бумаге, включая электронную или распечатанную документацию, а также текст данного Соглашения. 


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
	<td align="right" style="padding:10">
<INPUT class=but type=button value="Отмена" onclick="window.close()"> 
<INPUT class=but type="button" value="Далее &raquo;" onclick="ChekRegLic()"> 
<input type="hidden" name="install" value="1">
	</td>
</tr>
</form>
</table>
<?}?>


</body>
</html>
