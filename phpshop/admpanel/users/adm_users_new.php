<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");

function Zero($a){
if($a!=1) return 0;
else return 1;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Создание Администратора</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,645,500);
</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">
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
<?

// Выбор шкуры
function GetSkins($skin){
global $SysValue;
$dir="../../templates";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and $file!="index.html")
            @$name.= "<option value=\"$file\" $sel>$file</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"skin_new\" style=\"height:200px;width:280px\" size=5 onchange=\"GetSkinIcon(this.value)\">
".@$name."
</select>
";
return @$disp;
}

// Выбор иконки шкуры
function GetSkinsIcon($skin){
global $SysValue;
$dir="../../templates";
$filename=$dir.'/'.$skin.'/icon/icon.gif';
if (file_exists($filename))
$disp='<img src="'.$filename.'" alt="'.$skin.'" width="150" height="120" border="1" id="icon">';
else $disp='<img src="../img/icon_non.gif"  width="150" height="120" border="1" id="icon">';
return @$disp;
}
	  ?>
	 
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>Создание Администратора</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>Укажите данные для записи в базу</span>.
	</td>
	<td align="right">
	<img src="../img/i_groups_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<!-- begin tab pane -->
<div class="tab-pane" id="article-tab" style="margin-top:5px;">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>

<!-- begin intro page -->
<div class="tab-page" id="intro-page" style="height:320px">
<h2 class="tab"><span name=txtLang id=txtLang>Основное</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "intro-page" ) );
</script>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<form name="product_edit" method="post">
<tr>
  <td colspan="2">
  <FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>И</u>мя</span></LEGEND>
<div style="padding:10">
<input type="text" name="name_new" value="<?=$name?>" class=full><!-- <br><br>
<input type="checkbox" value="1" name="name_enabled_new" <?=@$f4?>> Размещять персональную карточку продавца при выводе товара -->
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td>
  <FIELDSET>
<LEGEND><u>E</u>-mail</LEGEND>
<div style="padding:10">
<input type="text" name="mail_new" value="<?=$mail?>" class=full>
</div>
</FIELDSET>
  </td>
  <td>
  <FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>C</u>татус</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" checked><span name=txtLang id=txtLang>Активизировать</span>&nbsp;&nbsp;&nbsp;
<input type="radio" name="enabled_new" value="0" <?=@$fl2?>><font color="#FF0000"><span name=txtLang id=txtLang>Деактивизировать</span></font>
</div>
</FIELDSET>
  </td>
</tr>
<tr>
	<td colspan="3">
	<FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>И</u>зменить доступ</span></LEGEND>
<div style="padding:10">
<table>
<tr>
	<td>Login</td>
	<td width="10"></td>
	<td><input type="text" name="login_new" value="<?=$login?>" size="20" onclick="password_new.value=''"></td>
</tr>
<tr>
	<td>Password</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new" onclick="this.value=''" size="20" value="<?=substr($password, 0, 10); ?>"></td>
</tr>
</table>

</div>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<!-- begin intro page -->
<div class="tab-page" id="content" style="height:320px">
<h2 class="tab"><span name=txtLang id=txtLang>Описание</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "content" ) );
</script>
<table width="100%">

<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
<div style="padding:10">
<textarea style="width:100%;height:260px" name="EditorContent" id="EditorContent">

</textarea>
</div>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<!-- 
<div class="tab-page" id="skin" style="height:320px">
<h2 class="tab">Дизайн</h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "skin" ) );
</script>

	<table >
	<tr class=adm2>
	  <td align=left>
	  <?=GetSkins($skin)?>
	  </td>
	  <td style=\"padding-left:5px\" valign=top>
	  <FIELDSET >
	  <LEGEND ><u>С</u>криншот</LEGEND>
	  <div align="center" style="padding:10px"> <?=GetSkinsIcon($skin)?></div>
	  </FIELDSET>
	  <br>
	  <input type="checkbox" value="1" name="skin_enabled_new" <?=@$f3?>> Использовать дизайн
	  </td>
	</tr>

</table>
</div> -->
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
	<input type="submit" name="editID" value="OK" class=but>
	<input type="reset" name="btnLang" class=but value="Сбросить">
	<input type="button" name="btnLang" value="Отмена" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?
if(isset($editID) and @$login_new!="")// Запись редактирования
{
if(CheckedRules($UserStatus["users"],2) == 1){
$def_prava='a:21:{s:5:"gbook";s:5:"1-0-0";s:4:"news";s:5:"1-0-0";s:7:"visitor";s:7:"1-0-0-1";s:5:"users";s:7:"1-0-0-0";s:9:"shopusers";s:5:"1-1-1";s:8:"cat_prod";s:9:"1-0-0-1-0";s:6:"stats1";s:5:"0-0-0";s:5:"rupay";s:5:"0-0-0";s:11:"news_writer";s:5:"0-0-0";s:9:"page_site";s:5:"1-0-0";s:9:"page_menu";s:5:"1-0-0";s:5:"baner";s:5:"1-0-0";s:5:"links";s:5:"1-0-0";s:3:"csv";s:5:"1-0-0";s:5:"opros";s:5:"1-0-0";s:3:"sql";s:5:"0-1-1";s:6:"option";s:3:"0-1";s:8:"discount";s:5:"1-0-0";s:6:"valuta";s:5:"1-0-0";s:8:"delivery";s:5:"1-0-0";s:7:"servers";s:5:"0-0-0";}';
$sql="INSERT INTO $table_name19
VALUES ('','$def_prava','$login_new','".base64_encode($password_new)."','$mail_new','$enabled_new','$EditorContent','$skin_new','$skin_enabled_new','$name_new','$name_enabled_new')";
$result=mysql_query($sql)or @die("Невозможно изменить запись");
echo"
<script>
DoReloadMainWindow('users');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



