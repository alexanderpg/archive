<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Модуль Автономной Загрузки 1С      |
+-------------------------------------+
*/

include("login.php");


function GetSystems()// вывод настроек
{
global $SysValue;
$sql="select admoption from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$option=unserialize($row['admoption']);
return $option['sklad_status'];
}


$option=GetSystems();


class ReadCsv1C{
   var $CsvContent;
   var $ReadCsvRow;
   var $TableName;
   var $Sklad_status;
	
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
   
   
   function ReadCsv1C($CsvContent,$table_name2,$sklad_status){
   $this->CsvContent = $CsvContent;
   $this->TableName = $table_name2;
   $this->Sklad_status = $sklad_status;
   $this->ReadCsvRow();
   $this->DoUpdatebase();
   }
   
   
   function DoUpdatebase(){
    $CsvToArray = $this->CsvToArray();
	if(is_array($CsvToArray))
	foreach ($CsvToArray as $v)
	$this->UpdateBase($v);
   }

   function UpdateBase($CsvToArray){
   global $_SESSION;
$sql="UPDATE ".$this->TableName." SET ";
$sql.="price='".$CsvToArray[7]."', ";// цена 1


// Склад
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


$sql.="price2='".$CsvToArray[8]."', ";// цена 2
$sql.="price3='".$CsvToArray[9]."', ";// цена 3
$sql.="price4='".$CsvToArray[10]."', ";// цена 4
$sql.="price5='".$CsvToArray[11]."', ";// цена 5
$sql.="items='".$CsvToArray[6]."', ";// склад
$sql.="weight='".$CsvToArray[12]."' ";// вес
$sql.=" where uid='".$CsvToArray[0]."'";
$result=mysql_query($sql);
 }
   
}



if(preg_match("/[^(0-9)|(\-)]/",$date)) $date="";



$path="sklad";
$dir=$path."/".$date;


// Смотрим папку
if (@$files=="all" and is_dir($dir)) 
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($file!="." and $file!="..")
            @$list_file[]= $file;
        }
        closedir($dh);
    }
if(is_file("./".$dir."/".$files)) {
      $list_file[]=$files;
	  }
     
// тестирование
if(isset($error)){
if(is_array($list_file))
$list_file[$error]="";
}
	  
if(is_array($list_file))
foreach($list_file as $val){

// Включаем таймер
$time=explode(' ', microtime());
$start_time=$time[1]+$time[0];

@$fp = fopen($dir."/".$val, "r");
if ($fp) {
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  fclose($fp);
  $ReadCsv = new ReadCsv1C($CsvContent,$SysValue['base']['table_name2'],$option);
  @$F_done.=$val.";";
  

// Выключаем таймер
$time=explode(' ', microtime());
$seconds=($time[1]+$time[0]-$start_time);
$seconds=substr($seconds,0,6);

$sql = "
	INSERT INTO ".$SysValue['base']['table_name12']."
	VALUES ('','".date("U")."','$dir','$val','$seconds')
	";
	mysql_query($sql);
}
}
else exit("Не могу прочитать файл ".$dir."/".$val);

echo $date.";".$F_done;
?>
