<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Модуль Вывода Фотогалереи          |
+-------------------------------------+
*/


// Вывод случайной картинки для краткого описания
function getFotoIconKratko($n){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name35']." where parent=$n order by RAND()";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
$row = mysql_fetch_array($result);
	$name=str_replace(".","s.",$row['name']);
	$array=array($name,$num);
return $array;
}



// Вывод картинки для подробного описания
function getFotoIconPodrobno($n,$pic_big){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name35']." where parent=$n order by num";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
if($num !=0){
$j=1;
while(@$row = mysql_fetch_array(@$result))
    {
	$name=$row['name'];
	$name_s=str_replace(".","s.",$name);
	$id=$row['id'];
	$info=$row['info'];
	$FotoArray[]=array(
	"id"=>$id,
	"name"=>$name,
	"name_s"=>$name_s,
	"info"=>$info
	);
}

if(is_array($FotoArray))
	$dBig='
 <div align="center" id="IMGloader" style="padding-bottom: 10px">
 <img src="'.$FotoArray[0]["name"].'" border="1" class="imgOn" alt="'.$f.'" onerror="NoFoto2(this)"><br>'.$FotoArray[0]["info"].'
</div>';
	
	
	
    
	
if(is_array($FotoArray[0]))
@$disp.='
  <td align="center">
  1<br>
  <a href="javascript:fotoload('.$n.',0);"><img src="'.$FotoArray[0]["name_s"].'" alt="'.$FotoArray[0]["info"].'" border="1" class="imgOn" height="110" onerror="NoFoto2(this)"></a><br>&nbsp;
  </td>';
  
if(is_array($FotoArray[1]))
@$disp.='
  <td align="center">2<br>
    <a href="javascript:fotoload('.$n.',1);"><img src="'.$FotoArray[1]["name_s"].'" alt="'.$FotoArray[1]["info"].'" border="1" class="imgOff" onmouseover="ButOn(this)" onmouseout="ButOff(this)" height="110" onerror="NoFoto2(this)"></a><br>&nbsp;
  </td>';
  
if(is_array($FotoArray[2]))
@$disp.='
  <td align="center">3<br>
    <a href="javascript:fotoload('.$n.',2);"><img src="'.$FotoArray[2]["name_s"].'" alt="'.$FotoArray[2]["info"].'" border="1" class="imgOff" onmouseover="ButOn(this)" onmouseout="ButOff(this)" height="110" onerror="NoFoto2(this)"><br>
Вперед &raquo;</a>
  </td>

';

	
	
$d=$dBig;
if($num>1) $d.='
<table class="foto">
<tr>
'.$disp.'
</tr>
</table>
<div style="color: #5A6666;font-size: 11px">Доступно изображений: <strong>'.$num.'</strong> </div>
';
}
else {

$d='
 <div align="center" id="IMGloader" style="padding-bottom: 10px">
 <img src="'.$pic_big.'" border="1" class="imgOn" alt="'.$f.'" onerror="NoFoto2(this)" width="300">
</div>';

}
return $d;
}

?>
