<?
function Catalog()
{
global $table_name,$PHP_SELF,$categoryID,$systems,$pid;
return "
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
<tr>
	<td id=pane align=center width=\"295\"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5 ><span name=txtLang id=txtLang>Каталоги</span></td>
    <td rowspan=2 valign=top width=\"100%\">
<iframe id=interfacesWin1 src=\"catalog/admin_cat_content.php\" width=\"100%\" height=\"580\"  name=\"frame2\" frameborder=\"0\" scrolling=\"Auto\" ></iframe>
	</td>
</tr>

<tr valign=\"top\">
	<td ><iframe id=interfacesWin2  src=\"catalog/tree.php\" width=\"300\"  height=\"550\"  scrolling=\"Auto\" name=\"frame1\"></iframe>

<div align=\"center\" style=\"padding:5\">
<table cellpadding=\"0\" cellspacing=\"0\">
  <tr>
  <td class=\"butoff\"><img name=imgLang src=\"icon/chart_organisation_add.gif\" alt=\"Открыть все\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.openAll()\">
    </td>
   	<td width=\"10\"></td>
	<td width=\"1\" bgcolor=\"#ffffff\"></td>
	<td width=\"1\" bgcolor=\"#808080\"></td>
   <td width=\"5\"></td>
	<td  class=\"butoff\"><img name=imgLang src=\"icon/chart_organisation_delete.gif\" alt=\"Закрыть все\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.closeAll()\"></td>
  </tr>
</table>
</div>

</td>
</tr>
</table>
";
}

function Disp_cat_new($category)// вывод каталогов в заглавии
{
global $table_name;
$sql="select name from $table_name where id='$category'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$name=$row['name'];
return $name;
}

function Cat_prod_disp_new()// выборка каталогов
{
global $table_name;
$sql="select * from $table_name where parent_to='0' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	@$dis_cat.="$name/pid=$id".Cat_prod_disp_pod_new($id)."#";
	}
$leng=strlen($dis_cat);
$dis_cat=substr($dis_cat,0,$leng-1);
$dis_cat=eregi_replace("t","т",$dis_cat);
return @$dis_cat;
}

function Cat_prod_disp_pod_new($parent)// выборка подкаталогов
{
global $table_name,$PHP_SELF;
$sql="select * from $table_name where parent_to='$parent' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	@$name_cat.="&$name (".Cat_prod_disp_num_new($id).")/pid=$id";
	}
return @$name_cat;
}

function Cat_prod_disp_num_new($n)// выбор кол-ва товаров из данного подкатолога
{
global $table_name2;
$sql="select id from $table_name2 where category='$n'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return $num;
}

function СategoryID($categoryID)// выборка каталогов и вывод в правое поле
{
global $table_name2,$pid,$_SESSION,$UserStatus;
if($categoryID=="all") $sql="select * from $table_name2 order by datas desc";
else $sql="select * from $table_name2 where category='$categoryID' order by datas desc";
$result=mysql_query($sql);
$num=0;
while(@$row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	$price=$row['price'];
	$sklad=$row['sklad'];
	$parent=$row['parent'];
	$parent_enabled=$row['parent_enabled'];
	if(($row['enabled'])=="1"){$checked="<img src=../img/icon-activate.gif name=imgLang  alt=\"В наличии\">";}else{$checked="<img src=../img/icon-deactivate.gif name=imgLang  alt=\"Отсутствует\">";};
    if(($row['spec'])=="1"){$checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-acl.gif  alt=\"Спецпредложение\">";}
    if(($row['yml'])=="1"){$checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-banner.gif   alt=\"YML прайс\">";}
    if(($row['newtip'])=="1") $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-move-banner.gif   alt=\"Новинка\">";
   //if(($row['sklad'])=="0") $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/cart_put.gif   alt=\"Покупка\">";
    if(($row['sklad'])=="1") $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/cart_error.gif   alt=\"Уведомление, под заказ\">";
    if($parent_enabled==1) $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/plugin.gif   alt=\"Подтип товара\">";
	$uid=$row['uid'];
	@$dis.="
	<tr class=row3 onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\">
	  <td align=center  onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\" align=\"left\">
	  $checked
	  </td>
	  <td width=\"55\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\" align=\"center\">
	  $id
	  </td>
	  <td width=\"500\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;$name
	  </td>
	  <td width=\"100\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;".($price*1)."
	  </td>
	  <td align=center>
	  <input type=\"checkbox\" value=\"".$id."\">
	  </td>
	</tr>
	";
	$num++;
	}
$disp="
<form name=\"form_flag\">
<table cellpadding=0 bgcolor=808080 border=0 cellspacing=1 width=100% class=\"sortable\" id=\"sort\">
<tr valign=\"top\">
	<td width=\"150\" id=pane align=center><span name=txtLang id=txtLang>Вывод</span></td>
    <td width=\"55\" id=pane align=center>ID</td>
	<td width=\"500\" id=pane align=center><span name=txtLang id=txtLang>Наименование</span></td>
    <td width=\"100\" id=pane align=center><span name=txtLang id=txtLang>Цена</span></td>
	<td width=\"25\" id=pane align=center>&plusmn;</td>
</tr>

".@$dis."
<input type=\"hidden\" value=\"$pid\" id=\"catal\" name=\"catal\">
</table>
</form>
";
return $disp;
}


function СategorySearch($words) //поиск
{
global $table_name2,$pid;
$sql="select * from $table_name2 where name LIKE '%$words%' or id='$words' or uid='$words' order by num";
$result=mysql_query($sql);
$num=0;
while(@$row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	$price=$row['price'];
	if(($row['enabled'])=="1"){$checked="<img src=../img/icon-activate.gif  alt=\"В наличии\">";}else{$checked="<img src=../img/icon-deactivate.gif   alt=\"Отсутствует\">";};
    if(($row['spec'])=="1"){$checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-acl.gif  alt=\"Спецпредложение\">";}
    if(($row['yml'])=="1"){$checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-banner.gif   alt=\"YML прайс\">";}
    if(($row['newtip'])=="1") $checked.="&nbsp;&nbsp;<img src=../img/icon-move-banner.gif   alt=\"Новинка\">";
	$uid=$row['uid'];
	@$dis.="
	<tr class=row3 bgcolor=ffffff id=\"c".$id."\"\>
	  <td align=center width=\"93\" onclick=\"ClickID('".$id."')\" align=\"left\">
<A id='ID$id'></A>
	  $checked
	  </td>
	  <td width=\"55\" onclick=\"ClickID('$id')\" align=\"center\">
	  $id
	  </td>
	  <td width=\"540\" onclick=\"ClickID('$id')\"> 
	  &nbsp;$name
	  </td>
	  <td width=\"100\" onclick=\"ClickID('$id')\"> 
	  &nbsp;$price
	  </td>
	  <td >
	  <input type=\"checkbox\" value=\"".$id."\">
	  </td>
	</tr>
	";
	$num++;
	}
$disp="
<table cellpadding=0 bgcolor=808080 border=0 cellspacing=1 width=100%>
<form name=\"form_flag\">
<tr valign=\"top\">
	<td width=\"100\" id=pane align=center><span name=txtLang  id=txtLang>Вывод</span></td>
    <td width=\"55\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>ID</td>
	<td width=\"540\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>Наименование</td>
    <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>Цена</td>
	<td width=\"25\" id=pane align=center>&plusmn;</td>
</tr>
".@$dis."

</form>

</table>
";
return $disp;
}
?>