<?
//PHPShop Start
?>
<HTML>
<HEAD><TITLE>Мигратор от ShopScript к PHPShop Start</TITLE></HEAD>
<BODY>
<CENTER>
<H1>Миграция с ShopScript на PHPShop Start</H1>
<FORM METHOD=POST>
Введите адрес БД источника (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srchost]" value="localhost"><BR>
Введите имя пользователя БД источника (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcuser]" value="root"><BR>
Введите пароль БД источника (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpass]" value=""><BR>
Введите имя самой БД источника (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcname]" value="shopscript"><BR>
Введите префикс таблиц БД источника (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpre]" value="SS_"><BR>
Введите относительный путь картинок источника (ShopScript). Корень сервера &laquo;<?echo GetEnv("DOCUMENT_ROOT"); ?>&raquo;. <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpath]" value="/products_pictures/"><BR>

<HR>
Введите адрес БД назначения (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trghost]" value="localhost"><BR>
Введите имя пользователя БД назначения (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trguser]" value="root"><BR>
Введите пароль БД назначения (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgpass]" value=""><BR>
Введите имя самой БД назначения (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgname]" value="www1sanru"><BR>
Введите префикс таблиц БД назначения (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgpre]" value="phpshop_"><BR>

<INPUT TYPE=hidden name="act" value="do"><BR>
<input name="submit" type="submit" value="Отправить &raquo;">
</FORM>
</CENTER>


<?
// Глобалс он
@extract($_GET);
@extract($_POST);
@extract($_FORM);
@extract($_FILES);
$DOCUMENT_ROOT=GetEnv("DOCUMENT_ROOT");

