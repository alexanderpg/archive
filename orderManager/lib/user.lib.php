<?

// класс проверки пользователя
class UserChek {
      var $logPHPSHOP;
	  var $pasPHPSHOP;
	  var $idPHPSHOP;
	  var $statusPHPSHOP;
	  var $mailPHPSHOP;
	  var $OkFlag=0;
	  
	  function ChekBase(){
	  $sql="select * from phpshop_users where enabled='1'";
      $result=mysql_query($sql);
      while ($row = mysql_fetch_array($result)){
      if($this->logPHPSHOP==$row['login']){
	    if($this->pasPHPSHOP==$row['password']){
           $this->OkFlag=1;
		   $this->idPHPSHOP=$row['id'];
	       $this->statusPHPSHOP=$row['status'];
	       $this->mailPHPSHOP=$row['mail'];
		   }
      }}}
	  
	  function BadUser(){
	  if($this->OkFlag == 0)
	  exit("Login Error!");
	  }
	  
	  function UserChek($logPHPSHOP,$pasPHPSHOP){
	  $this->logPHPSHOP=$logPHPSHOP;
	  $this->pasPHPSHOP=$pasPHPSHOP;
	  $this->ChekBase();
	  $this->BadUser();
	  }
}

$UserChek = new UserChek($log,$pas);

?>