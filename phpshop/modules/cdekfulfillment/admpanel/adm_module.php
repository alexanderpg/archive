<?php

PHPShopObj::loadClass("order");
PHPShopObj::loadClass("delivery");

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cdekfulfillment.cdekfulfillment_system"));

// Обновление версии модуля
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $PHPShopOrm->update(array('version_new' => $new_version));
}

// Функция обновления
function actionUpdate() {
    global $PHPShopModules, $PHPShopOrm;

    // Настройки витрины
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    // Корректировка пустых значений
    $PHPShopOrm->updateZeroVars('paid_new', 'log_new');

    $action = $PHPShopOrm->update($_POST);

    header('Location: ?path=modules&id=' . $_GET['id']);

    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm,$PHPShopSystem;


    // Выборка
    $data = $PHPShopOrm->select();

    // Доступые статусы заказов
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();

    //$status[] = array(__('Новый заказ'), 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status) {
            $status[] = array($order_status['name'], $order_status['id'], $data['status']);
        }


    // Тарифы
    $rate[] = array(__('Экспресс склад-дверь'), 38, $data['rate']);
    $rate[] = array(__('Посылка склад-дверь'), 49, $data['rate']);
    $rate[] = array(__('Экономичная посылка склад-дверь'), 58, $data['rate']);

    $Tab1 = $PHPShopGUI->setField('Логин интеграции', $PHPShopGUI->setInputText(false, 'account_new', $data['account'], 300));
    $Tab1 .= $PHPShopGUI->setField('Пароль интеграции', $PHPShopGUI->setInputText(false, 'password_new', $data['password'], 300));
    $Tab1 .= $PHPShopGUI->setField('ID магазина', $PHPShopGUI->setInputText(false, 'shop_id_new', $data['shop_id'], 300));
    $Tab1 .= $PHPShopGUI->setField('ID склада', $PHPShopGUI->setInputText(false, 'warehouse_id_new', $data['warehouse_id'], 300));
    $Tab1 .= $PHPShopGUI->setField('ID отправителя', $PHPShopGUI->setInputText(false, 'sender_new', $data['sender'], 300));
    $Tab1 .= $PHPShopGUI->setField('Тариф', $PHPShopGUI->setSelect('rate_new', $rate, 300));
    
    $price=$PHPShopGUI->setSelectValue($data['price'], 5);
    $price[]=array(__('Закупочная'), '_purch', $data['price']);
    
    $Tab1 .= $PHPShopGUI->setField('Колонка цен CDEK', $PHPShopGUI->setSelect('price_new', $price, 300));
    $Tab1 .= $PHPShopGUI->setField('Статус заказа для отправки', $PHPShopGUI->setSelect('status_new', $status, 300));
    $Tab1 .= $PHPShopGUI->setField('Статус оплаты', $PHPShopGUI->setCheckbox('paid_new', 1, 'Заказ оплачен', $data["paid"]));
    
    // Склады
    $PHPShopOrmWarehouse = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
    $dataWarehouse = $PHPShopOrmWarehouse->select(array('*'), array('enabled' => "='1'"), array('order' => 'num DESC'), array('limit' => 100));
    //$warehouse_value[] = array(__('Общий склад'), 0, $data['warehouse']);
    if (is_array($dataWarehouse)) {
        foreach ($dataWarehouse as $val) {
            $warehouse_cdek_value[] = array($val['name'], $val['id'], $data['warehouse_cdek']);
            $warehouse_main_value[] = array($val['name'], $val['id'], $data['warehouse_main']);
        }
    }
    
    // Знак рубля
    if ($PHPShopSystem->getDefaultValutaIso() == 'RUB' or $PHPShopSystem->getDefaultValutaIso() == 'RUR')
        $currency = ' <span class="rubznak hidden-xs">p</span>';
    else
        $currency = $PHPShopSystem->getDefaultValutaCode();
    
    $Tab1 .= $PHPShopGUI->setField("Склад удаленный для списания", $PHPShopGUI->setSelect('warehouse_cdek_new', $warehouse_cdek_value, 300));
    $Tab1 .= $PHPShopGUI->setField("Склад локальный для списания", $PHPShopGUI->setSelect('warehouse_main_new', $warehouse_main_value, 300));
    $Tab1 .= $PHPShopGUI->setField('Дополнительный сбор с получателя', $PHPShopGUI->setInputText(null, 'fee_new', $data['fee'], 100,$currency));
    
    $Tab1 .= $PHPShopGUI->setField('Журнал операций', $PHPShopGUI->setCheckbox('log_new', 1, null, $data['log']));

    $Tab1 = $PHPShopGUI->setCollapse('Настройки', $Tab1);

    // Инструкция
    $Tab2 = $PHPShopGUI->loadLib('tab_info', $data, '../modules/' . $_GET['id'] . '/admpanel/');

    // Форма регистрации
    $Tab4 = $PHPShopGUI->setPay($serial = false, false, $data['version'], true);

    // Вывод формы закладки
    $PHPShopGUI->setTab(array("Основное", $Tab1, true), array("Инструкция", $Tab2), array("О Модуле", $Tab4));

    // Вывод кнопок сохранить и выход в футер
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "Применить", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// Обработка событий
$PHPShopGUI->getAction();

// Вывод формы при старте
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
