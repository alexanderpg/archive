<?

if (!defined("OBJENABLED"))
require_once(dirname(__FILE__)."/obj.class.php");

class PHPShopSystem extends PHPShopObj{
     
	 function PHPShopSystem(){
	 $this->objID=1;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name3'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 function getDefaultValutaId(){
     return parent::getParam("dengi");
	 }
	 
	 function getLogo(){
	 $logo = parent::getParam("logo");
	 if(empty($logo)) return "../../img/phpshop_logo.gif";
       else return $logo;
	 }
}

?>