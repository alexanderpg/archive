<?php

function showcaseelement_hook($obj, $row, $rout) {

    if ($rout == 'MIDDLE') {
        if (!empty($row['selector_name']))
            $obj->set('ShowcaseName', $row['selector_name']);
    }
    
    if($rout == 'END'){
        $showcase_menu = $obj->parseTemplate($obj->getValue('templates.showcase_menu'));
        $obj->set('visualcart_lib',$showcase_menu.'<script type="text/javascript" src="phpshop/modules/showcaseselect/js/showcaseselect.js"></script>',true);
    }
   
}

$addHandler = array
    (
    'index' => 'showcaseelement_hook',
);