if (isset($act)) {

  echo '<HR>Результаты:<BR>';

//соединение с ИСХОДНОЙ БД
  @mysql_connect($us['srchost'],$us['srcuser'],$us['srcpass']) or die ('<P class=text>Приносим свои извинения, но по техническим причинам сайт на данный момент не доступен.</P>Причина: Невозможно соединиться с сервером базы данных.<BR>Пожалуйста, нажмите по <A href="mailto:'.$devmail.'?Subject=DB_CONNECT_ERROR">этой ссылке</A>, чтобы написать администратору сайта о данной неисправности. Тогда возможно уже сегодня сайт снова начнет функционировать.</CENTER>'.mysql_errno().mysql_error());
  @mysql_select_db ($us['srcname']) or die ('<P class=text>Приносим свои извинения, но по техническим причинам сайт на данный момент не доступен.</P>Причина: Невозможно выбрать базу данных.<BR>Пожалуйста, нажмите по <A href="mailto:'.$devmail.'?Subject=DB_CHOISE_ERROR">этой ссылке</A>, чтобы написать администратору сайта о данной неисправности. Тогда возможно уже сегодня сайт снова начнет функционировать.</CENTER>');
  @mysql_query( 'set names cp1251' );

  $sql='select categoryID, name, parent, description, sort_order, meta_description, meta_keywords from '.$us['srcpre'].'categories';
  $result=mysql_query($sql);
  $sqlcat='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($f['name']=='ROOT') {continue;}
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumcat[$nn]++;
    if (count($f['meta_description'])) {$descrip_enabled=1;} else {$descrip_enabled=0;}
    if (count($f['meta_keywords'])) {$keywords_enabled=1;} else {$keywords_enabled=0;}
    if ($f['parent']==='1') {$f['parent']=0;}
    @$sqlcat[$nn].='(\''.$f['categoryID'].'\',\''.addslashes($f['name']).'\',\''.$f['sort_order'].'\',\''.$f['parent'].'\',\''.addslashes($f['description']).'\',\''.addslashes($f['meta_description']).'\',\''.$descrip_enabled.'\',\''.addslashes($f['meta_keywords']).'\',\''.$keywords_enabled.'\'),';
  }

  $sql='select productID, categoryID, name, description, Price, in_stock, enabled, brief_description, list_price, product_code, sort_order, default_picture, weight, meta_description, meta_keywords from '.$us['srcpre'].'products';
  $result=mysql_query($sql);
  $sqlprod='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumprod[$nn]++;
    if (count($f['meta_description'])) {$descrip_enabled=1;} else {$descrip_enabled=0;}
    if (count($f['meta_keywords'])) {$keywords_enabled=1;} else {$keywords_enabled=0;}
    if ($f['in_stock']) {$in_stock=0;} else {$in_stock=1;}
    @$sqlprod[$nn].='(\''.$f['productID'].'\',\''.$f['categoryID'].'\',\''.addslashes($f['name']).'\',\''.addslashes($f['brief_description']).'\',\''.addslashes($f['description']).'\',\''.$f['Price'].'\',\''.$f['list_price'].'\',\''.$in_stock.'\',\''.$f['enabled'].'\',\''.$f['enabled'].'\',\''.$f['product_code'].'\',\''.$f['sort_order'].'\',\''.addslashes($f['meta_description']).'\',\''.$descrip_enabled.'\',\''.addslashes($f['meta_keywords']).'\',\''.$keywords_enabled.'\',\'\',\'\'),';
  }

  $sql='select productID, filename, thumbnail from '.$us['srcpre'].'product_pictures';
  $result=mysql_query($sql);
  $sqlfoto='';
  $i=0;
  $nn=0;
  $lim=-1;

  
  while ($f=mysql_fetch_array($result)) {
    $pic_s=$us['srcpath'].$f['thumbnail'];
    $pic_b=$us['srcpath'].$f['filename'];
    $n=$f['productID'];
    $myRName=substr(abs(crc32(uniqid($f['productID']))),0,5);
    if(file_exists($DOCUMENT_ROOT.$pic_s) and file_exists($DOCUMENT_ROOT.$pic_b)){
      if ($i>$lim) {$nn++; $i=0;} else {$i++;}
      @$sumfoto[$nn]++;

// Большая
      $pathinfo=pathinfo($pic_b);
      $path=$pathinfo['dirname'].'/';
      $pic_b_ext = $pathinfo['extension'];
      $pic_b_name_new = "img".$n."_".$myRName.".".$pic_b_ext;
      $pic_b_name_old=$pathinfo['basename'];
      $pic_b_new=str_replace($pic_b_name_old,$pic_b_name_new,$pic_b);
      $oldWD = getcwd();
      $dirWhereRenameeIs=$DOCUMENT_ROOT.$pathinfo['dirname'];
      $oldFilename=$pathinfo['basename'];
      $newFilename=$pic_b_name_new;
      chdir($dirWhereRenameeIs);
      rename($oldFilename, $newFilename);
      chdir($oldWD); 

// Маленькая
      $pathinfo=pathinfo($pic_s);
      $pic_s_ext = $pathinfo['extension'];
      $pic_s_name_new = "img".$n."_".$myRName."s.".$pic_s_ext;
      $pic_s_name_old=$pathinfo['basename'];
      $pic_s_new=str_replace($pic_s_name_old,$pic_s_name_new,$pic_s);
      $oldFilename=$pathinfo['basename'];
      $newFilename=$pic_s_name_new;
      chdir($dirWhereRenameeIs);
      rename($oldFilename, $newFilename);
      chdir($oldWD); 
//id parent name
      $name=$pic_b_new;
      @$sqlfoto[$nn].='(\''.$f['photoID'].'\',\''.$f['productID'].'\',\''.$name.'\',\'0\'),';
      @$sqlfotoold[$nn].='SET pic_small=\''.$path.$pic_s_name_new.'\', pic_big=\''.$pic_b_new.'\'  WHERE (id=\''.$f['productID'].'\')';

    }

  }

  $sql='select aux_page_ID, aux_page_name, aux_page_text, meta_keywords, meta_description from '.$us['srcpre'].'aux_pages';
  $result=mysql_query($sql);
  $sqlpages='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumpages[$nn]++;
    @$sqlpages[$nn].='(\''.$f['aux_page_ID'].'\',\''.$f['aux_page_name'].'\',\'page'.$i.'\',\'1000\',\''.$f['meta_keywords'].'\',\''.$f['aux_page_text'].'\',\''.$f['aux_page_text'].'\',\'1\'),';
  }

  $sql='select NID,add_date,title,picture,textToPublication from '.$us['srcpre'].'news_table';
  $result=mysql_query($sql);
  $sqlnews='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumnews[$nn]++;
    $date=substr(".","-",$f['add_date']);
    @$sqlnews[$nn].='(\''.$f['NID'].'\',\''.$date.'\',\''.$f['title'].'\',\''.$f['textToPublication'].'\'),';
  }



