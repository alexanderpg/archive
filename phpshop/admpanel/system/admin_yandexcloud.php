<?php

$TitlePage = __("Настройка интеграции с Yandex Cloud");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// Стартовый вид
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm, $PHPShopBase, $hideCatalog, $hideSite, $PHPShopSystem;

    // Выборка
    $data = $PHPShopOrm->select();
    $option = unserialize($data['ai']);

    // Размер названия поля
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./js/jquery.waypoints.min.js', './system/gui/system.gui.js');

    $PHPShopGUI->setActionPanel($TitlePage, false, array('Сохранить'));

    $yandexgpt_model_value[] = array('YandexGPT Lite', 'yandexgpt-lite/latest', $option['yandexgpt_model']);
    $yandexgpt_model_value[] = array('YandexGPT Pro', 'yandexgpt/latest', $option['yandexgpt_model']);

    // Настройки
    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Облако', $PHPShopGUI->setField('Идентификатор', $PHPShopGUI->setInputText(null, 'option[yandexgpt_id]', $option['yandexgpt_id'], 300))
    );

    // AI
    $yandexgpt_temperature_value[] = array('0', '0', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.1', '0.1', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.2', '0.2', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.3', '0.3', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.4', '0.4', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.5', '0.5', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.6', '0.6', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.7', '0.7', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.8', '0.8', $option['yandexgpt_temperature']);
    $yandexgpt_temperature_value[] = array('0.9', '0.9', $option['yandexgpt_temperature']);

    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Искуственный интеллект', $PHPShopGUI->setField('Токен', $PHPShopGUI->setInputText(false, 'option[yandexgpt_token]', $option['yandexgpt_token'], 375, '<a target="_blank" href="https://oauth.yandex.ru/authorize?response_type=token&client_id=1a6990aa636648e9b2ef855fa7bec2fb">' . __('Получить') . '</a>')) .
            $PHPShopGUI->setField('Креативность ответа', $PHPShopGUI->setSelect('option[yandexgpt_temperature]', $yandexgpt_temperature_value, 100)) .
            $PHPShopGUI->setField('Конфигурация', $PHPShopGUI->setSelect('option[yandexgpt_model]', $yandexgpt_model_value, 200)) .
            $PHPShopGUI->setField(null, $PHPShopGUI->setCheckbox('option[yandexgpt_seo]', 1, 'Включить помощь AI в ручном заполнении данных', $option['yandexgpt_seo'])) .
            $PHPShopGUI->setField(null, $PHPShopGUI->setCheckbox('option[yandexgpt_seo_import]', 1, 'Включить помощь AI в импорте данных', $option['yandexgpt_seo_import']))
    );

    if (empty($option['yandexgpt_chat_role']))
        $option['yandexgpt_chat_role'] = 'Ты - консультант по продажам на сайте ' . $_SERVER['SERVER_NAME'] . '. Род деятельности -  ' . $PHPShopSystem->getParam('descrip') . ', телефон - ' . $PHPShopSystem->getParam('tel') . ', время работы - ' . $PHPShopSystem->getSerilizeParam("bank.org_time") . ', адрес - ' . $PHPShopSystem->getSerilizeParam("bank.org_adres") . '. Тебя зовут Чат-бот.  Напиши ответ с учётом вида текста и заданной темы.';

    if (empty($option['yandexgpt_avatar_dialog']))
        $option['yandexgpt_avatar_dialog'] = '/phpshop/lib/templates/chat/ai.png';



    if (empty($option['yandexgpt_day_dialog']))
        $option['yandexgpt_day_dialog'] = 1;

    if (empty($option['yandexgpt_time_from_dialog']) and empty($option['yandexgpt_time_until_dialog'])) {
        $option['yandexgpt_time_until_dialog'] = 8;
        $option['yandexgpt_time_from_dialog'] = 20;
    }

    // Чат
    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Чат', $PHPShopGUI->setField(null, $PHPShopGUI->setCheckbox('option[yandexgpt_chat_enabled]', 1, 'Включить AI для чата в нерабочее время', $option['yandexgpt_chat_enabled'])) .
            $PHPShopGUI->setField("Заголовок чата", $PHPShopGUI->setInputText(null, "option[yandexgpt_title_dialog]", $option['yandexgpt_title_dialog'], 300)) .
            $PHPShopGUI->setField("Аватар AI в чате", $PHPShopGUI->setIcon($option['yandexgpt_avatar_dialog'], "yandexgpt_avatar_dialog", false, array('load' => false, 'server' => true))) .
            $PHPShopGUI->setField('Задача для ответа', $PHPShopGUI->setTextarea('option[yandexgpt_chat_role]', $option['yandexgpt_chat_role'], false, false, 100))
    );

    // Яндекс Поиск
    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Поиск', $PHPShopGUI->setField("Токен", $PHPShopGUI->setInputText(null, "option[yandexsearch_token]", $option['yandexsearch_token'], 300)) .
            $PHPShopGUI->setField(null, $PHPShopGUI->setCheckbox('option[yandexsearch_enabled]', 1, 'Включить поиск ответов для чата на сайте через Яндекс', $option['yandexsearch_enabled']) . '<br>' . $PHPShopGUI->setCheckbox('option[yandexsearch_site_enabled]', 1, 'Использовать поиск через Яндекс на сайте, вместо стандартного поиска', $option['yandexsearch_site_enabled']))
    );

    // SEO каталоги
    if (empty($option['yandexgpt_catalog_description_role']))
        $option['yandexgpt_catalog_description_role'] = 'Ты - seo оптимизатор. Создай описание каталога товаров для Meta Description. Верни только текст.';

    if (empty($option['yandexgpt_catalog_title_role']))
        $option['yandexgpt_catalog_title_role'] = 'Ты - seo оптимизатор. Создай описание каталога товаров для Meta Title. Верни только текст.';

    if (empty($option['yandexgpt_catalog_content_role']))
        $option['yandexgpt_catalog_content_role'] = 'Ты - seo оптимизатор. Создай описание каталога товаров.';


    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Каталоги', $PHPShopGUI->setField('Задача для создания Meta Title', $PHPShopGUI->setTextarea('option[yandexgpt_catalog_title_role]', $option['yandexgpt_catalog_title_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания Meta Description', $PHPShopGUI->setTextarea('option[yandexgpt_catalog_description_role]', $option['yandexgpt_catalog_description_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания описания', $PHPShopGUI->setTextarea('option[yandexgpt_catalog_content_role]', $option['yandexgpt_catalog_content_role'], false, false, 100))
    );

    // SEO товаров
    if (empty($option['yandexgpt_product_descrip_role']))
        $option['yandexgpt_product_descrip_role'] = 'Ты - seo оптимизатор. Создай описание товара для Meta Description. Верни только текст.';

    if (empty($option['yandexgpt_product_title_role']))
        $option['yandexgpt_product_title_role'] = 'Ты - seo оптимизатор. Создай описание товара для Meta Title. Верни только текст.';

    if (empty($option['yandexgpt_product_content_role']))
        $option['yandexgpt_product_content_role'] = 'Ты - seo оптимизатор. Создай подробное описание товара.';

    if (empty($option['yandexgpt_product_description_role']))
        $option['yandexgpt_product_description_role'] = 'Ты - seo оптимизатор. Создай краткое описание товара.';

    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Товары', $PHPShopGUI->setField('Задача для создания Meta Title', $PHPShopGUI->setTextarea('option[yandexgpt_product_title_role]', $option['yandexgpt_product_title_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания Meta Description', $PHPShopGUI->setTextarea('option[yandexgpt_product_descrip_role]', $option['yandexgpt_product_descrip_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания подробного описания', $PHPShopGUI->setTextarea('option[yandexgpt_product_content_role]', $option['yandexgpt_product_content_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания краткого описания', $PHPShopGUI->setTextarea('option[yandexgpt_product_description_role]', $option['yandexgpt_product_description_role'], false, false, 100))
    );


    // SEO новости
    if (empty($option['yandexgpt_news_content_role']))
        $option['yandexgpt_news_content_role'] = 'Ты - seo оптимизатор. Создай новость.';

    if (empty($option['yandexgpt_news_description_role']))
        $option['yandexgpt_news_description_role'] = 'Ты - seo оптимизатор. Создай анонс новости.';

    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Новости', $PHPShopGUI->setField('Задача для создания новости', $PHPShopGUI->setTextarea('option[yandexgpt_news_content_role]', $option['yandexgpt_news_content_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания анонса', $PHPShopGUI->setTextarea('option[yandexgpt_news_description_role]', $option['yandexgpt_news_description_role'], false, false, 100))
    );

    // SEO страницы
    if (empty($option['yandexgpt_page_descrip_role']))
        $option['yandexgpt_page_descrip_role'] = 'Ты - seo оптимизатор. Создай описание статьи для Meta Description. Верни только текст.';

    if (empty($option['yandexgpt_page_title_role']))
        $option['yandexgpt_page_title_role'] = 'Ты - seo оптимизатор. Создай описание статьи для Meta Title. Верни только текст.';

    if (empty($option['yandexgpt_page_content_role']))
        $option['yandexgpt_page_content_role'] = 'Ты - seo оптимизатор. Создай статью.';

    if (empty($option['yandexgpt_page_description_role']))
        $option['yandexgpt_page_description_role'] = 'Ты - seo оптимизатор. Создай анонс статьи.';

    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Страницы', $PHPShopGUI->setField('Задача для создания Meta Title', $PHPShopGUI->setTextarea('option[yandexgpt_page_title_role]', $option['yandexgpt_page_title_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания Meta Description', $PHPShopGUI->setTextarea('option[yandexgpt_page_descrip_role]', $option['yandexgpt_page_descrip_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания страницы', $PHPShopGUI->setTextarea('option[yandexgpt_page_content_role]', $option['yandexgpt_page_content_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для создания анонса', $PHPShopGUI->setTextarea('option[yandexgpt_page_description_role]', $option['yandexgpt_page_description_role'], false, false, 100))
    );

    // Отзывы
    if (empty($option['yandexgpt_gbook_review_role']))
        $option['yandexgpt_gbook_review_role'] = 'Ты - seo оптимизатор. Создай отзыв о работе сайта.';

    if (empty($option['yandexgpt_gbook_answer_role']))
        $option['yandexgpt_gbook_answer_role'] = 'Ты - seo оптимизатор. Создай ответ на отзыв о работе сайта.';

    if (empty($option['yandexgpt_product_comment_role']))
        $option['yandexgpt_product_comment_role'] = 'Ты - seo оптимизатор. Создай отзыв о товаре.';


    $PHPShopGUI->_CODE .= $PHPShopGUI->setCollapse('Отзывы и комментарии', $PHPShopGUI->setField('Задача для создания отзыва о сайте', $PHPShopGUI->setTextarea('option[yandexgpt_gbook_review_role]', $option['yandexgpt_gbook_review_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для ответа на отзыв о сайте', $PHPShopGUI->setTextarea('option[yandexgpt_gbook_answer_role]', $option['yandexgpt_gbook_answer_role'], false, false, 100)) .
            $PHPShopGUI->setField('Задача для ответа на комментарий о товаре', $PHPShopGUI->setTextarea('option[yandexgpt_product_comment_role]', $option['yandexgpt_product_comment_role'], false, false, 100))
    );

    if (empty($_SESSION['yandexcloud']) or $_SESSION['yandexcloud'] < time()) {
        $PHPShopGUI->_CODE = $PHPShopGUI->setAlert('Раздел настройки интеграции с <b>Yandex Cloud</b> доступен только по <a class="btn btn-sm btn-info" href="https://www.phpshop.ru/order/order.html#subscription?from=' . $_SERVER['SERVER_NAME'] . '" target="_blank"><span class="glyphicon glyphicon-ruble"></span> Платной подписке</a>', 'info', true);

        $option['yandexgpt_seo']=0;
        $option['yandexgpt_seo_import']=0;
        $option['yandexgpt_chat_enabled']=0;
        $option['yandexsearch_site_enabled']=0;
        $PHPShopOrm->update(['ai_new'=>serialize($option)]);
    }

    // Запрос модуля на закладку
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // Вывод кнопок сохранить и выход в футер
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "Сохранить", "right", 70, "", "but", "actionUpdate.system.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "Применить", "right", 80, "", "but", "actionSave.system.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $sidebarleft[] = array('title' => 'Категории', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './system/'));
    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // Футер
    $PHPShopGUI->Compile(2);
    return true;
}

/**
 * Экшен сохранения
 */
function actionSave() {

    // Сохранение данных
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// Функция обновления
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // Иконка
    $_POST['option']['yandexgpt_avatar_dialog'] = $_POST['yandexgpt_avatar_dialog'];

    // Выборка
    $data = $PHPShopOrm->select();
    $option = unserialize($data['ai']);

    // Корректировка пустых значений
    $PHPShopOrm->updateZeroVars('option.yandexgpt_chat_enabled', 'option.yandexsearch', 'option.yandexsearch_site_enabled', 'option.yandexgpt_seo', 'option.yandexgpt_seo_import');

    if (is_array($_POST['option']))
        foreach ($_POST['option'] as $key => $val)
            $option[$key] = $val;

    $_POST['ai_new'] = serialize($option);


    // Перехват модуля
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));


    return array("success" => $action);
}

// Обработка событий
$PHPShopGUI->getAction();
?>