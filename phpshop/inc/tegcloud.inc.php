<?
/*
+-------------------------------------+
|  PHPShop 2.1  Enterprise            |
|  Модуль Облака Тегов                |
+-------------------------------------+
*/

// Вычисляем размер ссылки
function FontSize($s){
if($s>20) $a=20;
else $a = 11+$s/2;
return $a;
}



function  TegCloud($n)
{
global $SysValue,$LoadItems;

$n = CleanSearch($n);
$my_limit = 100; // задается кол-во тегов для сравнения
switch($SysValue['nav']['nav']){
     
	 case(""):
	 $str=" where enabled='1' and keywords!='' order by RAND() LIMIT 0, $my_limit";
	 $tip="serach";
	 break;
	 
	 case("CID"):
	 $tip="words";
	 if($SysValue['nav']['path'] == "shop")
	 $str=" where category=$n and enabled='1'";
	    else $str="none";
	 break;
	 
	 case("UID"):
	 $tip="words";
	 $str=" where id=$n and enabled='1'";
	 break;
	 
	 default: $str=" where enabled='1' and keywords!='' order by RAND() LIMIT 0, $my_limit";
	 $tip="serach";
	 break;
}


if($str!="none"){
$sql="select keywords from ".$SysValue['base']['table_name2']." $str";
$result=mysql_query($sql);

while (@$row = mysql_fetch_array($result))
    {
	$keywords=$row['keywords'];
	$explode=explode(", ",$keywords);
	foreach($explode as $ev)
	if(!empty($ev)) $ArrayWords[]=$ev;
	}

if(!is_array($ArrayWords)) { // Если пусто
     $str=" where enabled='1' and keywords!='' order by RAND() LIMIT 0, $my_limit";
	 $tip="serach";
     $sql="select keywords from ".$SysValue['base']['table_name2']." $str";
     $result=mysql_query($sql);

    while (@$row = mysql_fetch_array($result))
    {
	$keywords=$row['keywords'];
	$explode=explode(", ",$keywords);
	foreach($explode as $ev)
	if(!empty($ev)) $ArrayWords[]=$ev;
	}


}	



if(is_array($ArrayWords))
foreach($ArrayWords as $v){
$count=array_keys($ArrayWords,$v);
$CloudCount[$v]['size']=count($count);
}


if(is_array($CloudCount))
foreach($CloudCount as $key=>$val)
  if($tip=="serach") @$disp.="<a href=\"/search/?words=$key&pole=2\" style='font-size:
".FontSize($val['size'])."px' title=\"$key\" >$key</a> ";
    else @$disp.="$key ";

if($tip=="serach")
$disp='<div>'.$disp.'</div>';
  else $disp='<H1>'.$disp.'</H1>';
@$SysValue['sql']['num']++;
}
return @$disp;
}

	

$SysValue['other']['cloud']= TegCloud($SysValue['nav']['id']);
?>