//соединение с  БД НАЗНАЧЕНИЯ
  @mysql_connect($us['trghost'],$us['trguser'],$us['trgpass']) or die ('<P class=text>Приносим свои извинения, но по техническим причинам сайт на данный момент не доступен.</P>Причина: Невозможно соединиться с сервером базы данных.<BR>Пожалуйста, нажмите по <A href="mailto:'.$devmail.'?Subject=DB_CONNECT_ERROR">этой ссылке</A>, чтобы написать администратору сайта о данной неисправности. Тогда возможно уже сегодня сайт снова начнет функционировать.</CENTER>'.mysql_errno().mysql_error());
  @mysql_select_db ($us['trgname']) or die ('<P class=text>Приносим свои извинения, но по техническим причинам сайт на данный момент не доступен.</P>Причина: Невозможно выбрать базу данных.<BR>Пожалуйста, нажмите по <A href="mailto:'.$devmail.'?Subject=DB_CHOISE_ERROR">этой ссылке</A>, чтобы написать администратору сайта о данной неисправности. Тогда возможно уже сегодня сайт снова начнет функционировать.</CENTER>');
  @mysql_query( 'set names cp1251' );


//Чистим базу
$query='TRUNCATE `'.$us['trgpre'].'categories`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'products`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'page`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'news`;';
$res = mysql_query($query);


$packsum=count($sqlfoto)+count($sqlprod)+count($sqlcat);

  echo 'Сформировано: '.$packsum.' упаковок<BR>';

//Вввод категорий
foreach ($sqlcat as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'categories` (id, name, num, parent_to, content, descrip, descrip_enabled, keywords, keywords_enabled) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo 'Упаковка (КАТЕГОРИИ) №'.$nn.' вернула: "'.$suc.'". В ней '.$sumcat[$nn].' записей.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//Вввод товаров
foreach ($sqlprod as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'products` (id, category, name, description, content, price, price_n, sklad, p_enabled, enabled, uid, num, descrip, descrip_enabled, keywords, keywords_enabled, pic_small, pic_big) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo 'Упаковка (ТОВАРЫ) №'.$nn.' вернула: "'.$suc.'". В ней '.$sumprod[$nn].' записей.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//Вввод фоток
foreach ($sqlfotoold as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='UPDATE `'.$us['trgpre'].'products` '.$sql.');';
  $suc=mysql_query($sql);
  echo 'Упаковка (ФОТО) №'.$nn.' вернула: "'.$suc.'". В ней '.$sumfoto[$nn].' записей.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//Вввод страниц
foreach ($sqlpages as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'page` (id,name, link, category, keywords, description, content, enabled) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo 'Упаковка (СТРАНИЦЫ) №'.$nn.' вернула: "'.$suc.'". В ней '.$sumpages[$nn].' записей.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//Вввод новости
foreach ($sqlnews as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'news` (id,datas,zag,kratko) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo 'Упаковка (НОВОСТИ) №'.$nn.' вернула: "'.$suc.'". В ней '.$sumnews[$nn].' записей.<BR>';
  if (!$suc) {
    echo $sql;
  }
}


//SRC TABLES
//SS_categories 
//cells: categoryID name parent description sort_order meta_description meta_keywords 
//SS_products 
//cells:  productID categoryID name description Price in_stock enabled brief_description list_price product_code sort_order default_picture weight meta_description meta_keywords
//SS_product_pictures
//cells: photoID, productID, filename, thumbnail
//SS_aux_pages 
//cells:aux_page_ID aux_page_name aux_page_text meta_keywords meta_description 
//SS_news_table 
//cells:NID  add_date  title  picture  textToPublication
//21.03.2008

//TRG TABLES
//phpshop_categories 
//cells: id name num parent_to content descrip descrip_enabled keywords keywords_enabled
//phpshop_products 
//cells: id category name description content price price_n sklad p_enabled enabled uid num descrip descrip_enabled keywords keywords_enabled pic_small pic_big weight
//phpshop_foto 
//cells: id parent name
//phpshop_page 
//cells: id name link category keywords description content enabled
//phpshop_news 
//cells:id  datas  zag  kratko  podrob  
//21-03-2008
 
}


?>


</BODY>
</HTML>
