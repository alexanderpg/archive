<?
error_reporting(0);

// Парсируем установочный файл
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);

// Выбор файла
function GetFile(){
$dir="./";
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "sql")
		  return $file;
        }
        closedir($dh);
    }
return "base.sql";
}


// Глобалсы
if(ini_get('register_globals') == 1) $register_globals="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $register_globals="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// Апач
if(eregi('Apache', $_SERVER['SERVER_SOFTWARE'])) $API="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $API="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// Версия PHP
$phpversion=substr(phpversion(),0,1);
if($phpversion >= 4) $php="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $php="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";



// Версия MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
@mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");

if(@mysql_get_server_info()){
$mysqlversion=substr(@mysql_get_server_info(),0,1);
if($mysqlversion >= 4) $mysql="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $mysql="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
}else $mysql="...............?";

// Rewrite
$path_parts = pathinfo($PHP_SELF);
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/test.html";
if (@fopen($filename,"r")) $rewrite="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $rewrite="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// Версия Zend
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/rewritemodtest.php";
$html = implode('', file ($filename));
if (eregi('Zend Optimizer', $html)) $zend="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
   else $zend="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//GD Support
$GD=gd_info();
if($GD['GD Version']!="")
 $gd_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
 
//FreeType Support
if($GD['FreeType Support'] === true)
 $gd_freetype_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_freetype_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//FreeType Linkage
if($GD['FreeType Linkage'] == "with freetype")
 $gd_freetype_linkage="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_freetype_linkage="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?= $SysValue['license']['product_name']?> - > Установка</title>
