<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");


// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");


function TestCat($n)// есть ли еще подкаталоги
{
global $table_name,$sid;
$sql="select id from $table_name where parent_to='$n'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return $num;
}


function Vivod_rekurs($n)// вывод подкаталогов рекурсом
{
global $table_name,$sid;

// Multibase
$Systems=GetSystems();
$admoption=unserialize($Systems['admoption']);
if($admoption['base_enabled'] == 1)
$sort="and servers REGEXP 'i".$admoption['base_id']."i'";

$sql="select * from $table_name where parent_to='$n' $sort order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$i=0;
$id=$row['id'];
$name=$row['name'];
$parent_to=$row['parent_to'];
$num=TestCat($id);

if($i<$num)// если есть еще каталоги
  {
   @$disp.="d.add($id,$n,'$name','javascript:AdmCat($id,500,370);');
".Vivod_rekurs($id)."
";

  }
else// если нет каталогов
   {
   @$disp.="d.add($id,$n,'$name (".Vivod_cat_all_num($id).")','admin_cat_content.php?pid=$id');";
   }

}
return @$disp;
}

function Vivod_pot()// вывод каталогов
{
global $table_name,$system,$SysValue;

// Multibase
$Systems=GetSystems();
$admoption=unserialize($Systems['admoption']);
if($admoption['base_enabled'] == 1)
$sort="and servers REGEXP 'i".$admoption['base_id']."i'";

$sql="select * from $table_name where parent_to=0 $sort order by num";
$result=mysql_query($sql);
$i=0;
$j=0;
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	$num=TestCat($id);
	if($num>0) 
	 @$dis.="
	d.add($id,0,'$name','javascript:AdmCat($id,500,270);');
	".Vivod_rekurs($id)."
	";
	else @$dis.="
	d.add($id,0,'$name (".Vivod_cat_all_num($id).")','admin_cat_content.php?pid=$id');
	".Vivod_rekurs($id)."
	";
	
	$i++;
	 }
$dis="
<script type=\"text/javascript\">
		<!--
		d = new dTree('d');
		d.add(0,-1,'<b>".$SysValue['Lang']['Category'][1]."</b>');
        ".$dis."
		
	

	d.add(1000000,0,'".$SysValue['Lang']['Category'][2]."','','','','../img/imgfolder.gif','');
		d.add(1000001,1000000,'".$SysValue['Lang']['Category'][3]." (".Vivod_cat_all_num(1000001).")','admin_cat_content.php?pid=1000001');
        d.add(1000002,1000000,'".$SysValue['Lang']['Category'][4]." (".Vivod_cat_all_num(1000002).")','admin_cat_content.php?pid=1000002');
     d.add(1000003,0,'".$SysValue['Lang']['Category'][14]."','','','','../img/imgfolder.gif','');
".Vivod_rekurs(1000003)."
		document.write(d);
		//-->
	</script>
";
return $dis;
}



function Vivod_cat_all_num($n)// выбор кол-ва товаров из данного подкатолога
{
global $table_name2,$_SESSION,$UserStatus;
if(CheckedRules($UserStatus["cat_prod"],3) == 1)
$sql="select id from $table_name2 where category='$n' and enabled='1'";
else $sql="select id from $table_name2 where category='$n' and enabled='1' and user='".$_SESSION['idPHPSHOP']."'";
$result=mysql_query($sql);
@$num=mysql_num_rows(@$result);
if(empty($num)) $num=0;
return $num;
}


function Num($n)// Вывод кол-ва товаров в катологе
{
global $table_name;
$sql="select id from $table_name where parent_to='$n'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$pod=Vivod_cat_all_num($id);
	@$num+=$pod;
	}
return $num;
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/dtree.css" type=text/css rel=stylesheet>
<SCRIPT language=JavaScript src="../java/dtree.js" type=text/javascript></SCRIPT>
</head>
<body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="#ffffff">
<div style="padding:10px">
<?echo Vivod_pot();?>
</div>
</body>
</html>

