<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Создание Новой Характеристики</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script>
window.resizeTo(500, 370);
</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<?

function Disp_cat($n)// вывод каталогов в выборе
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name20']." order by name";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=substr($row['name'],0,35);
	if ($id==$n)
	   {
	   $sel="selected";
	   }
	   else
	      {
		  $sel="";
		  }
    @$dis.="<option value=\"$id\" $sel>$name</option>\n";
	}
@$disp="
<select name=category_new size=1>
$dis
</select>
";
return @$disp;
}
	  ?>
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b>Создание Новой Характеристики</b><br>
	&nbsp;&nbsp;&nbsp;Укажите данные для записи в базу.
	</td>
	<td align="right">
	<img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><u>Х</u>арактеристика</LEGEND>
<div style="padding:10">
<input type="text" name="name_new" class="full">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><u>К</u>атегория</LEGEND>
<div style="padding:10">
<?=Disp_cat(@$categoryID);?>
</div>
</FIELDSET>
	</td>
</tr>
</tr>
<tr>
  <td>
    <FIELDSET>
<LEGEND><u>П</u>озиция по порядку</LEGEND>
<div style="padding:10">
<input type="text" name="num_new" value="<?=$num?>" class="full">
</div>
</FIELDSET>
  </td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
	<input type="submit" name="editID" value="OK" class=but>
	<input type="reset" class=but value="Сбросить">
	<input type="button" value="Отмена" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?
if(isset($editID) and !empty($name_new))// Запись редактирования
{
if(CheckedRules($UserStatus["cat_prod"],2) == 1){
$sql="INSERT INTO ".$SysValue['base']['table_name21']." VALUES ('','$name_new','$category_new','$num_new')";
$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
<script>
CLREL();
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



