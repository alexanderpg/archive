<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Подключаем библиотеку поддержки.
require_once "../../lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");



switch($do){

      case("del"):
	  $sql="delete from ".$SysValue['base']['table_name35']." where id=".$_REQUEST['xid'];
      mysql_query($sql);
	  
	  // Удаляем изображение с сервера
	  $name=$_REQUEST['img'];
	  $s_name=str_replace(".","s.",$name);
	  unlink($DOCUMENT_ROOT.$name);
	  unlink($DOCUMENT_ROOT.$s_name);
	  
	  $sql="select * from ".$SysValue['base']['table_name35']." where parent=".$_REQUEST['uid']." order by num desc";
      $result=mysql_query($sql);
	  
$i=1;
while($row = mysql_fetch_array($result))
    {
    $name=$row['name'];
    $id=$row['id'];
    @$dis.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('adm_galeryID.php?n=$id',650,500)\">
	  <td align=center>$i</td>
	   <td>$name</td>
	</tr>
	";
	$i++;
	}

$interfaces='
<table cellpadding="0" cellspacing="1"  border="0" bgcolor="#808080" width="100%">
<tr>
    <td width="20" id=pane align=center>№</td>
	<td id=pane align=center>Размещение</td>
</tr>
    '.$dis.'
    </table>
';
  break;


      case("update"):

$sql="select * from ".$SysValue['base']['table_name35']." where parent=".$_REQUEST['xid']." order by num desc";
$result=mysql_query($sql);
$i=1;
while($row = mysql_fetch_array($result))
    {
    $name=$row['name'];
    $id=$row['id'];
    @$dis.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('adm_galeryID.php?n=$id',650,500)\">
	  <td align=center>$i</td>
	   <td>$name</td>
	</tr>
	";
	$i++;
	}

$interfaces='
<table cellpadding="0" cellspacing="1"  border="0" bgcolor="#808080" width="100%">
<tr>
    <td width="20" id=pane align=center>№</td>
	<td id=pane align=center>Размещение</td>
</tr>
    '.$dis.'
    </table>
';
  break;
  
  
     case("num"):

mysql_query("update ".$SysValue['base']['table_name35']." set num='".$_REQUEST['num']."', info='".$_REQUEST['info']."' where id=".$_REQUEST['xid']);

$sql="select * from ".$SysValue['base']['table_name35']." where parent=".$_REQUEST['uid']." order by num desc";

$result=mysql_query($sql);
$i=1;
while($row = mysql_fetch_array($result))
    {
    $name=$row['name'];
    $id=$row['id'];
    @$dis.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('adm_galeryID.php?n=$id',650,500)\">
	  <td align=center>$i</td>
	   <td>$name</td>
	</tr>
	";
	$i++;
	}

$interfaces='
<table cellpadding="0" cellspacing="1"  border="0" bgcolor="#808080" width="100%">
<tr>
    <td width="20" id=pane align=center>№</td>
	<td id=pane align=center>Размещение</td>
</tr>
    '.$dis.'
    </table>
';
  break;
  
 }


 

$_RESULT = array(
  "interfaces"=> @$interfaces
  ); 

?>