<?

class PHPShopBase {
      var $iniPath;
	  var $SysValue;
	  var $codBase="cp1251";
	  var $debug="true";
	  
	  function PHPShopBase($iniPath){
	  $this->iniPath=$iniPath;
	  $this->SysValue=parse_ini_file($this->iniPath,1);
	  $GLOBALS['SysValue']=$this->SysValue;
	  $this->connect();
	  }
	  
      function getSysValue(){
	  return $this->SysValue;
	  }
	  
	  function getParam($param){
	  $param=explode(".",$param);
	  return $this->SysValue[$param[0]][$param[1]];
	  }
	  
	  
	  function errorConnect(){
	  echo "Нет соединения с базой!<br>";
	  if($this->debug == "true") echo "Ошибка: ".mysql_error();
	  exit();
	  }
	  
      function connect(){
	  $SysValue=$this->SysValue;
	  mysql_connect($this->getParam("connect.host"),$this->getParam("connect.user_db"),     $this->getParam("connect.pass_db")) or die( $this->errorConnect() );
      mysql_select_db($SysValue['connect']['dbase']);
      @mysql_query("SET NAMES '".$this->codBase."'");
	  }
	  
	  function chekAdmin(){
      $adminPath = explode("../",$this->iniPath);
      $i=2;
      while(count($adminPath) > $i){
           @$aPath.="../";
           $i++;
           }
	  require_once($aPath."enter_to_admin.php");
	  }

}
?>