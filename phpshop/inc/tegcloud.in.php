<?
/*
+-------------------------------------+
|  PHPShop 2.1  Enterprise            |
|  Модуль Облака Тегов                |
+-------------------------------------+
*/


function  TegCloud($n)
{
global $SysValue,$LoadItems;

$n = CleanSearch($n);

switch($SysValue['nav']['nav']){
     
	 case(""):
	 $str=" where enabled='1' and keywords!='' order by RAND() LIMIT 0, 10";
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
	 
	 default: $str="none";
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
	

if(is_array($ArrayWords))
foreach($ArrayWords as $v){
$count=array_keys($ArrayWords,$v);
$CloudCount[$v]['size']=count($count);
}


if(is_array($CloudCount))
foreach($CloudCount as $key=>$val)
  if($tip=="serach") @$disp.="<a href=\"/search/?words=$key&pole=2\" title=\"$key\"><font size=\"+".$val['size']."\">$key</font></a> ";
    else @$disp.="<font size=\"+".$val['size']."\">$key</font> ";

$disp='
<div>'.$disp.'</div>
';
@$SysValue['sql']['num']++;
}
return @$disp;
}

	
if($admoption['cloud_enabled']==1) 
$SysValue['other']['cloud']= TegCloud($SysValue['nav']['id']);
?>
