<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");


function ReturnSumma($sum,$disc){
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}


// Пишем GZIP файлы
function gzcompressfile($source,$level=false){ 
   $dest=$source.'.gz'; 
   $mode='wb'.$level; 
   $error=false; 
   if($fp_out=gzopen($dest,$mode)){ 
       if($fp_in=fopen($source,'rb')){ 
           while(!feof($fp_in)) 
               gzwrite($fp_out,fread($fp_in,1024*512)); 
           fclose($fp_in); 
           } 
         else $error=true; 
       gzclose($fp_out); 
	   unlink($source);
	   rename($dest, $source.'.bz2');
       } 
     else $error=true; 
   if($error) return false; 
     else return $dest; 
   } 

// Чистим теги
function CleanOut($str){
$str = preg_replace('([\r\n\rn\t])', '', $str);
$str = @html_entity_decode($str);
return $str;
}

//Получение новых характеристик и их количества
function getChars($allCharsArray,$categoryID) {
	global $SysValue;
	$sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$allCharsID=unserialize($row['sort']); //Забираем все характеристики каталога

	foreach($allCharsID as $charID) {
		$sql2='select name from '.$SysValue['base']['table_name20'].' WHERE id='.$charID; //Получаем названия хар-к
		$result2=mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		@$res.=CleanOut($row2['name']).';'; //Формируем ряд. Имена характеристик
		$valuesArray=$allCharsArray[$charID]; //Массив id значений характеристик
		$splitter=''; //Для первой строки разделитель - пуст
		foreach ($valuesArray as $valueID) {
			$sql3='select name from '.$SysValue['base']['table_name21'].' WHERE id='.$valueID; //Получаем названия значений
			$result3=mysql_query($sql3);
			$row3 = mysql_fetch_array($result3);
			@$res.=$splitter.CleanOut($row3['name']); //Формируем ряд. Имена характеристик
			$splitter=' && '; //Для всех следующих значений устанавливаем разделитель
		}
		@$res.=';'; //Закрыть ячейку после ввода значений
	}
	return $res;
}   

//Получение количества характеристик для каталога
function getCharsAmount($categoryID) {
	global $SysValue;
	$sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$allCharsID=unserialize($row['sort']); //Забираем все характеристики каталога
	return count($allCharsID);
}

if(CheckedRules($UserStatus["csv"],1) == 1){

switch($DO){

    case("base"):// Выгрузка всей базы
$sql='select * from '.$SysValue['base']['table_name2'];
$result=mysql_query($sql);
$num=0;
$amo=0;
while($row = mysql_fetch_array($result)) {
    $id=$row['id'];
    $name=str_replace(";","|",trim($row['name']));
	$category=$row['category'];
	$content= CleanOut($row['content']);
	$description=CleanOut($row['description']);
	$price=$row['price'];
	$price2=trim($row['price2']);
	$price3=trim($row['price3']);
	$price4=trim($row['price4']);
	$price5=trim($row['price5']);
	$uid=trim($row['uid']);
	$enabled=$row['enabled'];
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
//	$vendor_array=$row['vendor_array'];
//print_r(unserialize($row['vendor_array']));
	$vendor_array=base64_encode($row['vendor_array']);
	$vendorArray=unserialize($row['vendor_array']);
	$num=$row['num'];
	$items=trim($row['items']);
	$weight=trim($row['weight']);
	@$csv.="$id;$name;$description;$pic_small;$content;$pic_big;$items;$price;$price2;$price3;$price4;$price5;$weight;$uid;$category";
	@$csv.=';'.getChars($vendorArray,$category);
	@$csv.="\n"; //Конец строки

	$newamo=getCharsAmount($category);
	if ($newamo>$amo) {$amo=$newamo;}
}

for ($i=0; $i<$amo; $i++) { //Сделать в заголовке ячеек для 
	@$charsFiller.=';Характеристика;Значение';
}

$csv="Код ID;Наименование;Краткое описание;Маленькая картинка;Подробное описание;Большая картинка;Склад;Цена1;Цена2;Цена3;Цена4;Цена5;Вес;Артикул;Кaтегория ID$charsFiller\n".$csv;

  $file="base_".date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  $sorce="../csv/".$file;
  }
//sleep(1);
//exit("../csv/".$file);
gzcompressfile($sorce);
header("Location: ../csv/".$file.".bz2");
//header("Location: ../csv/".$file."");
	break;

    case("stats1"):// Выгрузка статистики
	$sql="select * from $table_name1 where datas<'$pole2' and datas>'$pole1' order by id desc";
$result=mysql_query($sql);
$num=0;
$csv="Дата;Кол-во;Сумма ".GetIsoValutaOrder()."\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $datas=dataV($row['datas']);
	$order=unserialize($row['orders']);
	$csv.="$datas;".$order['Cart']['num'].";".ReturnSumma($order['Cart']['sum'],$order['Person']['discount'])."\n";
	@$sum+=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	@$num+=$order['Cart']['num'];
	}
	$csv.="Итого:;$num;$sum\n";
  $file=date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  }
//sleep(10);
header("Location: ../csv/".$file);

	break;

	// Выгрузка Прайса
    default:
if($IDS=="all") $string="or id>'0'";
else{
$IdsArray=split(",",$IDS);
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";
   }
$sql="select * from $table_name2 where id='0' $string";
$result=mysql_query($sql);
$num=0;
$csv="Код товара;Артикул;Наименование;Цена1;Цена2;Цена3;Цена4;Цена5;Новинка;Спецпредложение;Склад;Вес;Сортировка\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=str_replace("|",";",trim($row['name']));
	$price=trim($row['price']);
	$price2=trim($row['price2']);
	$price3=trim($row['price3']);
	$price4=trim($row['price4']);
	$price5=trim($row['price5']);
	$uid=trim($row['uid']);
	$spec=trim($row['spec']);
	$items=trim($row['items']);
	$newtip=trim($row['newtip']);
	$num=trim($row['num']);
	$weight=trim($row['weight']);
$csv.="$id;$uid;$name;$price;$price2;$price3;$price4;$price5;$newtip;$spec;$items;$weight;$num\n";
	}
  $file=date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  }
sleep(1);
//exit("../csv/".$file);
header("Location: ../csv/".$file);
}
}else $UserChek->BadUserFormaWindow();

?>