<META http-equiv=Content-Type content="text-html; charset=windows-1251">
<style>
.ok{
color: green;
font-weight: bold;
}
.error{
color: red;
font-weight: bold;
}
BODY, li, a {
	FONT-SIZE: 12px;
	COLOR: #000000;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}
pre.{
	COLOR: #000000;
}
td.{
	COLOR: #000000;
	FONT-SIZE: 12px;
}
a{
	COLOR: #0066cc;
}
a:hover{
	COLOR: CC6600;
}
textarea{
	border-style: dashed;
	border-color: Gray;
	border-width: 1px;
 }
li.red{
 color: red;
}
</style>
<script>
function miniWin(url,w,h)
{
window.open(url,"_blank","left=300,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
}
</script>
</head>
<body>
<h1>Установка <?= $SysValue['license']['product_name']?></h1>
<table width="100%">
<tr>
    <td width="150" bgcolor="D4E3F7" valign="top" style="padding:10">
	<b style="color:#1054AF">Оглавление</b><br><br>
<a href="#id1">Требования</a><br>
<a href="#id2">Установка Denwer</a><br>
<a href="#id3">Установка</a><br>
<a href="#id11">Обновление</a><br>
<a href="#id4">Лицензия</a><br>
<a href="#error">Коды ошибок</a><br>
<a href="#id5">Шаблонизатор</a><br>
<a href="#id7">Переменные</a><br>
<a href="#id8">API подключение внешнего модуля</a><br>
<a href="#id12">Файл .htaccess</a><br>
<a href="#id9">Благодарности</a><br>

	</td>
	<td width="10"></td>
	<td bgcolor="ffffff">
<p>
<a name="id1"></a>
<h4>1. Тест системных требований</h4>
<ol>
<li> Apache => 1.3.*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$API?>
<li> MySQL => 4.* <?=$mysql?>
<li> PHP => 4.* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$php?>
<li> ZendOptimizer => 2.1.5.3 &nbsp;&nbsp;&nbsp;&nbsp;<?=$zend?>
<li> RewriteEngine ON для Apache&nbsp;&nbsp;&nbsp;<?=$rewrite?>
<li> Register Globals ON для PHP &nbsp;&nbsp;&nbsp;<?=$register_globals?>
<li>GD Support для PHP <?=$gd_support?>
<li>FreeType Support для PHP <?=$gd_freetype_support?>
<li>FreeType Linkage для PHP <?=$gd_freetype_linkage?>
</p>
Расшифровка: <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle> <b class='ok'>Ok</b> - тест пройден, 
<img src="rewritemodtest/errormessage.gif"  border=0 align=absmiddle> <b class='error'>Error</b> - тест не пройден (возможны проблемы при работе скрипта, обратитесь к документации сервера или свяжитесь с администратором сервера)<br>
<img src="rewritemodtest/php.png" border=0 align=absmiddle> <a href="rewritemodtest/rewritemodtest.php" target="_blank">Показать информацию о PHP</a>
</ol>

<p>
<a name="id2"></a>
<h4>2. Установки на локальный сервер Denwer (только для Windows)</h4> 
<ol>
<li>Установить <a href="http://www.phpshop.ru/loads/ThLHDegJUj/Denwer.exe" target="_blank">
Denwer 
</a>- набор дистрибутивов, используемый Web-разработчиками (программистами и дизайнерами) для отладки сайтов на «домашней» (локальной) Windows-машине без необходимости выхода в Интернет.
<li>Установить <a href="http://www.phpshop.ru/loads/ThLHDegJUj/ZendOptimizer-2.6.2-Windows-i386.exe" target="_blank">ZendOptimizer</a> в тот же каталог, где размещается Denwer (<a href="http://www.phpshop.ru/gbook/ID_70.html" target="_blank">возможные проблемы</a>)
<li>Установить PHPShop в любую директорию на сервере, например в demo.ru. (в некоторых случая нужна дополнительная директория demo.ru/www/)
<li>Запустить web-сервер, воспользовавшись ярлыком "Run Server" в меню "Программы" 
</ol>
</p>
<p>
<a name="id3"></a>
<h4>3. Установка для всех серверов</h4>
<ol>
<li>Создайте новую базу MySQL на своем сервере.
<li>

Отредактируйте файл связи с базой MySQL "config.ini", лежащий в папке "ваш_сайт/phpshop/inc/config.ini".
<pre>
[connect]
host="localhost";             # имя вашего хоста
user_db="Enterprise";         # имя вашего пользователя
pass_db="dennion";            # пароль вашей базы
dbase="Enterprise";           # имя вашей базы
</pre>
</li>
<li>
<a name="id3_2"></a>
Воспользуйтесь встроенным <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('install.php',550,570)">инсталлятором</a> для установки базы.<br><br>
</li>
<li>Установите опцию CMOD 777 (UNIX сервера) для папок (в ftp-менеджере выбрать нужную папку, нажать правой клавишей мышки, выбрать опцию доступ/права/CMOD/ и выставить значение 777):
<br><br>
<ol >
<li class=red>license (для генерации временной лицензии Trial)
<li class=red>UserFiles/Image
<li class=red>files/price
<li class=red>phpshop/admpanel/csv
<li class=red>phpshop/admpanel/dumper/backup
</ol>
<br><br>
<li>Для входа в <a href="../phpshop/admpanel/">административную панель</a> нажмите клавишу  <strong>F12</strong>.<br> 
При установке пользователь и пароль задается в ручном режиме. По желанию, регистрационные данные отсылаются на e-mail. После смены пароля требуется перезапуск браузера.
<br><br>
</ol>
<a name="id11"></a>
<h4>4. Обновление</h4>
Обновление выполняется по инструкции:
<br><br>
<ol >
<li>Создайте копию текущей базы данных через утилиту "Резервные копи базы": База -> Резервные копи базы (Backup)
<li>Создаем папку /old/ загружаем туда все файлы из корневой директории www
<li>Загружаем в очищенную директорию www новые файлы из архива новой версии
<li>Из старого файла config.ini берем параметры подключения к базе данных (первые 5 строк) и вставляем в новый конфиг (/phpshop/inc/config.ini)
<li>Запускаем <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('update/install.php',550,550)">апдейтер баз данных</a> (ваш_сайт/install/update/), выбираем текущую версию, если ее там нет, то обновлять базу не нужно. Стираем папку /install/
<li>Из папки /old/ копируем папку /UserFiles со старыми картинками в обновленный скрипт в тоже место
<li>По необходимости копируем старый шаблон /phpshop/templates/, но с учетом что в нем могли быть внесены изменения для новой версии (сравнить с оригиналом)
</ol>
<br><br>
<li>Для миграции (перехода) со скрипта ShopScript запустите <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="./migration/" target="_blank">программу  миграции ShopScript -&gt; PHPShop</a>. Товарная база, страницы, новости будут сохранены для версии PHPShop.

</ol>
</p>
<p>
<a name="id4"></a>
<h4>5. Лицензия</h4>
<ol>
<li> <b>Лицензионное соглашение</b><br><br>
<textarea style="width:100%;height:300">
Настоящее лицензионное соглашение (далее, Соглашение) является договором между Вами и компанией «PHPShop» (далее, Автор). Соглашение относится ко всем коммерчески распространяемым версиям и модификациям программного продукта PHPShop. 

1. Программный продукт PHPShop (далее, Продукт) представляет собой код программы Интернет магазина, воспроизведенный в файлах или на бумаге, включая электронную или распечатанную документацию, а также текст данного Соглашения. 

2. Покупка Продукта свидетельствует о том, что Вы ознакомились с содержанием Соглашения, принимаете его положения, и будете использовать Продукт на условиях данного Соглашения. 

3. Соглашение вступает в законную силу непосредственно в момент покупки Продукта, т.е. получения Вами Продукта посредством электронных средств передачи данных либо на физических носителях, на усмотрение Автора. 

4. Все авторские права на Продукт принадлежат Автору. Продукт в целом или по отдельности является объектом авторского права и подлежит защите согласно российскому и международному законодательству на основании свидетельства о государственной регистрации программы для ЭВМ "PHPShop" № 2006614274. Автор оставляет за собой право требовать размещения обратной ссылки(*) с указанием Авторского права на сайте, где используется Продукт. Использование Продукта с нарушением условий данного Соглашения, является нарушением законов об авторском праве, и будет преследоваться в соответствии с действующим законодательством. Отказ от размещения обратной ссылки с указанием Авторского права является нарушением Соглашения и ограничивает Продукт в предоставлении технической поддержки Автором. 

5. Продукт поставляется на условиях "КАК ЕСТЬ" ("AS IS") без предоставления гарантий производительности, покупательной способности, сохранности данных, а также иных явно выраженных или предполагаемых гарантий. Автор не несет какой-либо ответственности за причинение или возможность причинения вреда Вам, Вашей информации или Вашему бизнесу вследствие использования или невозможности использования Продукта. 

6. Данное Соглашение дает Вам право на использование неограниченного(**) количества копии Продукта на одном web-сервере в пределах 
одного домена(***). Для каждой новой установки Продукта на другой адрес web-сервера должна быть приобретена отдельная Лицензия. Любое распространение Продукта без предварительного согласия Автора, включая некоммерческое, является нарушением данного Соглашения и влечет ответственность согласно действующему законодательству. Допускается возможность создания и использования Вами дополнительной копии Продукта исключительно в целях тестирования или внесения изменений в исходный код, при условии, что такая копия не будет доступна третьим лицам. 

7. Вы вправе вносить любые изменения в исходный код Продукта по Вашему усмотрению. При этом последующее использование Продукта должно осуществляться в соответствии с данным Соглашением и при условии сохранения всех авторских прав. Автор не несет ответственности за работоспособность Продукта в случае внесения Вами каких бы то ни было изменений. 

8. Автор не несет ответственность, связанную с привлечением Вас к административной или уголовной ответственности за использование Продукта в противозаконных целях (включая, но не ограничиваясь, продажей через Интернет магазин объектов, изъятых из оборота или добытых преступным путем, предназначенных для разжигания межрасовой или межнациональной вражды; и т.д.). 

9. Прекращение действия данного Соглашения допускается в случае удаления Вами всех полученных файлов и документации, а так же их копий. Прекращение действия данного Соглашения не обязывает Автора возвратить средства, потраченные Вами на приобретение Продукта. 

Пояснения:

* Вид ссылки и размещение строго задается Автором, код ссылки не поддается изменению. В целях сохранения визуализации с персональным дизайном возможно изменение цвета ссылки (задается лицензией). Для официальных партнеров возможна выписка лицензии без копирайтов Автора. Ссылка в таком случае размещается в согласовании с Автором партнерами в удобном для них месте каждой страницы сайта. Лицензия без копирайтов автора обговаривается отдельно, стоимость такой лицензии назначается персонально.

** Только версии Enterprise и Enterprise Pro поддерживают размещение в некорневые директории. Версии Start и Catalog, Catalog Pro поддерживают размещение только в корневой папке или поддомене. 

*** Имеется в виду размещение в пределах одного домена seamply.ru. Лицензия допускает размещение вида seamply.ru/market1/, seamply.ru/market2/ и т.д.
Размещение типа market1.seamply.ru и т.д. требует покупки отдельной Лицензии. Техническая поддержка распространяется только на одну копию Продукта, приоритетное размещение для технической поддержки в корневую директорию. Для каждого нового экземпляра магазина требуется покупка новой технической поддержки.


</textarea><br><br>
<li> Для <b>Установки лицензии</b> скопируйте файл с лицензией (имя_домена.lic) в папку /license. Скрипт сам найдет лицензию в этой папке. Для смены лицензии замените лицензионный файл в этой папке. В папке должна лежать только одна лицензия!<br><br>
</ol>
</p>
<a name="error"></a>
<p><h4>6. Коды ошибок</h4>
<ol>
<li><b>101 Ошибка подключения к базе</b><br><br>
<ul>
<li>Проверьте настройки подключения к базе данных: <b>host, user_db, pass_db, dbase</b>.
<li>Откройте файл phpshop/inc/config.ini и отредактируйте вышеописанные переменные под вашу базу.<br>
<pre>
[connect]
host="localhost";             # имя хоста
user_db="Enterprise";         # имя пользователя
pass_db="dennion";            # пароль базы
dbase="Enterprise";           # имя базы
</pre>
</ul>
<li><b>102 Не установлены базы</b><br><br>
<ul><li>Запустите <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('install.php',550,550)">инсталятор</a> для установки БД.
</ul><br>
<li><b>103 Ошибка расположения папки с файлами</b><br><br>
<ul><li>Проверьте настройки в установочном файле <strong>dafault_page_dir</strong>.
</ul><br>
<li><b>104 Ошибка расположения папки с шаблонами дизайна (скины)</b><br><br>
<ul>
<li>Не включена опция Register Globals ON 
<li>Проверьте существования папки с выбранным шаблоном: <strong>phpshop/templates/имя_шаблона</strong>.
<li>Через <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="../phpshop/admpanel/" target="_blank">панель администрирования</a> (<b>опция "Система"</b>) выберете существующий шаблон.
<li>Имя шаблона должно совпадать с именем папки (см. выше)
</ul><br>
<li><b>105 Ошибка существования файла install.php</b><br><br>
<ul>
<li>В целях безопасности удалите папку <b>/install</b>
<li>Для отключения этой проверки измените значение переменной check_install="false"; в установочном файле config.ini (см. выше) (не рекомендуется)
</ul>
</ol>
<a name="id5"></a>
<p><h4>7. Шаблонизатор</h4>
Папка с шаблонами расположена по адресу: <strong>phpshop/templates/имя_шаблона/</strong><br>
Имя текущего шаблона можно узнать по нажатию клавиши F9 клавиатуры или в разделе смены шаблонов административной части. Файлы выполнены на языке HTML. В файлах шаблонов действует логика: @перемнная@ заменяется на результат вывода функции и подставляется в файл. Список основных перемнных расположен <a href="#id7">ниже</a>.
<pre style="padding:10">
main/index.tpl - Первая страница <strong>(основная правка)</strong>
main/shop.tpl -  Все остальные страницы <strong>(основная правка)</strong>
main/left_menu.tpl -  Шаблон левого текстового блока    
main/right_menu.tpl -  Шаблон правого текстового блока
<br><br>
product/main_product_forma.tpl - Шаблон форма продукта
product/product_page_list.tpl -  Шаблон страницы краткого описания продуктов 
product/product_page_full.tpl -  Шаблон подробного описания продуктов
product/main_product_forma_full.tpl - Шаблон форма продукта подробно
product/product_page_full.tpl -  Шаблон подробного вывода страницы продукта
product/main_spec_forma.tpl -  Шаблон форма спецпредложения на главной странице
product/main_spec_forma_icon.tpl - Шаблон форма спецпредложения товаров списком (кратко)
product/main_odnotip_forma_icon.tpl -  Шаблон форма однотипных товаров
product/main_product_odnotip_list.tpl - Шаблон для однотипных товаров
<br><br>
serach/search_page_list.tpl -  Шаблон список поиска продуктов
search/main_search_forma_2.tpl -  Шаблон форма вывода товаров в поиске
<br><br>
news/news_page_list.tpl -  Шаблон страница новостей кратко
news/news_page_full.tpl - Шаблон страница новотсей подробно
news/main_news_forma.tpl -  Шаблон формы новостей кратко
news/main_news_forma_full.tpl - Шаблон формы новостей подробно
<br><br>
gbook/gbook_page_list.tpl - Шаблон списка отзывов     
gbook/main_gbook_forma.tpl - Шаблон формы отзывов  
gbook/gbook_forma_otsiv.tpl - Шаблон форма заполнения отзыва   
<br><br>
map/map_page_list.tpl -  Шаблон список карты сайта
<br><br>
links/links_page_list.tpl -  Шаблон список ссылок
links/main_links_forma.tpl -  Шаблон формы ссылки
<br><br>
page/page_page_list.tpl -  Шаблон формы вывода страниц
<br><br>
order/main_order_forma.tpl - Шаблон формы для оформления покупки
order/main_order_list.tpl - Шаблон списка для оформления покупки (страница)
<br><br>
price/main_price_forma.tpl -  Шаблон форма прайса
price/price_page_list.tpl -  Шаблон страницы прайса  
price/main_price_forma_tip.tpl - Шаблон форма прайса заглавие
<br><br>
error/error_page_forma.tpl -  Форма 404 ошибки
<br><br>
order/order_forma_mesage.tpl - Шаблон формы сообщения для заказа
order/order_forma_mesage_main.tpl -  Шаблон формы сообщения для заказа
<br><br>
news/news_main_mini.tpl -  Шаблон последние новости кратко
<br><br>
banner/baner_list_forma.tpl -  Шаблон банерной сети
<br><br>
catalog/catalog_forma.tpl -  Шаблон каталога
catalog/podcatalog_forma.tpl -  Шаблон подкаталога
</pre>
<a name="id7"></a>
<p><h4>8. Переменные шаблонизатора</h4>
Папка с шаблонами расположена по адресу: phpshop/templates/имя_шаблона/
<ol>
<li><b>Главная и остальные страницы (имя_шаблона/main)</b><br><br>

<ul>
<li>@pageTitl@ - титл страницы
<li>@pageDesc@ - описание страницы
<li>@pageKeyw@ - ключевые слова
<li>@pageMeta@ - мета страницы
<li>@pageReg@ - копирайт
<li>@pageProduct@ - версия софта
<li>@pageDomen@ - копирайт на домен
<li>@pageCss@ - путь к стилям шаблона
<li>@leftCatal@ - вывод меню левой навигации
<li>@leftMenu@ - вывод блока левой текстовой информации
<li>@rightMenu@ - вывод блока правой текстовой информации
<li>@mainContentTitle@ - заголовок текстовой области на главную страницу
<li>@mainContent@ - содержимое текстовой области на главной странице 
<li>@DispShop@ - вывод соответсвующих страниц (контента новостей, страниц, отзывов.)
<li>@miniNews@ - вывод последних новостей
<li>@banersDisp@ - вывод банерной сети
<li>@pageReg@ - копирайт
<li>@usersDisp@ - вывод формы аторизации
<li>@name@ - вывод имени сайта
<li>@descrip@ - вывод описания сайта
<li>@serverName@ - вывод имени сервера
<li>@num@ - вывод кол-во товаров в корзине
<li>@sum@ - вывод суммы заказа
<li>@productValutaName@ -  вывод имени валюты в корзине
<li>@valutaDisp@ - вывод имени валюты для смены
<li>@topMenu@ - главное навигационное меню
<li>@specMain@ - вывод спецпредложений
<li>@pageCatal@ - вывод каталога статей (страниц)
<li>@oprosDisp@ - вывод опросов
<li>@skinSelect@ - выбор смены дизайна
<li>@specMainIcon@ - вывод новинок каталога в колонку
<li>@telNum@ - имя телефона компании
<li>@leftMenuName@ - заглавие текстового блока
<li>@leftMenuContent@ - содержание текстового блока
<li>@topMenuLink@ - ссылка на страницу главного меню
<li>@topMenuName@ - имя страницы главного меню 
<li>@calendar@ - вывод календаря новостей
</ul><br>
<li><b>Страницы (имя_шаблона/page)</b><br><br>
<ul>
<li>@pageTitle@ - заглавие страницы
<li>@pageContent@ - контент страницы
<li>@pageNav@ - вывод навигации по страницам, появляется если вставить в тело тег "HR"
<li>@pageName@ - имя страницы
<li>@catName@ - имя каталога статей
<li>@podcatalogName@ - имя подкаталога статей
</ul><br>
<li><b>Каталог (имя_шаблона/catalog)</b><br><br>
<ul>
<li>@catalogName@ - заглавие каталога
<li>@catalogPodcatalog@ - заглавие сраниц, ссылающяяся на этот каталог
<li>@catalogUid@ - ID каталога
<li>@catalogd@ - ID каталога
<li>@catalogCat@ - имя родителя каталога
<li>@parentName@ - имя родителя каталога
<li>@catalogList@ - вывод списка подкаталогов
<li>@podcatalogName@ - имя подкаталога
<li>@podcatalogContent@ - описание подкатлога
<li>@thisCatSort@ - вывод фильтров каталога
</ul><br>
<li><b>Товары (имя_шаблона/product)</b><br><br>
<ul>
<li>@productSale@ - Язык: в корзину
<li>@productInfo@ - Язык: подробно
<li>@productName@ - наименование товара
<li>@productArt@ - артикул товара
<li>@productDes@ - описание товара
<li>@productPrice@ - стоимость товара в валюте
<li>@productPriceRub@ - старая стоимость товара
<li>@productId@ - идентификатор подкаталога товара
<li>@productCat@ (@productCatnav@) - идентификатор каталога для товара
<li>@productPageThis@ - текущяя страница
<li>@productUid@ - идентификатор товара
<li>@catalog@ - Язык: каталог
<li>@vendorDisp@ - классификатор товара
<li>@catalogCat@ - имя каталога
<li>@catalogCategory@ - имя подкаталога
<li>@producFound@ - Язык: найдено товаров
<li>@productPodcat@ - идентификатор подкаталога
<li>@productNum@ - кол-во товаров в подкаталоге
<li>@productNumOnPage@ - Язык: товаров на странице
<li>@productNumRow@ - заданное кол-во товаров на сранице
<li>@productPage@ - Язык: на странице
<li>@productPageNav@ - навигация (HTML)
<li>@productPageDis@ - список выводимых товаров (HTML)
<li>@productImg@ - парсированая картинка
<li>@productOdnotipList@ - однотипные товары (HTML)
<li>@productOdnotip@ - Язык: товары для совместной продажи
<li>@vendorDispTitle@ - строка вывода справки к фильтрам
<li>@vendorDisp@ - вывод фильтров
<li>@vendorSelectDisp@ - вывод фильтров
<li>@productFotoList@ - вывод галереи изображений к товару
<li>@ComStart@ - начало комментариев
<li>@ComEnd@ - конец комментариев
<li>@productValutaName@ - вывод текущей валюты
<li>@productSklad@ - вывод кол-ва на складе
<li>@productNotice@ - Язык: уведомить
<li>@productParentList@ - вывод формы прайса подчиненных товаров
<li>@pagetemaDisp@ - вывод тематических статей
<li>@optionsDisp@ - вывод добавочных опции для товара в корзину
<li>@productFiles@ - вывод прикрепленных файлов товара
<li>@ratingfull@ - вывод рейтинга товара
</ul><br>
<li><b>Банерная сеть(имя_шаблона/baner)</b><br><br>
<ul>
<li>@banerContent@ - контент банера
</ul><br>
<li><b>Отзывы (имя_шаблона/gbook)</b><br><br>
<ul>
<li>@producFound@ - Язык: найдено позиций
<li>@productNum@ - кол-во позиций
<li>@productNumOnPage@ - Язык: кол-во на странице
<li>@productNumRow@ - кол-во на странице
<li>@productPage@ - Язык: текущяя страница
<li>@productPageThis@ - текущяя страница
<li>@productPageNav@ - вывод навигации
<li>@productPageDis@ - вывод контента
<li>@gbookData@ - дата отзыва
<li>@gbookMail@ - почта автора
<li>@gbookTema@ - тема сообщения
<li>@gbookOtsiv@ - отзыв
<li>@gbookOtvet@ - ответ администрации
</ul><br>
<li><b>Партнеры (ссылки) (имя_шаблона/links)</b><br><br>
<ul>
<li>@producFound@ - Язык: найдено позиций
<li>@productNum@ - кол-во позиций
<li>@productNumOnPage@ - Язык: кол-во на странице
<li>@productNumRow@ - кол-во на странице
<li>@productPage@ - Язык: текущяя страница
<li>@productPageThis@ - текущяя страница
<li>@productPageNav@ - вывод навигации
<li>@productPageDis@ - вывод контента
<li>@linksImage - кнопка ссылки
<li>@linksName@ - название ссылки
<li>@linksOpis@ - контент ссылки
</ul><br>
<li><b>Новости (имя_шаблона/news)</b><br><br>
<ul>
<li>@producFound@ - Язык: найдено позиций
<li>@productNum@ - кол-во позиций
<li>@productNumOnPage@ - Язык: кол-во на странице
<li>@productNumRow@ - кол-во на странице
<li>@productPage@ - Язык: текущяя страница
<li>@productPageThis@ - текущяя страница
<li>@productPageNav@ - вывод навигации
<li>@productPageDis@ - вывод контента
<li>@newsData@ - дата публикации
<li>@newsZag@ - заглавие новости
<li>@newsKratko@ - краткий контент новости
<li>@newsAll@ - ссылка на подробности
<li>@newsPodrob@ - подробный контент новости
<li>@mesageText@ - сообщение для подписки
</ul><br>
<li><b>Поиск (имя_шаблона/search)</b><br><br>
<ul>
<li>@productNum@ - найдено позиций
<li>@productSite@ - название сайта
<li>@productName@ - заглавие найденной страницы
<li>@productDes@ - краткое описание страницы
<li>@searchPageSort@ - вывод сортировки категорий
</ol>
<a name="id8"></a>
<p><h4>9. API подключение внешнего модуля</h4>
Для автоматического включения внешнего модуля служит опция [autoload] установочного файла ( далее конфигуратора config.ini)<br><br>
Пример подключения внешнего модуля обмена ссылками <b>Linkexchanger 0.7</b>:
<ol>
<li>Задаем имя и путь нового модуля:
<pre>
[autoload]
linkexchanger="phpshop/modules/linkexchanger";
</pre>

<li>Создаем файл pages/имя_модуля.php. Имя файла должно точно совпадать с его будущей ссылкой (?nav=имя_модуля). Записываем код в наш файл:
<pre>
// Определяем переменые
$SysValue['other']['DispShop']=Linkexchanger(); 
// подключение вашей функции, которая находится по указанному адресу "phpshop/modules/linkexchanger"
// все данные функции должны возвращяться методом <b>return $var</b>;
// вывод функции перехватывает переменная $SysValue['other']['DispShop']
// и выводит их в заданном месте по запросу @DispShop@

// Подключаем шаблон 
@ParseTemplate($SysValue['templates']['shop']);

</pre>
</ul>
</ol>
<strong>Полезные статьи по PHPShop:</strong><br>
<ol>
<li><a href="http://www.phpshop.ru/gbook/" target="_blank">Частые вопросы по PHPShop</a>
<li><a href="http://www.phpshopcms.ru/page/page16.html" target="_blank">Подключение PHP логики</a>
<li><a href="http://www.phpshopcms.ru/page/page15.html" target="_blank">Подключение HTML файлов</a>
<li><a href="http://www.phpshopcms.ru/page/sape.html" target="_blank">Подключение SAPE логики </a>
<li><a href="http://help.phpshop.ru" target="_blank">База знаний PHPShop (требуется регистрация)</a>
</ol>

</p>
<a name="id12"></a>
<p><h4>10. Файл .htaccess</h4>
Файл .htaccess содержит закомментированные команды:
<pre>
#Action php-script /cgi-bin/php
#AddHandler php-script .php
#php_flag register_globals on
#php_flag display_errors on
#php_flag log_errors on
#php_flag error_reporting 0
#php_value memory_limit 100M
#php_flag memory_limit 100M
#php_flag session.use_trans_sid off
</pre>
Для активации уберите знак #(решетка) перед командой. 
Описание команд:
<ol>
<li>
Action php-script /cgi-bin/php<br>
AddHandler php-script .php - если используется CGI сборка PHP для включения Zend Optimizer (<a href="http://masterhost.ru" target="_blank">Masterhost</a> и др.)
<li>php_flag register_globals on - включение опции Globals ON
<li>php_flag display_errors on - включение режима показа ошибок (опционально)
<li>php_flag log_errors on - включение режима ведения лога ошибок (опционально)
<li>php_flag error_reporting 0 - режим скрытия ошибок
<li>php_value memory_limit 100M <br>
php_flag memory_limit 100M - выделение  100М памяти под выполнение скриптов (опционально)
<li>php_flag session.use_trans_sid off - отключения вывода "хвоста" в ссылках<br> (?PHPSESSID=6cg365fg56565bv65v5365)

</ol></p>
<a name="id9"></a>
<p><h4>11. Благодарности</h4>
<ol>
<li><b>Дмитрию Котерову</b> за его проект <a href="http://www.denwer.ru">Denwer.ru</a>, и написанные им книги и статьи по PHP.<br>
<li><b>МаЗаю</b> за помощь в разработке проекта.
<li><b>Прохорову Игорю</b> за помощь в разработке проекта.
<li><b>Бабаджанову Эрику</b> за помощь в разработке проекта.
</ol></p>
<div align="right">
<a href="#id1">На верх</a>
</div>
</td>
</tr>
</table>
</body>
</html>
