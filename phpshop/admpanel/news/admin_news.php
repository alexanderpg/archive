<?


function News()// Вывод новостей
{
global $table_name8,$PHP_SELF,$systems,$page;
$sql="select * from $table_name8 order by id desc";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$data=$row['datas'];
	$zag=$row['zag'];
	$kratko=strip_tags($row['kratko']);
	if (@$imgname)
	 {
	 $imgchek="ok";
	 }
	 else
	    {
		$imgchek="<strong>no</strong>";
		}
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('news/adm_newsID.php?id=$id',650,650)\">
	<td align=\"center\" class=forma>
	$data
	</td>
	<td class=forma>
	$zag
	</td>
	<td class=forma>
	".substr($kratko,0,150)."...
	</td>
    </tr>
	";
	@$i++;
	}
if($i>30)$razmer="height:600;";
	$_Return="
<div id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px;
	border-style: inset;\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
	<td width=\"10%\" id=pane align=center><span name=txtLang id=txtLang>Дата</span></td>
	<td width=\"45%\" id=pane align=center><span name=txtLang id=txtLang>Заголовок</span></td>
	<td width=\"45%\" id=pane align=center><span name=txtLang id=txtLang>Краткая информация</span></td>
</tr>
	".$display."
    </table>
</table>
</div>
	";
return $_Return;
}

function Ras_data()// Вывод списка рассылки
{
global $table_name8;
$sql="select distinct datas from $table_name8 order by id desc LIMIT 0, 10";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$data=$row['datas'];
	@$disp.="<option value='$data'>$data";
	}
return @$disp;
}

?>
