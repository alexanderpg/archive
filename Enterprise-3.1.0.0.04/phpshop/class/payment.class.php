<?
if (!defined("OBJENABLED"))
require_once(dirname(__FILE__)."/obj.class.php");

class PHPShopPayment extends PHPShopObj{
     
	 function PHPShopPayment($objID){
	 $this->objID=$objID;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name48'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 function getId(){
	 return parent::getParam("id");
	 }
}

?>