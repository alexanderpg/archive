<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Модуль Сообщений                   |
+-------------------------------------+
*/


// Номер заказа для счет-фактуры
function GetNumOrders($cid){
global $SysValue;
$sql="select uid from ".$SysValue['base']['table_name9']." where cid='$cid'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
return $row['uid'];
}


// Сообщение пользователю
function SendMailUser($id,$flag="accounts"){
global $SERVER_NAME,$SysValue;

// Счет-фактура
if($cid=="invoice") $id = GetNumOrders($id);

$sql="select * from ".$SysValue['base']['table_name1']." where id=$id";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$order=unserialize($row['orders']);
$mail=$order['Person']['mail'];
$name=$order['Person']['name_person'];

$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <donotreply@".str_replace("www.","",$SERVER_NAME).">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm="Бухгалтереские документы по заказу №".$row['uid'];
$content="
Доброго времени!
--------------------------------------------------------

Уважаемый(ая) пользователь ".$name.", по заказу №".$row['uid']." стали доступны 
бухгалтереские документы в личном кабинете.";

if($row['user']>0)
$content.="

Вы всегда можете проверить статус заказа, загрузить файлы, распечатать платежные 
документы он-лайн через 'Личный кабинет' или по ссылке http://".$SERVER_NAME.$SysValue['dir']['dir']."/users/";

else $content.="
Вы всегда можете проверить статус заказа, загрузить файлы, распечатать платежные 
документы он-лайн по ссылке http://".$SERVER_NAME.$SysValue['dir']['dir']."/clients/?mail=".@$mail."&order=".@$uid."
E-mail: ".@$mail."
№ Заказа: ".@$uid;


$content.="

Дата: ".date("d-m-y H:s a")."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($mail,$zag_adm, $content, $header_adm);
}
?>
