<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);


class ReadCsv1C{
   var $CsvContent;
   var $ReadCsvRow;
   var $TableName;
   var $TotalUpdate=0;
   var $TotalCreate=0;
   
   function ReadCsvRow(){
   $this->ReadCsvRow = split("\n",$this->CsvContent);
   array_shift($this->ReadCsvRow);
   array_pop($this->ReadCsvRow);
   }
   
   function CleanStr($str){
   $a= str_replace("\"", "", $str);
   return str_replace("'", "", $a);
   }
   
   function CsvToArray(){
       while (list($key, $val) = each($this->ReadCsvRow)) {
       $array1=split(";",$val);
	   
	        if(!($OutArray[$array1[0]])) $OutArray[$array1[0]]=$this->CleanStr($array1);
             else $OutArray[]=$this->CleanStr($array1);
       }
   return $OutArray;
   }
   
   
   function ReadCsv1C($CsvContent,$table_name){
   $this->CsvContent = $CsvContent;
   $this->TableName = $table_name;
   $this->ReadCsvRow();
   }
   
   function DoUpdatebase1(){
    $CsvToArray = $this->CsvToArray();
	foreach ($CsvToArray as $v)
	@$return.=$this->PrintResultDo($v);
	return $return;
   }
   
   function DoUpdatebase2(){
    $CsvToArray = $this->CsvToArray();
	foreach ($CsvToArray as $v)
	$this->UpdateBase($v);
   }

   function Zero($a){
   if($a!=0 or !empty($a)) return 1;
    else return 0;
   }
   
   function Rip($a){
   if($a==0) return 1;
    else return 0;
   }
   
   function CheckBase($uid){// Проверяем есть ли товар
   $sql="select id from ".$this->TableName." where id='$uid'";
   $result=mysql_query($sql);
   @$num=mysql_num_rows(@$result);
   return @$num;
   }
   
   
   function UpdateBase($CsvToArray){
   global $_SESSION,$_REQUEST;
   $CheckBase=$this->CheckBase($CsvToArray[0]);
   
   
   
if(!empty($CheckBase) and $CsvToArray[0]!=""){// Обновляем  
   
$sql="UPDATE ".$this->TableName." SET 
id = '".trim($CsvToArray[0])."'
name = '".CleanStr($CsvToArray[1])."', 
parent_to = '".trim($CsvToArray[3])."' 
where id='".$CsvToArray[0]."'";
$result=mysql_query($sql);
$this->TotalUpdate++;

}else{// Создаем новый каталог


$sql="INSERT INTO ".$this->TableName." SET 
id = '".trim($CsvToArray[0])."',
name = '".CleanStr($CsvToArray[1])."', 
parent_to = '".trim($CsvToArray[2])."' 
";
$result=mysql_query($sql);
$this->TotalCreate++;
 }
   }
   

function PrintResultDo($CsvToArray){
static $n;
	$disp="
	<tr class='row' style=\"padding:3\" onmouseover=\"show_on('r".$CsvToArray[0]."')\" id=\"r".$CsvToArray[0]."\" onmouseout=\"show_out('r".$CsvToArray[0]."')\">
    <td align=center>".(@$n+1)."</td>
	 <td align=center>".$CsvToArray[0]."</td>
	 <td >".$CsvToArray[1]."</td>
	 <td align=center>".$CsvToArray[2]."</td>
	</tr>
	";
	$n++;
	return $disp;
   }
}


   // Проверка расширения файла
function getExt($sFileName)//ffilter
	{
	$sTmp=$sFileName;
	while($sTmp!="") 
		{
		$sTmp=strstr($sTmp,".");
		if($sTmp!="")
			{
			$sTmp=substr($sTmp,1);
			$sExt=$sTmp;
			}
		}
	$pos=stristr($sFileName, "php");
    if($pos === false) return strtolower($sExt);
	}
   
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest =& new JsHttpRequest("windows-1251");

// Расширение
$_FILES['file']['ext']=getExt($_FILES['file']['name']);

