<?php
// Подключаем библиотеку поддержки.
require_once "../../lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// Получаем запрос.
$q = @$_REQUEST['q'];
$xid = @$_REQUEST['xid'];
$p = @$_REQUEST['page'];
$var1 = @$_REQUEST['var1'];
$var2 = @$_REQUEST['var2'];
$var3 = @$_REQUEST['var3'];
$var4 = @$_REQUEST['var4'];
$xid = @$_REQUEST['tit'];


require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");


// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");

// Создаем интерфейс

switch($p){

      // Комментарии
      case("comment"):
	  require("../comment/admin_comment.php");
	   $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	 else {$interface.= @$var2;}
	$interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button name="btnLang" value=Показать class=but3 onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
    <td>	
	<input type=text name="words" id="words" size=30 class=s onMouseMove="show(\'[ '.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][5].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=Поиск class=but3 name="btnLang"  onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'words\').value)"></td>
<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>С отмеченными</option>
			<option value="41" id=txtLang>Удалить из базы</option>
   </select>
   </td>
	<td width="10"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["gbook"],0) == 1) $interface.=Comment($var1,$var2,$var3);
	  else  $interface = $UserChek->BadUserForma();
	  break;


      // Уведомления
	  case("shopusers_notice"):
      require("../shopusers/admin_notice.php");
	   $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	else $interface.=@$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
		<input type=button name="btnLang" value=Показать class=but3 onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=20 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][6].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=Поиск class=but3 id=btnSearch  onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="actionSelect" size="1" onchange="DoWithSelect(this.value,form_flag,form_flag.length)">
			<option SELECTED id=txtLang value="0" >С отмеченными</option>
			<option value="25" id=txtLang>Разослать уведомления</option>
			<option value="26" id=txtLang>Удалить из базы</option>
   </select>
   </td>
   <td width="10"></td>
   <td>
		<input type=button name="btnLang" value="Автоматическое уведомление" class=but3 onclick="miniWin(\'./window/adm_window.php?do=29\',300,300)">
	</td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=ShopUsersNotice($var1,$var2,$var3);
	  else $interface=$UserChek->BadUserForma();
	  break;

       
	  // Электронные платежи
	  case("order_payment"):
	  	 $interface='
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;" height="10">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.= date("d-m-Y");
	else $interface.= @$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button id=btnShow value="Показать" class=but3 onclick="DoReload(\'order_payment\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=25 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_4'].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=Поиск class=but3 id=btnSearch  onclick="DoReload(\'order_payment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
      require("../payment/admin_payment.php");
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=OrderPayment($var1,$var2,$var3);
	  else $interface=$UserChek->BadUserForma();
	  break;
	   
	  // Статусы заказов
	  case("order_status"):
      require("../order/admin_status.php");
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=OrderStatus($var1,$var2,$var3,$var4);
	  else $interface=$UserChek->BadUserForma();
	  break;
	   
	  // Рассылка
	  case("news_writer"):
      require("../mail/admin_news_writer.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= News_writer();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // Сервера
	  case("servers"):
      require("../servers/admin_servers.php");
	  if(CheckedRules($UserStatus["servers"],0) == 1) $interface= Servers();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // Доставка
	  case("delivery"):
      require("../delivery/admin_delivery.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= Delivery();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // Валюты
	  case("valuta"):
      require("../system/adm_system_valuta.php");
	  if(CheckedRules($UserStatus["valuta"],0) == 1) $interface= Valuta();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // Скидки
	  case("discount"):
      require("../discount/admin_discount.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= Discount();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // Загрузка базы
	  case("csv1c"):
	  if(CheckedRules($UserStatus["sql"],1) == 1){
	  @$interface.='
	  <TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4>Мастер загрузки товарной базы 1С:Предприятие</h4></div>
<FIELDSET>

<FORM name=csv_upload action="" method=post encType=multipart/form-data>
<table cellpadding="10" align="center">
<tr>
	<td>
	Выберите файл с расширением *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase1C(this.form.csv_file,\'predload\')" type=button value=OK><br>
<INPUT class=but type=reset value=Сброс> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>
<tr>
   <td colspan="2">
     <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>Д</u>анные, отмеченные флажками будут изменены/добавлены</LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_1" checked> Наименование&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_2" checked> Краткое описание&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_3" checked> Маленькая картинка&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_4" checked> Подробное описание&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_5" checked> Большая картинка&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_6" checked> Цена1&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_7" checked> Цена2&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_8" checked> Цена3&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_9" checked> Цена4&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_10" checked> Цена5&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_11" checked> Склад&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_12" checked> Вес&nbsp;&nbsp;
</div>
</div>
</FIELDSET>
   </td>
</tr> 
</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="100%" ><h4>Ход операции</h4>
<ol>
    <li><strong>Шаг 1</strong> - в программе 1С:Предприятие в меню "Файл" выбрать опцию "<a href="#" onclick="confirm(\'ПО для выгрузки номенклатуры из 1С:Предприятие\nспрашивайте у администратора сервера.\')">Выгрузка для Интернет-магазина</a>"
    <li><strong>Шаг 2</strong> - выгрузить товарную базу клавишей "Выгрузить"
	<li><strong>Шаг 3</strong> - выбрать заранее выгруженный файл базы с расширением *.csv
	<li><strong>Шаг 4</strong> - принять изменения в распечатанном файле
	<li><strong>Шаг 5</strong> - дождаться выполнения операции
	<li><strong>Шаг 6</strong> - перейти в раздел "Каталог - Выгруженные товары - 1С:Предприятие"
    <li><strong>Шаг 7</strong> - выделите флажком товары и выберете папку для переноса опцией "С отмеченными - Перенести в каталог". Если требуется,  составьте соответствующие каталоги.
</ol></td>
</tr>
<tr>
   <td valign="top"><h4>Внимание!</h4>
Внимательно проверяйте предварительно загруженные данные во избежания
 неверной их загрузки.</td>
</tr>
</table>
<div align="right" style="padding:10">';
if($SysValue['pro']['enabled'] == "true")
@$interface.='
<BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin(\'./1c/seamply_base_1c.csv\',500,370)">
<img src="./img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
Скачать пример файла
</BUTTON>
</div>
</TD></TR></TABLE>
	  ';
	  }
	  else $interface = $UserChek->BadUserForma();
	  break;
	  
	 // Загрузка базы
	  case("csv_base"):
	  if(CheckedRules($UserStatus["sql"],1) == 1)
     @$interface.=('

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang id=txtLang>Мастер загрузки товарной базы Excel</span></h4></div>
<FIELDSET>

<FORM name=csv_upload  method=post encType=multipart/form-data>
<table cellpadding="10" align="center">
<tr>
	<td>
	<span name=txtLang id=txtLang>Выберите файл с расширением</span> *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase(this.form.csv_file,\'predload\')" type=button value=OK><br>
<INPUT class=but type=reset name="btnLang" value=Сброс> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>

<tr>
   <td colspan="2">
      <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>Д</u>анные, отмечанные флажками будут изменены/добавлены</LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_1" checked> Наименование&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_2" checked> Краткое описание&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_3" checked> Маленькая картинка&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_4" checked> Подробное описание&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_5" checked> Большая картинка&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_6" checked> Цена1&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_7" checked> Цена2&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_8" checked> Цена3&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_9" checked> Цена4&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_10" checked> Цена5&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_11" checked> Склад&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_12" checked> Вес&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_13" checked> Артикул&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_14" checked> Категория&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_15" checked> Характеристики&nbsp;&nbsp;
</div>
</div>
</FIELDSET>
   </td>
</tr> 

</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="100%" ><h4><span name=txtLang id=txtLang>Ход операции</span></h4>
<ol>
    <li><span name=txtLang id=txtLang><strong>Шаг 1</strong> - скачать пример файла (см. ниже)</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 2</strong> - выбрать заранее заполненный файл</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 3</strong> - принять изменения в распечатанном файле</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 4</strong> - дождаться выполнения операции</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 5</strong> - перейти в раздел "Каталог - Выгруженные товары - База Excel"</span>
    <li><span name=txtLang id=txtLang><strong>Шаг 6</strong> - выделите флажком товары и выберете папку для переноса опцией "С отмеченными - Перенести в каталог". Если требуется,  составьте соответствующие каталоги.</span>
</ol></td>
</tr>
<tr>
   <td valign="top"><h4><span name=txtLang id=txtLang>Внимание!</span></h4>
<span name=txtLang id=txtLang>Внимательно проверяйте предварительно загруженные данные во избежания
 неверной их загрузки</span>.</td>
</tr>
</table>
<div align="right" style="padding:10">
<BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin(\'./export/seamply_base.csv\',500,370)">
<img src="./img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
<span name=txtLang id=txtLang>Скачать пример файла</span>
</BUTTON>
</div>




</TD></TR></TABLE>

   ');
      else $interface = $UserChek->BadUserForma();
      break;
	  
	   
	  // Загрузка прайса
	  case("csv"):
	  if(CheckedRules($UserStatus["sql"],1) == 1)
     @$interface.=('

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>
<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang id=txtLang>Мастер загрузки прайса Excel (опорных данных)</span></h4>
<p>Возможно только обновление данных, для загрузки новых товаров <br>
воспользуйтесь модулем <a href="javascript:DoReload(\'csv_base\')"><img src="img/i_eraser[1].gif" alt="" width="16" height="16" border="0" hspace="3" align="absmiddle">"Загрузка базы Excel"</a>
</p>
</div>
<FIELDSET>
<table cellpadding="10" align="center">
<FORM name=csv_upload method=post encType=multipart/form-data>
<tr>
	<td>
	<span name=txtLang id=txtLang>Выберите файл с расширением</span> *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoad(this.form.csv_file,\'predload\',null,\'csv\')" type=button value=OK><br>
<INPUT class=but name="btnLang" type=reset value=Сброс> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>
</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="350" ><h4><span name=txtLang id=txtLang>Ход операции</span></h4>
<ol>
	<li><span name=txtLang id=txtLang><strong>Шаг 1</strong> - выбрать заранее выгруженный прайс</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 2</strong> - принять изменения в распечатанном прайсе</span>
	<li><span name=txtLang id=txtLang><strong>Шаг 3</strong> - дождаться выполнения операции</span>
</ol></td>
    <td></td>
	<td valign="top"><h4><span name=txtLang id=txtLang>Внимание</span>!</h4>
<span name=txtLang id=txtLang>Внимательно проверяйте предварительно загруженные данные во избежания
 неверной загрузки данных</span>.</td>
</tr>
</table>
</TD></TR></TABLE>

   ');
      else $interface = $UserChek->BadUserForma();
      break;
	   
	  // Статусы
	  case("shopusers_status"):
	  require("../shopusers/admin_status.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= ShopUsersStatus();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // Отчеты
      case("stats1"):
	  require("../report/admin_stats1.php");
	  $a_button=18;
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=Stats1($var1,$var2,$var3,$var4);
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // Характеристики Груп=ппы
      case("sort_group"):
	  require("../sort/admin_sort.php");
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=SortsGroup();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // Характеристики
      case("sort"):
	  require("../sort/admin_sort.php");
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=Sorts();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // Блоки
      case("page_menu"):
	  require("../menu/admin_menu.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface=Menu();
	  else $interface = $UserChek->BadUserForma();
      break;


      // Банеры
      case("baner"):
	  require("../baner/admin_baner.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface=Baner();
	  else $interface = $UserChek->BadUserForma();
      break;

      // Новости
      case("news"):
	  require("../news/admin_news.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td><form name="data_list">
<table cellpadding="0" cellspacing="0">
<tr>
  <td width="5"></td>
	<td>
	 <table cellspacing="0" cellpadding="0" >
 
<tr>
	<td>
    <select class=s name="data_news" id="data_news">
	'.Ras_data().'
	</select>
	<input type=button name="btnLang" value=Разослать class=but3 onclick="Ras(data_news.value,400,200)">
	<input type=hidden name=p value=news>
	</td>
</tr>
</table>

	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but2" class="butoff"><img src="icon/page_new.gif" name="imgLang" alt="Новая позиция" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'news/adm_news_new.php\',630,630)"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=News();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // журнал поиска
      case("search_jurnal"):
	  require("../report/admin_search_jurnal.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	else $interface.=@$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
		<input type=button name="btnLang" value=Показать class=but3 onclick="DoReload(\'search_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>С отмеченными</option>
			<option value="15" id=txtLang>Добавить в поисковую базу</option>
			<option value="16" id=txtLang>Удалить из журнала</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	   <td id="but2" class="butoff"><img src="icon/page_go.gif" name="imgLang" alt="Передресация поиска" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="DoReload(\'search_pre\')"></td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["users"],0) == 1) $interface.=SearchJurnal($var1,$var2);
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // Переадресация поиска
      case("search_pre"):
	  require("../report/admin_search_pre.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td id="but2" class="butoff"><img src="icon/page_add.gif" name="imgLang" alt="Новая позиция" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'report/adm_pre_new.php\',400,380)"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id="txtLang">С отмеченными</option>
			<option value="17" id="txtLang">Удалить из базы</option>
			<option value="18" id="txtLang">Заблокировать</option>
			<option value="19" id="txtLang">Задействовать</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	   <td id="but1" class="butoff"><img src="icon/page_find.gif" name="imgLang" alt="Журнал поиска" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="DoReload(\'search_jurnal\')"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["stats1"],0) == 1) $interface.=SearchPre();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // Черный список
      case("users_jurnal_black"):
	  require("../users/admin_users.php");
	  if(CheckedRules($UserStatus["users"],0) == 1) $interface.=UsersJurnalBlack();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // Журнал авторизации
      case("users_jurnal"):
	  require("../users/admin_users.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	 else {$interface.= @$var2;}
	$interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button name="btnLang" value=Показать class=but3 onclick="DoReload(\'users_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but23"  class="butoff"><img src="icon/vcard_delete.gif" name="imgLang" alt="Черный список" width="16" height="16" border="0" onmouseover="ButOn(23)" onmouseout="ButOff(23)" onclick="DoReload(\'users_jurnal_black\')"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["users"],0) == 1)   
	    $interface.=UsersJurnal($var1,$var2);
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // Опросы
      case("opros"):
	  require("../opros/admin_opros.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Opros();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // Ссылки
      case("links"):
	  require("../link/admin_links.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Links();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // Отзывы
      case("gbook"):
	  require("../gbook/admin_gbook.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Gbook();
	  else  $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // Администраторы
      case("users"):
	  require("../users/admin_users.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Users();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
      // Авторизованные пользователи
      case("shopusers"):
$interface=('
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>С отмеченными</option>
			<option value="20" id=txtLang>Заблокировать</option>
			<option value="21" id=txtLang>Разблокировать</option>
			<option value="22" id=txtLang>Удалить из базы</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>	
	<input type=text name="words" id="words" size=30 class=s onMouseMove="show(\'[ '.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][5].'\')" onMouseOut="hide()" onfocus="hide()">
	<input type=button value=Поиск class=but3 name="btnLang"  onclick="DoReload(\'shopusers\',document.getElementById(\'words\').value)"></td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	 <td id="but2" class="butoff"><img src="icon/group_add.gif" name="imgLang" alt="Новая позиция" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'shopusers/adm_users_new.php\',500,560)"></td>
<td width="5"></td>
<td id="but39" class="butoff"><img src="icon/folder_key.gif" name="imgLang" alt="Статусы пользователей" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'shopusers_status\')"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
    <td width="5"></td>
	<td><span name=txtLang id=txtLang>Статус</span>: '.GetUsersStatusForma($var2).'</td>

	   
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
');
     require("../shopusers/admin_users.php");
	 if(CheckedRules($UserStatus[$p],0) == 1) $interface.=ShopUsers($var2,$var1);
	 else $interface=$UserChek->BadUserForma();
	 break;
	 
	 // Каталог товаров
	 case("cat_prod"):
	 $interface='
	 <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name="search">
<table cellpadding="0" cellspacing="0">
<tr>
<td width="7"></td>
<td><span name=txtLang id=txtLang>Поиск</span>: 
	<input type=text name="words" size=50 class=s  onMouseMove="show(\'[ Подсказка]\', \'Поиск товара производится по номеру товара ID, артикулу или названию\')" onMouseOut="hide()" onfocus="hide()">
	<input type=button id=btnShow value=Показать class=but3 onclick="SearchProducts(search.words.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
   
	<td id="but1"  class="butoff"><img name="imgLang" src="icon/folder_add.gif" alt="Новый каталог" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="miniWin(\'catalog/adm_catalog_new.php\',650,630);return false;"></td>
   <td width="3"></td>
	<td id="but2" class="butoff"><img name="imgLang" src="icon/page_new.gif" alt="Новая позиция" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="NewProduct()"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
   <td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" alt="Редактировать подкаталог" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalog()"></td>
<td width="3"></td>
      <td id="but38" class="butoff"><img name="imgLang" src="icon/layout_content.gif" alt="Вывод всех товаров" width="16" height="16" border="0" onmouseover="ButOn(38)" onmouseout="ButOff(38)" onclick="AllProducts()"></td>
  <td width="3"></td>
<td id="but39"  class="butoff"><img name="imgLang" src="icon/icon_component.gif" alt="Характеристики" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'sort\')"></td>
  <td width="3"></td>
  <td id="buttable_sort" class="butoff"><img name="imgLang" src="icon/table_sort.gif" alt="Калькулятор характеристик" width="16" height="16" border="0" onmouseover="ButOn(\'table_sort\')" onmouseout="ButOff(\'table_sort\')" onclick="CalcSort()"></td>
     <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
<select name="action" size="1" onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)" id="actionSelect">
		<option id="txtLang" value="0" SELECTED>С отмеченными:</option>
		<optgroup id="txtLang" label="Действия" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="14" STYLE="background: #fff">Перенести в каталог</option>
		<option id="txtLang" value="9" STYLE="background: #fff">Сделать копию</option>
		<option id="txtLang" value="23" STYLE="background: #fff">Связать со статьями</option>
        <option id="txtLang" value="24" STYLE="background: #fff">Связать с характеристикой</option>
		<option id="txtLang" value="8" STYLE="background: #fff">Экспорт в Excel</option>
		</optgroup> 
		<optgroup id="txtLang" label="Новинки" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="10" STYLE="background: #fff">Добавить в новинки</option>
		<option id="txtLang" value="11" STYLE="background: #fff">Убрать из новинок</option>
		</optgroup> 
		<optgroup id="txtLang" label="Спецпредложение" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="2" STYLE="background: #fff">Добавить в спецпредложение</option>
		<option id="txtLang" value="3" STYLE="background: #fff">Убрать из спецпредложения</option>
		</optgroup>
		<optgroup id="txtLang" label="Вывод" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="27" STYLE="background: #fff">Нет в наличии</option>
		<option id="txtLang" value="28" STYLE="background: #fff">Есть в наличии</option>
		<option id="txtLang" value="4" STYLE="background: #fff">Отключить вывод</option>
		<option id="txtLang" value="5" STYLE="background: #fff">Включить вывод</option>
		<option id="txtLang" value="1" STYLE="background: #fff">Удалить из базы</option>
		</optgroup> 
		<optgroup id="txtLang" label="YML Яндекс Маркет" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="6" STYLE="background: #fff">Убрать из YML прайса</option>
		<option id="txtLang" value="7" STYLE="background: #fff">Добавить в YML прайс</option>
		</optgroup> 
		

</select>
	</td>
	<td width="5"></td>
	<td>
	<input type="radio" name="DoAll" value="1" onclick="SelectAll(this,window.frame2.document.form_flag,1000)" id="DoAll"><span name=txtLang id=txtLang>Отметить все</span></input>
	</td>
	<td width="5"></td>
	<td>
	<input type="radio" name="DoAll" value="2" onclick="SelectAll(this,window.frame2.document.form_flag,1000)"><span name=txtLang id=txtLang>Снять отметку</span>    
	</td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
	 require("../catalog/admin_catalog.php");
	 $a_button=0;
	 if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Catalog();
	 else $interface=$UserChek->BadUserForma();
	 break;
	 
	 
	 // Страницы
	 case("page_site_catalog"):
	 $interface='
	 <form method="post" name="search">
	 <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>

<table cellpadding="0" cellspacing="0">
<tr>
    <td width="10"></td>
<td><span name=txtLang id=txtLang>Поиск страницы</span>: 
	<input type=text name="words" size=50 class=s  onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['4'].'\')" onMouseOut="hide()" onfocus="hide()">
	<input name="btnLang" type=button value=Показать class=but3 onclick="SearchPage(search.words.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but23"  class="butoff"><img name="imgLang" src="icon/page_new.gif" alt="Новая позиция" width="16" height="16" border="0" onmouseover="ButOn(23)" onmouseout="ButOff(23)" onclick="NewProductPage()">
    </td>
    <td width="3"></td>
	<td id="but1"  class="butoff"><img name="imgLang" src="icon/folder_add.gif" alt="Новый каталог" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="miniWin(\'page/adm_catalog_new.php\',\'500\',\'320\')"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	<td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" alt="Редактировать подкаталог" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalogPage()"></td>
<td width="3"></td>
      <td id="but38" class="butoff"><img name="imgLang" src="icon/layout_content.gif" alt="Вывод всех страниц" width="16" height="16" border="0" onmouseover="ButOn(38)" onmouseout="ButOff(38)" onclick="AllPage()"></td>
   <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   
   <select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>С отмеченными</option>
			<option value="30" id=txtLang>Включить вывод</option>
			<option value="31" id=txtLang>Отключить вывод</option>
			<option value="32" id=txtLang>Включить регистрацию</option>
			<option value="33" id=txtLang>Отключить регистрацию</option>
			<option value="34" id=txtLang>Перенести в каталог</option>
			<option value="35" id=txtLang>Добавить рекомендованные товары</option>
			<option value="39" id=txtLang>Удалить из базы</option>
   </select>
   </td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>';
	 require("../page/admin_page_catalog.php");
	 if(CheckedRules($UserStatus["page_site"],0) == 1) $interface.=SiteCatalog();
	 else $interface=$UserChek->BadUserForma();
	 break;
	 

	 // По дефолту грузим заказы
	 case("orders"):
	 $a_button=3;
	 //${"list_".$var4.""}="SELECTED";
	 $interface='
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;" height="10">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.= date("d-m-Y");
	else $interface.= @$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button id=btnShow value="Показать" class=but3 onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=50 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_3'].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=Поиск class=but3 id=btnSearch  onclick="DoReload(\'orders\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <span name=txtLang id=txtLang>Статус</span>: '.GetOrderStatusApi($var4).'
   <input type=button id=btnStatus value="Показать" class=but3 onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value,\'\',list.value)">
   </td>
    <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
    <td width="3"></td>
	    <td id="but45"  class="butoff"><img name="iconLang" src="icon/coins.gif" alt="Электронные платежи" width="16" height="16" border="0" onmouseover="ButOn(45)" onmouseout="ButOff(45)" onclick="DoReload(\'order_payment\')"></td>
    <td width="3"></td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
	
   <td>
   <table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>
   	<img name="iconLang" src="icon/plugin.gif" width="16" height="16" border="0"  align="absmiddle" hspace="1">
<a href="javascript:LoadAgent()" class="blue" title="Контроль и редактирование заказов на рабочем столе Windows">Загрузить Order Agent Windows</a>
   </td>
	<td align="right">
	<select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>С отмеченными</option>
			<option value="36" id=txtLang>Удалить из базы</option>
			<option value="37" id=txtLang>Изменить статус</option>
			<option value="38" id=txtLang>Создать новый</option>
   </select>

	</td>
	  
</td>
</tr>
</table>
   </td>
</tr>
</table>

	 ';
	 require("../order/admin_visiter.php");
	 if(CheckedRules($UserStatus["visitor"],0) == 1) $interface.=Visitor($var1,$var2,$var3,$var4);
	 else $interface=$UserChek->BadUserForma();
	 break;
}



// Формируем результат 
$_RESULT = array(
  "q"     => $q,
  "xid"   => $interface,
  "tit"   => $ProductName." -> ".$SysValue['Lang']['Title']['admpanel']." -> ".$SysValue['Lang']['Title'][$p],
  'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
?>