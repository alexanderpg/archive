<?php

function addProductIDProductcomponents($data) {
    global $PHPShopGUI;

    $Tab = $PHPShopGUI->setField('Скидка', $PHPShopGUI->setInputText(null, 'productcomponents_discount_new', $data['productcomponents_discount'], 100, '%'));
    $Tab .= $PHPShopGUI->setTextarea('productcomponents_products_new', $data['productcomponents_products'], false, false, false, __('Укажите ID товаров или воспользуйтесь') .
            ' <a href="#" data-target="#productcomponents_products_new"  class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ' . __('поиском товаров') . '</a>');

    $PHPShopGUI->addJSFiles('../modules/productcomponents/admpanel/gui/productcomponents.gui.js');
    $PHPShopGUI->addTab(array("Комплектующие", $Tab, true));
}

function updateProductIDProductcomponents() {

    if (!empty($_POST['productcomponents_products_new'])) {

        $ids = explode(",", $_POST['productcomponents_products_new']);
        if (is_array($ids)) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
            $row = $PHPShopOrm->getList(['*'], ['id IN (' => implode(',', $ids) . ')']);

            $price = $price2 = $price3 = $price4 = $price5 = 0;
            $enabled = 1;
            $items = 100;

            if (is_array($row)) {
                foreach ($row as $data) {

                    $price += $data['price'];
                    $price2 += $data['price2'];
                    $price3 += $data['price3'];
                    $price4 += $data['price4'];
                    $price5 += $data['price5'];

                    if ($data['items'] < $items)
                        $items = $data['items'];
                    
                    if(empty($data['items']) or empty($data['enabled'])){
                        $items=0;
                        $enabled = 0;
                    }  
                }
            }

            $price = $price - ($price * $_POST['productcomponents_discount_new'] / 100);
            $price2 = $price2 - ($price2 * $_POST['productcomponents_discount_new'] / 100);
            $price3 = $price3 - ($price3 * $_POST['productcomponents_discount_new'] / 100);
            $price4 = $price4 - ($price4 * $_POST['productcomponents_discount_new'] / 100);
            $price5 = $price5 - ($price5 * $_POST['productcomponents_discount_new'] / 100);

            $_POST['price_new'] = $price;
            $_POST['price2_new'] = $price2;
            $_POST['price3_new'] = $price3;
            $_POST['price4_new'] = $price4;
            $_POST['price5_new'] = $price5;
            $_POST['enabled_new'] = $enabled;
            $_POST['items_new'] = $items;
        }
    }
}

$addHandler = array(
    'actionStart' => 'addProductIDProductcomponents',
    'actionDelete' => false,
    'actionUpdate' => 'updateProductIDProductcomponents'
);
?>