if($_REQUEST['page']=="predload" and $_FILES['file']['ext']=="csv"){

// Загружаем
if(move_uploaded_file(@$_FILES['file']['tmp_name'], "../csv/".@$_FILES['file']['name']))
@$fp = fopen("../csv/".@$_FILES['file']['name'], "r");
   
   
if ($fp) {
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  fclose($fp);
  $ReadCsv = new ReadCsv1C($CsvContent,$SysValue['base']['table_name']);
  $interface.='
<div id=interfacesWin name=interfacesWin align="left" style="width:100%;height:580;overflow:auto"> 
<TABLE style="border: 1px;border-style: inset;" cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR>
<TD vAlign=top>
<table width="100%" cellpadding="0" cellspacing="1" class="sortable" id="sort" bgcolor="#808080">
<tr>
    <td id="pane" width="50">№</td>
	<td id="pane" width="100">Код категории</td>
	<td id="pane">Название категории</td>
	<td id="pane" width="100">Код родителя</td>
</tr>
'.$ReadCsv->DoUpdatebase1().'
</table>
</TD></TR><form method=post action="" encType=multipart/form-data name=forma2></TBODY></TABLE>
</div>
<div align="center" style="padding-top:20">
<button style="WIDTH: 17em; HEIGHT: 2.3em" onclick="DoReload(\'csv1c\')">
<img src="img/icon-setup2.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">
Выбрать другой файл</button>
&nbsp;&nbsp;
<button style="WIDTH: 17em; HEIGHT: 2.3em" onclick="DoLoadBase1C(null,\'load\',\''.$_FILES['file']['name'].'\')">
<img src="img/icon-setup.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">
Принять изменения</button>
<input type="hidden" id="tip_1" value="'.$_REQUEST['tip'][1].'">
<input type="hidden" id="tip_2" value="'.$_REQUEST['tip'][2].'">
<input type="hidden" id="tip_3" value="'.$_REQUEST['tip'][3].'">
<input type="hidden" id="tip_4" value="'.$_REQUEST['tip'][4].'">
<input type="hidden" id="tip_5" value="'.$_REQUEST['tip'][5].'">
<input type="hidden" id="tip_6" value="'.$_REQUEST['tip'][6].'">
<input type="hidden" id="tip_7" value="'.$_REQUEST['tip'][7].'">
<input type="hidden" id="tip_8" value="'.$_REQUEST['tip'][8].'">
<input type="hidden" id="tip_9" value="'.$_REQUEST['tip'][9].'">
<input type="hidden" id="tip_10" value="'.$_REQUEST['tip'][10].'">
<input type="hidden" id="tip_11" value="'.$_REQUEST['tip'][11].'">
<input type="hidden" id="tip_12" value="'.$_REQUEST['tip'][12].'">
<input type="hidden" id="tip_14" value="'.$_REQUEST['tip'][14].'">
<input type="hidden" id="tip_15" value="'.$_REQUEST['tip'][15].'">
<input type="hidden" id="tip_16" value="'.$_REQUEST['tip'][16].'">
<input type="hidden" id="tip_17" value="'.$_REQUEST['tip'][17].'">
<input type="hidden" id="1c_tree_check" value="1">
</form></div>
    ';
  }
  } elseif($_REQUEST['page']=="load"){
@$fp = fopen("../csv/".@$_REQUEST['name'], "r");
if ($fp) {
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  fclose($fp);
$ReadCsv = new ReadCsv1C($CsvContent,$SysValue['base']['table_name']);
$Done2 = $ReadCsv->DoUpdatebase2();
$interface.='
<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang2 id=txtLang2>Загрузка каталога товарной базы 1C:Предприятие выполнена!</span></h4></div>
<FIELDSET id=fldLayout style="width: 60em; height: 8em;">
<table style="border: 1px;border-style: inset;background-color: White;" cellpadding="10" width="100%">
<tr>
	<td width="50%" ><h4><span name=txtLang2 id=txtLang2>Отчет:</span></h4>
<ol>
	<li>Создано новых позиций: '. $ReadCsv->TotalCreate.'
	<li>Обновлено позиций: '. $ReadCsv->TotalUpdate.'
</ol></td>
</tr>
</table>
</FIELDSET>
</TD></TR></TABLE>
    ';

}}else @$interface.=$disp='
	  <table width="100%" height="100%" style="Z-INDEX:2;">
<tr>
	<td valign="middle" align="center">
		<div style="width:400px;height:100px;BACKGROUND: #C0D2EC;padding:10px;border: solid;border-width: 1px; border-color:#4D88C8;FILTER: alpha(opacity=80);" align="left">
<table width="100%" height="100%">
<tr>
	<td width="35" vAlign=center ><IMG 
            hspace=0 src="img/i_support_med[1].gif" align="absmiddle" 
            border=0 ></td>
	<td ><b>Внимание, выберите файл с расширением *.csv.
	Повторите  <a href="javascript:DoReload(\'csv1c\')" style="color:red">загрузку файла</a>.</b></td>
</tr>
</table>

		</div>
</td>
</tr>
</table>
	  
	  ';

$_RESULT = array(
  "name"   => @$_FILES['file']['name'],
  "content"=> @$interface,
  "size"   => @filesize($_FILES['file']['tmp_name']),
); 
?>
