<?
   // Определяем переменые
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // Подключаем шаблон
   $disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
       $disp.="
<script language=\"JavaScript1.2\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
   session_unregister('cart');


$SysValue['other']['orderMesage']=$disp;
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);



// Подключаем шаблон
@ParseTemplate($SysValue['templates']['shop']);
   
   
?>
