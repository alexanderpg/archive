<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Модуль Авторизации                 |
+-------------------------------------+
*/

$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);


// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");



// класс проверки пользователя
class UserChek {
      var $logPHPSHOP;
	  var $pasPHPSHOP;
	  var $idPHPSHOP;
	  var $statusPHPSHOP;
	  var $mailPHPSHOP;
	  var $OkFlag=0;
	  
	  function ChekBase($table_name){
	  $sql="select * from ".$table_name." where enabled='1'";
      @$result=mysql_query(@$sql);
      while (@$row = mysql_fetch_array(@$result)){
      if($this->logPHPSHOP==$row['login']){
	    if($this->pasPHPSHOP==$row['password']){
           $this->OkFlag=1;
		   }
      }}}
	  
	  function myDecode($disp){
      $decode=substr($disp,0,strlen($disp)-4);
      $decode=str_replace("I",11,$decode);
      $decode=explode("O",$decode);
      for ($i=0;$i<(count($decode)-1);$i++) @$disp_pass.=chr($decode[$i]);
      return base64_encode($disp_pass);
      }
	  
	  function BadUser(){
	  if($this->OkFlag == 0) exit("Login Error");
	  }
	  
	  function UserChek($logPHPSHOP,$pasPHPSHOP,$table_name){
	  $this->logPHPSHOP=$logPHPSHOP;
	  $this->pasPHPSHOP=$this->myDecode($pasPHPSHOP);
	  $this->ChekBase($table_name);
	  $this->BadUser();
	  }
}


$UserChek = new UserChek($log,$pas,$SysValue['base']['table_name19']);
?>