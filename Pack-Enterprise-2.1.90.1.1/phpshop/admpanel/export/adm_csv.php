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



if(CheckedRules($UserStatus["csv"],1) == 1){

switch($DO){

    case("base"):// Выгрузка всей базы
$sql="select * from $table_name2";
$result=mysql_query($sql);
$num=0;
$csv="Код ID;Наименование;Краткое описание;Маленькая картинка;Подробное описание;Большая картинка;Склад;Цена1;Цена2;Цена3;Цена4;Цена5;Вес;Артикул;Кaтегория ID;Характеристики\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=str_replace(";","|",trim($row['name']));
	$category=$row['category'];
	$content= str_replace(";","|",$row['content']);
	$description=str_replace(";","|",$row['description']);
	$price=$row['price'];
    $price2=trim($row['price2']);
	$price3=trim($row['price3']);
	$price4=trim($row['price4']);
	$price5=trim($row['price5']);
	$uid=trim($row['uid']);
	$enabled=$row['enabled'];
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
	$vendor_array=base64_encode($row['vendor_array']);
	$num=$row['num'];
	$items=trim($row['items']);
	$weight=trim($row['weight']);
	@$csv.="$id;$name;$description;$pic_small;$content;$pic_big;$price;$price2;$price3;$price4;$price5;$weight;$uid;$category;$vendor_array\n";
	}
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

    case("news_writer"):// Выгрузка базы рассылки
	
	$sql="select * from $table_name9 order by id desc";
$result=mysql_query($sql);
$num=0;
$csv="Адрес\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $mail=$row['mail'];
	$datas=$row['datas'];
	$csv.="$mail\n";
	}
  $file=date("d_m_y").".csv";
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
if(@$IDS){
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
//sleep(1);
//exit("../csv/".$file);
header("Location: ../csv/".$file);
}
}
}else $UserChek->BadUserFormaWindow();

?>