<?
function Comment($pole1,$pole2,$words)
{
global $SysValue;

if(empty($pole1)) $pole1=date("U")-86400;
 else $pole1=GetUnicTime($pole1)-86400;
if(empty($pole2)) $pole2=date("U");
 else $pole2=GetUnicTime($pole2)+86400;
 
 
if(!empty($words)){
if(is_numeric($words)) $sql="select * from ".$SysValue['base']['table_name36']." where  parent_id=".$words;
else $sql="select * from ".$SysValue['base']['table_name36']." where name REGEXP '".$words."' or  name REGEXP '".ucfirst($words)."'";
}
  else 
$sql="select * from ".$SysValue['base']['table_name36']." where datas<'$pole2' and datas>'$pole1' order by id desc";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$data=$row['datas'];
	$name=$row['name'];
	$content=$row['content'];
	$len=strlen($content);
	
	@$display.="
	<tr class=row onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\">
	<td align=\"center\" class=forma onclick=\"miniWin('comment/adm_commentID.php?id=$id',650,530)\">
	".dataV($data,"true")."
	</td>
	<td class=forma onclick=\"miniWin('comment/adm_commentID.php?id=$id',650,530)\">
	$name
	</td>
	<td class=forma onclick=\"miniWin('comment/adm_commentID.php?id=$id',650,530)\">
	".mySubstr($content,200)."...
	</td>
	<td>
	<input type=checkbox name=\"c".$id."\" value=\"$id\">
	</td>
    </tr>
	";
	@$i++;
	}
	if($i>15)$razmer="height:600;";
	$_Return="
<div id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<form name=\"form_flag\">
<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px;
	border-style: inset;\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
	<td width=\"12%\" id=pane align=center><span name=txtLang id=txtLang>Дата</span></td>
	<td width=\"20%\" id=pane align=center><span name=txtLang id=txtLang>Автор</span></td>
	<td width=\"65%\" id=pane align=center><span name=txtLang id=txtLang>Комментарий</span></td>
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
