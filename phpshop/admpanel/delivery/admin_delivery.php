<?
function Delivery()// Вывод доставки
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name30']." order by city";
$result=mysql_query($sql);

while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$city=$row['city'];
	$price=$row['price'];
	$enabled=$row['enabled'];
	if($row['price_null_enabled'] == 1) $price_null=$row['price_null']." ".GetIsoValutaOrder();
	  else $price_null="";
	if(($enabled)=="1"){$checked="<img src=img/icon-activate.gif  >";}else{$checked="<img src=img/icon-deactivate.gif>";};
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('delivery/adm_deliveryID.php?id=$id',400,270,event)\">
<td align=\"center\">$checked</td>
<td class=forma>
	$city 
	</td>
	<td class=forma>
	$price ".GetIsoValutaOrder()."
	</td>
	<td class=forma>$price_null</td>
    </tr>
	";
	@$i++;
	}
if($i>30)$razmer="height:600;";
	return "
<div id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px;
	border-style: inset;\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
    <td width=\"100\" id=pane align=>+/-</td>
	<td width=\"60%\" id=pane align=><span name=txtLang id=txtLang>Город</span></td>
	<td width=\"20%\" id=pane align=><span name=txtLang id=txtLang>Стоимость</span></td>
	<td width=\"20%\" id=pane align=><span name=txtLang id=txtLang>Бесплатно свыше</span></td>
</tr>
	".$display."
    </table>
</table>
<div align=\"right\" style=\"padding:10\"><BUTTON style=\"width: 15em; height: 2.2em; margin-left:5\"  onclick=\"miniWin('delivery/adm_delivery_new.php',400,270)\">
<img src=\"icon/page_add.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=\"5\">
<span name=txtLang id=txtLang>Новая позиция</span>
</BUTTON></div>
</div>

	";
}
?>
