<?

function RekursMainCatalogList($id){
global $SysValue,$LoadItems;
$podcatalog_id = array_keys($LoadItems['CatalogKeys'],$id);
      if(count($podcatalog_id)>0){
	  foreach($podcatalog_id as $key){
	  
	  @$dis.="<a href=\"/shop/CID_$key.html\" title=\"".$LoadItems['Catalog'][$key]['name']."\">".$LoadItems['Catalog'][$key]['name']."</a> | ";

	  @$dis.=RekursMainCatalogList($key);

	  
	  }
	  }
return $dis;
}

function Vivod_cat_table()// вывод каталогов таблицей
{
global $SysValue,$LoadItems;
$sql="select id,content from ".$SysValue['base']['table_name']." where parent_to=0 order by num";
$result=mysql_query($sql);
$i=0;
$j=0;
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
	$content=$row['content'];
	@$dis_c="";
   // Определяем переменые
$SysValue['other']['catalogId']= $id;
$SysValue['other']['catalogI']= $i;
$SysValue['other']['catalogTemplates']=$SysValue['dir']['templates'].chr(47).$LoadItems['System']['skin'].chr(47);
$SysValue['other']['catalogTitle']= $LoadItems['Catalog'][$id]['name'];
$SysValue['other']['catalogName']= $LoadItems['Catalog'][$id]['name'];
$SysValue['other']['catalogContent']= $content;

$SysValue['other']['catalogPodcatalog']=RekursMainCatalogList($id);

// Подключаем шаблон
$dis=ParseTemplateReturn("catalog/catalog_table_forma.tpl");

 if($j==1){ $td="<td valign=\"top\">"; $j=0; $td2="</td>";}
 else {
 $td="<tr><TD colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
 $td.="<tr><td valign=\"top\">"; $j++; $td2="</td>";
 $td2.="<TD width=5><IMG height=1 src=\"images/spacer.gif\" width=5></TD>";
 }
 
 @$disp.=$td.$dis.$td2;

	$i++;
	 }

$dis='
<table cellpadding="0" cellspacing="3">
'.$disp.'
</table>
';
return @$dis;
}

$SysValue['other']['leftCatalTable']= Vivod_cat_table();  // Генерация каталогов табл.
?>
