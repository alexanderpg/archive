<?

function Vivod_cat_table()// вывод каталогов таблицей
{
global $SysValue,$LoadItems;
$sql="select id from ".$SysValue['base']['table_name']." where parent_to=0 order by num";
$result=mysql_query($sql);
$i=0;
$j=0;
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
	
   // Определяем переменые
$SysValue['other']['catalogId']= $id;
$SysValue['other']['catalogI']= $i;
$SysValue['other']['catalogTemplates']=$SysValue['dir']['templates'].chr(47).$LoadItems['System']['skin'].chr(47);
$SysValue['other']['catalogPodcatalog']= Vivod_pot($id);
$SysValue['other']['catalogTitle']= $LoadItems['Catalog'][$id]['name'];
$SysValue['other']['catalogName']= $LoadItems['Catalog'][$id]['name'];

// Подключаем шаблон
$dis=ParseTemplateReturn($SysValue['templates']['catalog_forma']);

 if($j==1){ $td="<td valign=\"top\">"; $j=0; $td2="</td>";}
 else {
 $td="<tr><TD colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
 $td.="<tr><td valign=\"top\">"; $j++; $td2="</td>";
 $td2.="<TD width=5><IMG height=1 src=\"images/spacer.gif\" width=5></TD>";
 }
 
 @$disp.=$td.$dis.$td2;

	$i++;
	 }

@$SysValue['sql']['num']++;
return @$disp;
}

$SysValue['other']['leftCatalTable']= Vivod_cat_table();  // Генерация каталогов табл.
?>
