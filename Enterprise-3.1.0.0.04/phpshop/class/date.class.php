<?

class PHPShopDate {

     function dataV($nowtime){
     $Months = array("01"=>"€нвар€","02"=>"феврал€","03"=>"марта", 
     "04"=>"апрел€","05"=>"ма€","06"=>"июн€", "07"=>"июл€",
     "08"=>"августа","09"=>"сент€бр€",  "10"=>"окт€бр€",
     "11"=>"но€бр€","12"=>"декабр€");
     $curDateM = date("m",$nowtime); 
     $t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime)." ".date("H:s ",$nowtime); 
     return $t;
     }
     
	 function GetUnicTime($data){
     $array=explode("-",$data);
     return @mktime(12, 0, 0, $array[1], $array[0], $array[2]);
     }
	 
}


?>
