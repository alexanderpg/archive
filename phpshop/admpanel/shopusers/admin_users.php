<?
function GetLastEnter($n){
global $SysValue;
$sql="select datas from ".$SysValue['base']['table_name27']." where user='$n' order by id desc LIMIT 1";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$datas=$row['datas'];
$data=dataV($datas);
return $data;
}

function GetUsersStatus2($n,$s){
global $SysValue;
$sql="select $s from ".$SysValue['base']['table_name28']." where id='$n'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row[$s];
}

function ShopUsers($list,$words)// Вывод 
{
global $SysValue,$_POST;

if($list!="") $sort=" where status='".$list."'";
 else $sort="";
 
if(!empty($words))
$sort=" where mail LIKE '%".$words."%' or login LIKE '%".$words."%'";

$sql="select * from ".$SysValue['base']['table_name27']." $sort order by datas desc";
$result=mysql_query($sql) or die ($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$login=$row['login'];
	$status=$row['status'];
	if(($row['enabled'])=="1"){$checked="<img src=img/icon-activate.gif  width=\"16\" height=\"16\" alt=\"В наличии\">";}else{$checked="<img src=img/icon-deactivate.gif  width=\"16\" height=\"16\" alt=\"Отсутствует\">";};
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row >
    <td style=\"padding:3\" align=center onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,550)\" class=forma>
	".$checked."
	</td>
	<td onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,580)\" class=forma>
	".$row['mail']."
	</td>
	<td onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,580)\" class=forma>
	$login
	</td>
	<td onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,580)\" class=forma>
	".GetUsersStatus2($status,"name")."
	</td>
	<td onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,580)\" class=forma>
	".GetUsersStatus2($status,"discount")."
	</td>
	<td onclick=\"miniWin('shopusers/adm_userID.php?id=$id',500,580)\" class=forma>
	".dataV($row['datas'])."
	</td>
	<td>
	<input type=checkbox name=\"c".$id."\" value=\"$id\">
	</td>
    </tr>
	";
	@$i++;
	}
if($i>20)$razmer="height:600;";
	$_Return="
<div id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<form name=\"form_flag\">
<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px;
	border-style: inset;\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
<td width=\"50\" id=pane align=center><span name=txtLang id=txtLang>Статус</span></td>
    <td width=\"20%\" id=pane align=center>E-mail</td>
	<td  id=pane align=center><span name=txtLang id=txtLang>Имя</span></td>
	<td width=\"150\" id=pane align=center><span name=txtLang id=txtLang>Статус</span></td>
	<td width=\"100\" id=pane align=center><span name=txtLang id=txtLang>Скидка</span> %</td>
	<td width=\"20%\" id=pane align=center><span name=txtLang id=txtLang>Последний вход</span></td>
	<td width=\"20\" id=pane align=center style=\"padding:0px\"><input type=checkbox value=1 name=DoAll onclick=\"SelectAllBox(this,form_flag)\"></td>
</tr>

	".$display."

    </table>
	</td>
</tr>
    </table>
	</form>
</div>
	";
return $_Return;
}


?>
