<?php

include_once dirname(__FILE__) . '/../class/Megamarket.php';

function addMegamarketProductTab($data) {
    global $PHPShopGUI;

    // Размер названия поля
    $PHPShopGUI->field_col = 4;

    $tab = $PHPShopGUI->setField(null, $PHPShopGUI->setCheckbox('export_megamarket_new', 1, 'Включить экспорт в ММ', $data['export_megamarket']));

    // Валюты
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            if ($data['baseinputvaluta'] == $val['id']) {
                $valuta_def_name = $val['code'];
            }
        }

    $tab .= $PHPShopGUI->setField('Цена ММ', $PHPShopGUI->setInputText(null, 'price_megamarket_new', $data['price_megamarket'], 150, $valuta_def_name), 2);

    $PHPShopGUI->addTab(array("Мегамаркет", $tab, true));
}

function MegamarketUpdate() {

    // Отключение 
    if (!isset($_POST['export_megamarket_new']) and ! isset($_POST['ajax'])) {
        $_POST['export_megamarket_new'] = 0;
    }

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $data = $PHPShopOrm->getOne(['*'], ['id' => '=' . (int) $_POST['rowID']]);

    if (isset($_POST['enabled_new']) and empty($_POST['enabled_new']))
        $_POST['items_new'] = $_POST['export_megamarket_new'] = 0;

    if (isset($_POST['items_new']))
        $data['items'] = (int) $_POST['items_new'];

    if (isset($_POST['price_new']))
        $data['price'] = $_POST['price_new'];

    if (isset($_POST['export_megamarket_new']))
        $data['export_megamarket'] = (int) $_POST['export_megamarket_new'];

    if (!empty($data['export_megamarket'])) {

        $Megamarket = new Megamarket();
        if ($Megamarket->type == 2) {
            $offerId = $data['uid'];
        } else {
            $offerId = $data['id'];
        }

        $stocks[] = [
            'offerId' => (string) $offerId,
            'quantity' => (int) $data['items'],
        ];

        // Склад
        $Megamarket->setProductStock($stocks, $offerId);

        // Цены
        $price = $data['price'];

        if (!empty($data['price_megamarket'])) {
            $price = $data['price_megamarket'];
        } elseif (!empty($data['price' . (int) $data['price']])) {
            $price = $data['price' . (int) $Megamarket->price];
        }

        if ($Megamarket->fee > 0) {
            if ($Megamarket->fee_type == 1) {
                $price = $price - ($price * $Megamarket->fee / 100);
            } else {
                $price = $price + ($price * $Megamarket->fee / 100);
            }
        }

        $prices[] = [
            'offerId' => (string) $offerId,
            'price' => (int) $Megamarket->price($price, $data['baseinputvaluta']),
            'isDeleted' => (bool) false
        ];


        $Megamarket->setProductPrice($prices, $offerId);
    }
}

$addHandler = array(
    'actionStart' => 'addMegamarketProductTab',
    'actionDelete' => false,
    'actionUpdate' => 'MegamarketUpdate'
);
?>