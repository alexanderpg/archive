<?

if (!defined("OBJENABLED"))
require_once(dirname(__FILE__)."/obj.class.php");

class PHPShopProduct extends PHPShopObj{
	 
	 function PHPShopProduct($objID){
	 $this->objID=$objID;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name2'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 function getValutaID(){
	 return parent::getParam("baseinputvaluta");
	 }
}

?>