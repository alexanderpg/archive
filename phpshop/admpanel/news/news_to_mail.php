<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

function Systems()// вывод настроек
{
global $table_name3;
$sql="select * from $table_name3";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row;
}
$systems=Systems();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>PHPSHOP->Действие</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script>
window.resizeTo(300, 150);
function CL()
{
window.close();
}
</script>
</head>
<body bottommargin="0" leftmargin="0" marginwidth="0" rightmargin="0" bgcolor="#FFF9E6" topmargin="0">
<?

function Ras_data_content($data)// Состав рассылки
{
global $table_name8,$SERVER_NAME,$news_sends_1,$news_sends_2,$systems;
$sql="select * from $table_name8  where datas='$data'";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$data=$row['datas'];
	$zag=$row['zag'];
	$kratko=strip_tags($row['kratko']);
	$podrob=$row['podrob'];
	if($podrob!="")
	 {
	 $link="<a href=\"http://$SERVER_NAME/news/ID_".$id.".html\">далее &raquo;</a>";
	 }
	 else
	    {
		$link="";
		}
	@$content.="
	<p>
<table>
<tr>
	<td class=date>$data</td>
	<td><strong>$zag</strong></td>
</tr>
</table>
$kratko
<div align=\"right\">".$link."</div>
</p>";
	}
	
$disp='
<html>
<head>
<style>
body, td{
font-family: Tahoma;
font-size: 11px;
background-color: #FFFFFF;
}
H1{
   FONT-SIZE: 15px;
   color: #0068B9;
}

.date{
   background-color:#1982C6;
   color: white;
   padding:5px
}


a{
  color: #0068B9;
}

</style>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td>
	<h1>Здравствуйте, представляем новости с сайта "'.$systems['name'].'"</h1>
	</td>
	<td align="right"><a href="http://$SERVER_NAME" target="_blank" title="$SERVER_NAME"><img src="http://'.$SERVER_NAME.$systems['logo'].'" alt="'.$systems['name'].'" width="122" height="100" border="0"></a></td>
</tr>
<tr>
   <td colspan="2" style="background-color:#1982C6;" height="3"></td>
</tr>
</table>

'.@$content.'


<em>С уважением,<br>
Коллектив '.$systems['company'].'</em>
<br><br><br>
</body>
</html>
';
return @$disp;
}


function Ras_data_mail($content,&$num)// По мылу марш...
{
global $table_name27,$systems,$SERVER_NAME;
$codepage  = "windows-1251";              
$header  = "MIME-Version: 1.0\n";
$header .= "From: ".$systems['adminmail2']." <".$systems['adminmail2'].">\n";
$header .= "Content-Type: text/html; charset=$codepage\n";
$header .= "X-Mailer: PHP/";
$zag="Анонсы новостей ".$systems['name'];

$sql="select mail from $table_name27 where enabled='1'";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$mail_to=$row['mail'];
	mail($mail_to,$zag,$content,$header);
	@$num++;
	}
	
}

if(isset($data))
{
// Включаем таймер
$time=explode(' ', microtime());
$start_time=$time[1]+$time[0];

$num=0;
$content=Ras_data_content($data);
Ras_data_mail($content,$num);

// Выключаем таймер
$time=explode(' ', microtime());
$seconds=($time[1]+$time[0]-$start_time);
$seconds=substr($seconds,0,6);

   echo"
	   <table width=100% height=100% align=center cellpadding=\"0\" cellspacing=\"0\">
       <tr valign=middle>
	   <td align=center>
	 <FIELDSET  style=\"width: 25.08em; height: 7em;\">
	<LEGEND ><font color=#FF0000>ВНИМАНИЕ!</font></LEGEND>
	<div style=\"padding:10\" align=\"center\">
	Рассылка произведена по <b>".$num."</b> адресу(ам).<br>
	Время обработки запроса: $seconds sec.<br><br>
	  <input type=submit value=Закрыть class=but3 onclick='CL()'>
	</div>
	</FIELDSET>
	   </td>
       </tr>
       </table>
	   ";
}
?>


