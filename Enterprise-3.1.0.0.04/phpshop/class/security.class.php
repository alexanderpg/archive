<?

class PHPShopSecurity {

	function true_email($email) {
    if(strlen($email)>100) return FALSE;
    return preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$email);
    }

    function true_login($login) {
    return ereg("^[a-zA-Z0-9_\.]{2,20}$",$login);
    }

    function true_passw($passw) {
    return ereg("^[a-zA-Z0-9_]{4,20}$",$passw);
    }

	
	function TotalClean($str,$flag)
    /*
    1 - проверяет корзину;
    2 - преобразует все в код html;
    3 - проверяет мыло;
    4 - проверяет ввод с формы
    5 - прверяет цифры
   */
    {
 if($flag==1)// корзина
 {
   if (!ereg ("([0-9])", $str)) 
     {
     $str="0";
     }
     return abs($str);
   }
 elseif($flag==2)// убирает бяки
      {
	  return htmlspecialchars(stripslashes($str));
	  }
 elseif($flag==3)// обработка строки на бяки в мыле
      {
	 //проверка почты
	  if(!preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$str))
        {
        $str="";
        }
	   return $str;
	  }
 elseif($flag==4)// обработка строки на бяки
      {
	  if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$str)) 
        {
        $str="";
         }
       return  htmlspecialchars(stripslashes($str));
	  }
 elseif($flag==5)// проверка вводимых цифр
      {
	  if (preg_match("/[^(0-9)|(\-)|(\.]/",$str)) 
       {
       $str="0";
       }
       return $str;
	  }
}
}


?>
