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
   var $Sklad_status;
   var $ImagePath="/UserFiles/Image/";

   
   function ReadCsvRow(){
   $this->ReadCsvRow = split("\n",$this->CsvContent);
   array_shift($this->ReadCsvRow);
   array_pop($this->ReadCsvRow);
   }
   
   function CleanStr($str){
   $a= str_replace("\"", "", $str);
   return str_replace("'", "", $a);
   }
   
   function PrintThis($name,$string){
	  echo"<br><u><em>".$name."</em></u><pre>";
      print_r($string);
      echo"</pre><br>";
	  }
   
   function CsvToArray(){
       while (list($key, $val) = each($this->ReadCsvRow)) {
       $array1=split(";",$val);
	   
	        if(!($OutArray[$array1[0]])) $OutArray[$array1[0]]=$this->CleanStr($array1);
             else $OutArray[]=$this->CleanStr($array1);
       }
   return $OutArray;
   }
   
   
   function ReadCsv1C($CsvContent,$table_name2,$sklad_status){
   $this->CsvContent = $CsvContent;
   $this->TableName = $table_name2;
   $this->Sklad_status = $sklad_status;
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
   $sql="select id from ".$this->TableName." where uid='$uid'";
   $result=mysql_query($sql);
   @$num=mysql_num_rows(@$result);
   return @$num;
   }
   
   function ImagePlus($img){// Путь к картинке
   $dis=$this->ImagePath.$img;
   return $dis;
   }
   
   function UpdateBase($CsvToArray){
   global $_SESSION,$_REQUEST;
   $CheckBase=$this->CheckBase($CsvToArray[0]);
   
   // Наличие товара
   if($CsvToArray[6]>0) $enabled=1;
     else $enabled=0;
   
   
if(!empty($CheckBase) and $CsvToArray[0]!=""){// Обновляем  
   
$sql="UPDATE ".$this->TableName." SET ";

// Отсеиваем поля
if($_REQUEST['tip'][1] == 1)$sql.="name='".$CsvToArray[1]."', ";// описание краткое
if($_REQUEST['tip'][2] == 1) $sql.="description='".$CsvToArray[2]."', ";// описание краткое
if($_REQUEST['tip'][3] == 1) $sql.="pic_small='".$this->ImagePlus($CsvToArray[3])."', ";// маленькая картинка
if($_REQUEST['tip'][4] == 1) $sql.="content='".$CsvToArray[4]."', ";// подробное описание
if($_REQUEST['tip'][5] == 1) $sql.="pic_big='".$this->ImagePlus($CsvToArray[5])."', ";// большая картинка
if($_REQUEST['tip'][6] == 1) $sql.="price='".$CsvToArray[7]."', ";// цена 1

// Склад
if($_REQUEST['tip'][11] == 1){
  switch($this->Sklad_status){
  
       case(3):
	   if($CsvToArray[6]<1) $sql.="sklad='1', ";
	     else $sql.="sklad='0', ";
	   break;
	   
	   case(2):
	   if($CsvToArray[6]<1) $sql.="enabled='0', ";
	     else $sql.="enabled='1', ";
	   break;
	   
	   default: $sql.="";
  
  }
}

if($_REQUEST['tip'][7] == 1) $sql.="price2='".$CsvToArray[8]."', ";// цена 2
if($_REQUEST['tip'][8] == 1) $sql.="price3='".$CsvToArray[9]."', ";// цена 3
if($_REQUEST['tip'][9] == 1) $sql.="price4='".$CsvToArray[10]."', ";// цена 4
if($_REQUEST['tip'][10] == 1) $sql.="price5='".$CsvToArray[11]."', ";// цена 5
if($_REQUEST['tip'][11] == 1) $sql.="items='".$CsvToArray[6]."', ";// склад
if($_REQUEST['tip'][12] == 1) $sql.="weight='".$CsvToArray[12]."' ";// склад

$sql.=" where uid='".$CsvToArray[0]."'";
$result=mysql_query($sql);
 

}else{// Создаем новый товар


// Отсеиваем поля
if($_REQUEST['tip'][2] != 1) $CsvToArray[2]="";// описание краткое
if($_REQUEST['tip'][3] != 1) $CsvToArray[3]="";// маленькая картинка
if($_REQUEST['tip'][4] != 1) $CsvToArray[4]="";// подробное описание
if($_REQUEST['tip'][5] != 1) $CsvToArray[5]="";// большая картинка
if($_REQUEST['tip'][6] != 1) $CsvToArray[7]="";// цена 1
if($_REQUEST['tip'][7] != 1) $CsvToArray[8]="";// цена 2
if($_REQUEST['tip'][8] != 1) $CsvToArray[9]="";// цена 3
if($_REQUEST['tip'][9] != 1) $CsvToArray[10]="";// цена 4
if($_REQUEST['tip'][10] != 1) $CsvToArray[11]="";// цена 5
if($_REQUEST['tip'][11] != 1) $CsvToArray[6]="";// склад
if($_REQUEST['tip'][12] != 1) $CsvToArray[12]="";// вес

$sql="INSERT INTO ".$this->TableName."
VALUES ('','1000001','".trim($CsvToArray[1])."','".$CsvToArray[2]."','".$CsvToArray[4]."','".$CsvToArray[7]."','','','".$this->Zero($CsvToArray[9])."','".$enabled."','".$CsvToArray[0]."','','','','','1','','','','','".date("U")."','','".$_SESSION['idPHPSHOP']."','','','','','','','','".$this->ImagePlus($CsvToArray[3])."','".$this->ImagePlus($CsvToArray[5])."','','0','','".$CsvToArray[6]."','".$CsvToArray[12]."','".$CsvToArray[8]."','".$CsvToArray[9]."','".$CsvToArray[10]."','".$CsvToArray[11]."','','','')";
$result=mysql_query($sql);
 }
   }
   

