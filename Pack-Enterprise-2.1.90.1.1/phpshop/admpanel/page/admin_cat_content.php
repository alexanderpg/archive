<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../java/sorttable.js"></script>

</head>
<body style="background: threedface; color: windowtext;" topmargin="0" rightmargin="3" leftmargin="3"  onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0);">
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
function PageList($pid,$words="")// Вывод 
{
global $SysValue,$SERVER_NAME;
if(!empty($words))
$sql="select * from ".$SysValue['base']['table_name11']." where name REGEXP'".$words."' or link REGEXP'".$words."'";
elseif($pid=="all") $sql="select * from ".$SysValue['base']['table_name11']." order by name";
 else $sql="select * from ".$SysValue['base']['table_name11']." where category=$pid";
 
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$link=$row['link'];
	if(($row['enabled'])=="1"){$checked="<img name=imgLang src=../img/icon-activate.gif name=imgLang  alt=\"В наличии\">";}else{$checked="<img src=../img/icon-deactivate.gif name=imgLang  alt=\"Отсутствует\">";};
    if(($row['secure'])=="1"){$checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-acl.gif name=imgLang alt=\"Только для зарегистрированных пользователей\">";}
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row >
   <td class=\"forma\">$checked</td>
	<td onclick=\"miniWin('adm_pagesID.php?id=$id',650,600)\" class=\"forma\">
	$link
	</td>
	<td onclick=\"miniWin('adm_pagesID.php?id=$id',650,600)\" class=\"forma\">
	$name
	</td>
	<td class=\"forma\">
	<a href=\"".$SysValue['dir']['dir']."/page/".$link.".html\" target=\"_blank\" class=none><img src=\"../img/icon_world.gif\" alt=\"Перейти по ссылке\" border=\"0\" align=\"absmiddle\" hspace=\"1\">".$SERVER_NAME.$SysValue['dir']['dir']."/page/".$link.".html</a>
	</td>
	<td class=forma style=\"padding:0px\">
	<input type=checkbox name='c".$id."' value=\"".$id."\">
	</td>
    </tr>
	";
	@$i++;
	}
if($i>20)$razmer="height:600;";
	$dis="
<div align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<form name=\"form_flag\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
    <td width=\"10%\" id=pane align=center><span name=txtLang id=txtLang>Вывод</span></td>
    <td width=\"10%\" id=pane align=center><span name=txtLang id=txtLang>Ссылка</span></td>
	<td width=\"45%\" id=pane align=center><span name=txtLang id=txtLang>Название</span> (Title)</td>
	<td width=\"35%\" id=pane align=center><span name=txtLang id=txtLang>Реальное размещение</span></td>
     <td width=\"25\" id=pane align=center style=\"padding:0px\">
	<input type=checkbox value=1 name=DoAll onclick=\"SelectAllBox(this,form_flag)\"></td>
  
</tr>
	".$display."
    </table></form>
<input type=\"hidden\" value=\"$pid\" id=\"catal\" name=\"catal\">
</div>
	";
return $dis;
}
	
if(isset($pid) or isset($words))
	{
	echo PageList($pid,$words);
	}

?>
</body>
</html>