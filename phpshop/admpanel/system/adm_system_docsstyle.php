<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Языки
$GetSystems=GetSystems();
$systems=$GetSystems;
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Документооборот</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<meta http-equiv="MSThemeCompatible" content="Yes">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<?
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
	echo "<script language=JavaScript src='../editor3/scripts/editor.js'></script>";
else
	echo "<script language=JavaScript src='../editor3/scripts/moz/editor.js'></script>";
?>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript">
DoResize(<? echo $GetSystems['width_icon']?>,650,630);
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
$sql="select * from $table_name3";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
	$logo=$row['logo'];
	$promotext=$row['promotext'];
	
echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>Документооборот</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>Настройки для интернет-магазина</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_display_settings_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
<form name=product_edit  method=post onsubmit=\"Save()\">
<!-- begin tab pane -->
<div class=\"tab-pane\" id=\"article-tab\" style=\"margin-top:5px;height:450px\">

<script type=\"text/javascript\">
tabPane = new WebFXTabPane( document.getElementById( \"article-tab\" ), true );
</script>



<!-- begin intro page -->
<div class=\"tab-page\" id=\"intro-page\" style=\"height:450px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>Логотип</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"intro-page\" ) );
</script>

<table width=\"100%\">

<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
<div style=\"padding:10\">
	<input type=\"text\" name=\"logo_new\" id=\"logo\" style=\"width: 500\" value=\"$logo\">
	<BUTTON style=\"width: 3em; height: 2.2em; margin-left:5\"  onclick=\"ReturnPic('logo');return false;\"><img src=\"../img/icon-move-banner.gif\"  width=\"16\" height=\"16\" border=\"0\"></BUTTON>
</div>
</FIELDSET>
	</td>
</tr>
</table>

</div>
<div class=\"tab-page\" id=\"vetrina\" style=\"height:450px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>Рекламный блок</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"vetrina\" ) );
</script>
";
echo ('

<table width="100%">

<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
<div style="padding:10">
	');

$option=unserialize($row['admoption']);
if($option['editor_enabled']  == 1){
$MyStyle=$SysValue['dir']['dir'].chr(47)."phpshop".chr(47)."templates".chr(47).$systems['skin'].chr(47).$SysValue['css']['default'];
echo $MyStyle;
echo'
<pre id="idTemporary" name="idTemporary" style="display:none">
'.$promotext.'
</pre>
	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	oEdit1.cmdAssetManager="modalDialogShow(\''.$SysValue['dir']['dir'].'/phpshop/admpanel/editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit1.width=610;
		oEdit1.height=380;
		oEdit1.btnStyles=true;
	    oEdit1.css="'.$MyStyle.'";
		oEdit1.RENDER(document.getElementById("idTemporary").innerHTML);
	</script>
	<input type="hidden" name="EditorContent" id="EditorContent">';
}
else{
echo '
<textarea name="EditorContent" id="EditorContent" style="width:100%;height:380px">'.$promotext.'</textarea>
';
}

echo('
</div>
</FIELDSET>
	</td>
</tr>
');
echo"


</table>


</div>


<hr>
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" >
<tr>
	<td align=\"right\" style=\"padding:10\">
<input type=submit value=ОК class=but name=optionsSAVE>
	<input type=submit name=btnLang value=Отмена class=but onClick=\"return onCancel();\">
	</td>
</tr>
</table>
</form>
";



if(isset($optionsSAVE))
{
if(CheckedRules($UserStatus["option"],1) == 1){

$sql="UPDATE $table_name3
SET
logo='$logo_new',
promotext='$EditorContent'";
$result=mysql_query($sql)or @die("Невозможно изменить запись".$sql.mysql_error());
echo"
	 <script>
	 CL();
	 </script>
	   ";
}else $UserChek->BadUserFormaWindow();
  }
   
?>