function PrintResultDo($CsvToArray){
static $n;
	$disp="
	<tr class='row' style=\"padding:3\" onmouseover=\"show_on('r".$CsvToArray[0]."')\" id=\"r".$CsvToArray[0]."\" onmouseout=\"show_out('r".$CsvToArray[0]."')\">
    <td align=center>".(@$n+1)."</td>
	 <td align=center>".$CsvToArray[0]."</td>
	 <td >".$CsvToArray[1]."</td>
	 <td align=center>".$CsvToArray[7]."</td>
	 <td align=center>".$CsvToArray[8]."</td>
	 <td align=center>".$CsvToArray[9]."</td>
	 <td align=center>".$CsvToArray[10]."</td>
	 <td align=center>".$CsvToArray[11]."</td>
	 <td align=center>".$CsvToArray[6]."</td>
	 <td align=center>".$CsvToArray[12]."</td>
	</tr>
	";
	$n++;
	return $disp;
   }
}

function Ors($n){
   if($n==0) return "<font color=FF0000>нет</font>";
   elseif($n==1) return "да";
   else return "non";
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
  $ReadCsv = new ReadCsv1C($CsvContent,$table_name2,$option['sklad_status']);
  $interface.='
<div id=interfacesWin name=interfacesWin align="left" style="width:100%;height:580;overflow:auto"> 
<TABLE style="border: 1px;border-style: inset;" cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR>
<TD vAlign=top>
<table width="100%" cellpadding="0" cellspacing="1" class="sortable" id="sort" bgcolor="#808080">
<tr>
    <td id="pane" width="50">№</td>
	<td id="pane">Код 1С</td>
	<td id="pane">Название товара</td>
	<td id="pane">Цена 1</td>
	<td id="pane">Цена 2</td>
	<td id="pane">Цена 3</td>
	<td id="pane">Цена 4</td>
	<td id="pane">Цена 5</td>
	<td id="pane">Склад</td>
	<td id="pane">Вес</td>
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
</form></div>
    ';
  }
  } elseif($_REQUEST['page']=="load"){
@$fp = fopen("../csv/".@$_REQUEST['name'], "r");
if ($fp) {
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  fclose($fp);
$ReadCsv = new ReadCsv1C($CsvContent,$table_name2,$option['sklad_status']);
$Done2 = $ReadCsv->DoUpdatebase2();
$interface.='

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4>Загрузка товарной базы выполнена!</h4></div>
<FIELDSET id=fldLayout style="width: 60em; height: 8em;">


<table cellpadding="10" align="center">
<FORM name=csv_upload action="" method=post encType=multipart/form-data>
<tr>
	<td>
	Выберите файл с разширением *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase1C(this.form.csv_file,\'predload\',null)" type=button value=OK><br>
<INPUT class=but type=reset value=Сброс> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>
</table>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10" width="100%">
<tr>
	<td width="50%" ><h4><span name=txtLang id=txtLang>Ход операции</span></h4>
<ol>
	<li><span name=txtLang id=txtLang><strong>Шаг 5</strong> - перейти в раздел <a href="javascript:DoReload(\'cat_prod\')"><img src="img/i_eraser[1].gif" alt="" width="16" height="16" border="0" hspace="3" align="absmiddle">"Каталог</a> - Выгруженные товары - 1C База"</span>
    <li><span name=txtLang id=txtLang><strong>Шаг 6</strong> - выделите флажком товары и выберите папку для переноса опцией "С отмеченными - Перенести в каталог". Если требуется,  составьте соответствующие каталоги.</span>
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
