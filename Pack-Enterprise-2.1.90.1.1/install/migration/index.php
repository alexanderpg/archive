<?
$dir=GetEnv("DOCUMENT_ROOT").'/install/migration/';


$a=glob($dir.'*.php');            //Получение массива с именами фалов и каталогов
//uasort($a,"cmp");           // Сортируем этот массив


echo '<HEAD><TITLE>Панель управления базой</TITLE></HEAD><BODY>';

$ii=0;
foreach ($a as $aa=>$bb) {
  if (!(is_dir($bb))) { //Если катлог
    $ii++;
    $file1=$dir.basename($bb);
    $f1 = fopen($file1, "r+t");    // открываем файл счетчика
    $black = fread($f1, filesize($file1));     // читаем значение, сохраненное в файле
    fclose($f1);                  // закрываем файл
    $black=explode("\n",$black);

    if (basename($bb)!=="index.php") {
      echo $ii.'. <A href="/install/migration/'.basename($bb).'">'.basename($bb).'</A> - '.$black[1].'<BR>';
    }
  }
}

echo '</BODY>';

?>