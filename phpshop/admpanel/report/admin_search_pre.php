<?
function SearchPre()// Вывод
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name26']." order by id desc";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=str_replace("ii",",",$row['name']);
	$name=str_replace("i","",$name);
	$uid=$row['uid'];
	if($row['enabled']==1){
	$fl="<img src=\"img/icon-activate.gif\" width=\"16\" height=\"14\" border=\"0\">";
	}else{
	$fl="<img src=\"img/icon-deactivate.gif\" width=\"16\" height=\"14\" border=\"0\">";}
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row>
    <td class=forma>$fl</td>
	<td onclick=\"miniWin('report/adm_preID.php?id=$id',400,380)\" class=forma>
	$name
	</td>
	<td onclick=\"miniWin('report/adm_preID.php?id=$id',400,380)\" class=forma>
	$uid
	</td>
	<td class=forma>
	<input type=checkbox name='c".$id."' value=\"".$id."\">
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
    <td width=\"25\" id=pane align=center>&plusmn;</td>
	<td width=\"54%\" id=pane align=center><span name=txtLang id=txtLang>Запрос</span></td>
	<td width=\"55%\" id=pane align=center><span name=txtLang id=txtLang>ID товаров</span></td>
    <td width=\"25\" id=pane align=center style=\"padding:1px\"><input type=checkbox value=1 name=DoAll onclick=\"SelectAllBox(this,form_flag)\"></td>
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