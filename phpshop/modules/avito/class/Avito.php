<?php

/**
 * Библиотека работы с Avito API
 * @author PHPShop Software
 * @version 1.6
 * @package PHPShopModules
 * @todo https://www.avito.ru/autoload/documentation/templates/111801?fileFormat=xml
 */
class Avito {

    public $avitoTypes;
    public $avitoSubTypes;
    public $avitoCategories;
    private static $options;

    public static function getAvitoCategories($xmlPriceId = null, $currentCategory = null) {
        $orm = new PHPShopOrm('phpshop_modules_avito_categories');

        $categories = [];
        if ((int) $currentCategory > 0) {
            $category = $orm->getOne(['xml_price_id'], ['id' => sprintf('="%s"', $currentCategory)]);
            $xmlPriceId = $category['xml_price_id'];
        }

        if ((int) $xmlPriceId > 0) {
            $categories = $orm->getList(['*'], ['xml_price_id' => '="' . (int) $xmlPriceId . '"']);
        }

        $result = [['Не выбрано', 0, $currentCategory]];

        foreach ($categories as $category) {
            $result[] = [$category['name'], $category['id'], $currentCategory];
        }

        return $result;
    }

    public static function getCategoryTypes($category = null, $currentType = null) {
        $orm = new PHPShopOrm('phpshop_modules_avito_types');

        $types = [];
        if ((int) $category > 0) {
            $types = $orm->getList(['*'], ['category_id' => '="' . $category . '"']);
        }

        $result = [['Не выбрано', 0, $currentType]];
        foreach ($types as $type) {
            $result[] = [$type['name'], $type['id'], $currentType];
        }

        return $result;
    }

    public static function getCategorySubTypes($currentSubType = null, $type_id = 0) {
        $orm = new PHPShopOrm('phpshop_modules_avito_subtypes');

        $result = [['Не выбрано', 0, $currentSubType]];
        foreach ($orm->getList(['*'], ['type_id' => '=' . (int) $type_id]) as $subtype) {
            $result[] = [$subtype['name'], $subtype['id'], $currentSubType];
        }

        return $result;
    }

    public static function getAvitoCategoryTypes($currentCategory) {
        $orm = new PHPShopOrm('phpshop_modules_avito_categories');
        $xmlOrm = new PHPShopOrm('phpshop_modules_avito_xml_prices');

        $category = $orm->getOne(['xml_price_id'], ['id' => sprintf('="%s"', $currentCategory)]);
        $xmlPrices = $xmlOrm->getList();

        $result = [[__('Не выбрано'), 0, $currentCategory]];
        foreach ($xmlPrices as $xmlPrice) {
            $result[] = [$xmlPrice['name'], $xmlPrice['id'], $category['xml_price_id']];
        }

        return $result;
    }

    public static function getAdTypes($currentAdType) {
        return [
            [__('Товар приобретен на продажу'), 'Товар приобретен на продажу', $currentAdType],
            [__('Товар от производителя'), 'Товар от производителя', $currentAdType]
        ];
    }

    /**
     * Название категории в Авито.
     * @param int $categoryId
     * @return string|null
     */
    public function getCategoryById($categoryId) {
        if (!is_array($this->avitoCategories)) {
            $orm = new PHPShopOrm('phpshop_modules_avito_categories');
            $categories = $orm->getList();
            foreach ($categories as $category) {
                $this->avitoCategories[$category['id']] = $category['name'];
            }
        }

        if (isset($this->avitoCategories[$categoryId])) {
            return $this->avitoCategories[$categoryId];
        }

        return null;
    }

    /**
     * @param int $typeId
     * @return string|null
     */
    public function getAvitoType($typeId) {
        if (!is_array($this->avitoTypes)) {
            $orm = new PHPShopOrm('phpshop_modules_avito_types');
            $types = $orm->getList();
            foreach ($types as $type) {
                $this->avitoTypes[$type['id']] = $type['name'];
            }
        }

        if (isset($this->avitoTypes[$typeId])) {
            return $this->avitoTypes[$typeId];
        }

        return null;
    }

    public function getAvitoSubType($subTypeId) {
        if (!is_array($this->avitoSubTypes)) {
            $orm = new PHPShopOrm('phpshop_modules_avito_subtypes');
            $subTypes = $orm->getList();
            foreach ($subTypes as $subType) {
                $this->avitoSubTypes[$subType['id']] = $subType['name'];
            }
        }

        if (isset($this->avitoSubTypes[$subTypeId])) {
            return $this->avitoSubTypes[$subTypeId];
        }

        return null;
    }

    public static function getListingFee($currentListingFee) {
        return array(
            array('Package', 'Package', $currentListingFee),
            array('PackageSingle', 'PackageSingle', $currentListingFee),
            array('Single', 'Single', $currentListingFee),
        );
    }

    public static function getAdStatuses($currentStatus) {
        return array(
            array(__('Обычное объявление') . ' (Free)', 'Free', $currentStatus),
            array('Premium', 'Premium', $currentStatus),
            array('VIP', 'VIP', $currentStatus),
            array('PushUp', 'PushUp', $currentStatus),
            array('Highlight', 'Highlight', $currentStatus),
            array('TurboSale', 'TurboSale', $currentStatus),
            array('x2_1', 'x2_1', $currentStatus),
            array('x2_7', 'x2_7', $currentStatus),
            array('x5_1', 'x5_1', $currentStatus),
            array('x5_7', 'x5_7', $currentStatus),
            array('x10_1', 'x10_1', $currentStatus),
            array('x10_7', 'x10_7', $currentStatus)
        );
    }

    public static function getTierTypes($currentType = null) {
        return [
            ['Не выбрано', '', $currentType],
            ['Всесезонные', 'Всесезонные', $currentType],
            ['Летние', 'Летние', $currentType],
            ['Зимние нешипованные', 'Зимние нешипованные', $currentType],
            ['Зимние шипованные', 'Зимние шипованные', $currentType]
        ];
    }

    public static function getWheelAxle($currentAxle = null) {
        return [
            ['Не выбрано', '', $currentAxle],
            ['Задняя', 'Задняя', $currentAxle],
            ['Любая', 'Любая', $currentAxle],
            ['Передняя', 'Передняя', $currentAxle]
        ];
    }

    public static function getRimTypes($currentRimType = null) {
        return [
            ['Не выбрано', '', $currentRimType],
            ['Кованые', 'Кованые', $currentRimType],
            ['Литые', 'Литые', $currentRimType],
            ['Штампованные', 'Штампованные', $currentRimType],
            ['Спицованные', 'Спицованные', $currentRimType],
            ['Сборные', 'Сборные', $currentRimType],
        ];
    }

    public static function getTireSectionWidth($currentSectionWidth = null) {
        return [
            ['Не выбрано', '', $currentSectionWidth],
            ['2.5', '2.5', $currentSectionWidth],
            ['2.75', '2.75', $currentSectionWidth],
            ['3', '3', $currentSectionWidth],
            ['3.5', '3.5', $currentSectionWidth],
            ['4', '4', $currentSectionWidth],
            ['4.1', '4.1', $currentSectionWidth],
            ['4.5', '4.5', $currentSectionWidth],
            ['4.6', '4.6', $currentSectionWidth],
            ['60', '60', $currentSectionWidth],
            ['70', '70', $currentSectionWidth],
            ['80', '80', $currentSectionWidth],
            ['90', '90', $currentSectionWidth],
            ['100', '100', $currentSectionWidth],
            ['110', '110', $currentSectionWidth],
            ['120', '120', $currentSectionWidth],
            ['130', '130', $currentSectionWidth],
            ['140', '140', $currentSectionWidth],
            ['150', '150', $currentSectionWidth],
            ['160', '160', $currentSectionWidth],
            ['170', '170', $currentSectionWidth],
            ['180', '180', $currentSectionWidth],
            ['190', '190', $currentSectionWidth],
            ['200', '200', $currentSectionWidth],
            ['210', '210', $currentSectionWidth],
            ['220', '220', $currentSectionWidth],
            ['230', '230', $currentSectionWidth],
            ['240', '240', $currentSectionWidth],
            ['250', '250', $currentSectionWidth],
            ['260', '260', $currentSectionWidth],
            ['270', '270', $currentSectionWidth],
            ['280', '280', $currentSectionWidth],
            ['290', '290', $currentSectionWidth],
            ['300', '300', $currentSectionWidth],
            ['310', '310', $currentSectionWidth],
            ['320', '320', $currentSectionWidth],
            ['330', '330', $currentSectionWidth],
            ['340', '340', $currentSectionWidth],
            ['350', '350', $currentSectionWidth],
            ['360', '360', $currentSectionWidth],
            ['370', '370', $currentSectionWidth],
            ['380', '380', $currentSectionWidth],
            ['390', '390', $currentSectionWidth]
        ];
    }

    public static function getTireAspectRatio($currentTireAspectRatio = null) {
        return [
            ['Не выбрано', '', $currentTireAspectRatio],
            ['25', '25', $currentTireAspectRatio],
            ['30', '30', $currentTireAspectRatio],
            ['35', '35', $currentTireAspectRatio],
            ['40', '40', $currentTireAspectRatio],
            ['45', '45', $currentTireAspectRatio],
            ['50', '50', $currentTireAspectRatio],
            ['55', '55', $currentTireAspectRatio],
            ['60', '60', $currentTireAspectRatio],
            ['65', '65', $currentTireAspectRatio],
            ['70', '70', $currentTireAspectRatio],
            ['75', '75', $currentTireAspectRatio],
            ['80', '80', $currentTireAspectRatio],
            ['85', '85', $currentTireAspectRatio],
            ['90', '90', $currentTireAspectRatio],
            ['95', '95', $currentTireAspectRatio],
            ['100', '100', $currentTireAspectRatio],
            ['105', '105', $currentTireAspectRatio],
            ['110', '110', $currentTireAspectRatio],
            ['Другое', 'Другое', $currentTireAspectRatio]
        ];
    }

    public static function getConditions($currentCondition) {
        return [
            ['Новый товар', 'Новое', $currentCondition],
            ['Подержанный', 'Б/у', $currentCondition]
        ];
    }

    public static function SheetMaterialsSubType($current) {
        return [
            ['Гипсокартон', 'Гипсокартон', $current],
        ];
    }

    public static function SheetMaterialsType($current) {
        return [
            ['ГКЛ', 'ГКЛ', $current],
            ['ГВЛ', 'ГВЛ', $current],
        ];
    }

    public static function ConstructionBlocksType($current) {
        return [
            ['Газобетон', 'Газобетон', $current],
            ['Газосиликат', 'Газосиликат', $current],
            ['Пенобетон', 'Пенобетон', $current],
        ];
    }

    public static function Walltype($current) {
        return [
            ['Блоки для строительства', 'Блоки для строительства', $current],
            ['Кирпич', 'Кирпич', $current],
        ];
    }

    public static function SizeGazosilikat($current) {
        return [
            ['600 x 75 x 250 мм', '600 x 75 x 250 мм', $current],
            ['600 x 100 x 250 мм', '600 x 100 x 250 мм', $current],
            ['600 x 50 x 250 мм', '600 x 50 x 250 мм', $current],
            ['600 x 200 x 300 мм', '600 x 200 x 300 мм', $current],
            ['600 x 150 x 250 мм', '600 x 150 x 250 мм', $current],
            ['600 x 250 x 300 мм', '600 x 250 x 300 мм', $current],
            ['600 x 400 x 250 мм', '600 x 400 x 250 мм', $current],
            ['600 x 200 x 250 мм', '600 x 200 x 250 мм', $current],
        ];
    }

    public static function BrandGazosilikat($current) {
        return [
            ['Bonolit', 'Bonolit', $current],
        ];
    }

    public static function PurposeBrick($current) {
        return [
            ['Строительный', 'Строительный', $current],
            ['Облицовочный', 'Облицовочный', $current],
            ['Огнеупорный', 'Огнеупорный', $current],
        ];
    }

    public static function BrickColor($current) {
        return [
            ['Красный', 'Красный', $current],
            ['Бежевый', 'Бежевый', $current],
            ['Белый', 'Белый', $current],
            ['Коричневый', 'Коричневый', $current],
            ['Жёлтый', 'Жёлтый', $current],
        ];
    }

    public static function BrickSize($current) {
        return [
            ['250 x 120 x 65 мм', '250 x 120 x 65 мм', $current],
            ['250 x 120 x 140 мм', '250 x 120 x 140 мм', $current],
        ];
    }

    public static function HollownessBrick($current) {
        return [
            ['Пустотелый', 'Пустотелый', $current],
            ['Полнотелый', 'Полнотелый', $current],
        ];
    }

    public static function MixesType($current) {
        return [
            ['Бетон', 'Бетон', $current],
            ['Штукатурка', 'Штукатурка', $current],
            ['Грунтовка', 'Грунтовка', $current],
            ['Смеси для пола', 'Смеси для пола', $current],
            ['Шпаклёвка', 'Шпаклёвка', $current],
            ['Цемент, пескобетон', 'Цемент, пескобетон', $current],
            ['Кладочная смесь и монтажный клей', 'Кладочная смесь и монтажный клей', $current],
            ['Затирки', 'Затирки', $current],
            ['Добавки для растворов', 'Добавки для растворов', $current],
            ['Другое', 'Другое', $current],
        ];
    }

    public static function ConcreteGrade($current) {
        return [
            ['м100', 'м100', $current],
            ['м150', 'м150', $current],
            ['м200', 'м200', $current],
            ['м300', 'м300', $current],
            ['м400', 'м400', $current],
            ['м500', 'м500', $current],
            ['м600', 'м600', $current],
            ['м700', 'м700', $current],
            ['м800', 'м800', $current],
            ['м900', 'м900', $current],
        ];
    }

    public static function ProductKind($current) {
        return [
            ['Цемент', 'Цемент', $current],
            ['Пескобетон', 'Пескобетон', $current],
        ];
    }

    public static function TypeBrick($current) {
        return [
            ['Керамический', 'Керамический', $current],
            ['Силикатный', 'Силикатный', $current],
            ['Шамотный', 'Шамотный', $current],
            ['Гиперпрессованный', 'Гиперпрессованный', $current],
            ['Клинкерный', 'Клинкерный', $current],
            ['Бетонный', 'Бетонный', $current],
        ];
    }

    public static function SpareAudioSize($current) {
        return [
            ['1 DIN', '1 DIN', $current],
            ['2 DIN', '2 DIN', $current],
            ['Штатное место', 'Штатное место', $current],
        ];
    }

    public static function SpareAudioAndroidOS($current) {
        return [
            ['Да', 'Да', $current],
            ['Нет', 'Нет', $current],
        ];
    }

    public static function SpareAudioRAM($current) {
        return [
            ['1', '1', $current],
            ['2', '2', $current],
            ['3', '3', $current],
            ['4', '4', $current],
            ['6', '6', $current],
            ['8', '8', $current],
            ['12', '12', $current],
        ];
    }

    public static function SpareAudioROM($current) {
        return [
            ['16', '16', $current],
            ['32', '32', $current],
            ['64', '64', $current],
            ['128', '128', $current],
            ['256', '256', $current],
        ];
    }

    public static function SpareAudioCPU($current) {
        return [
            ['4', '4', $current],
            ['8', '8', $current],
        ];
    }

    public static function SpareAudioAudioType($current) {
        return [
            ['Эстрадная', 'Эстрадная', $current],
            ['Компонентная', 'Компонентная', $current],
            ['Коаксиальная', 'Коаксиальная', $current],
            ['Среднечастотная', 'Среднечастотная', $current],
            ['Широкополосная', 'Широкополосная', $current],
            ['Корпусная', 'Корпусная', $current],
            ['Сабвуфер', 'Сабвуфер', $current],
            ['Твитер', 'Твитер', $current],
        ];
    }

    public static function SpareAudioSizeAkust($current) {
        return [
            ['2 см (0.8 дюйм.)', '2 см (0.8 дюйм.)', $current],
            ['2.5 см (1 дюйм.)', '2.5 см (1 дюйм.)', $current],
            ['3.8 см (1.5 дюйм.)', '3.8 см (1.5 дюйм.)', $current],
            ['4.3 см (1.69 дюйм.)', '4.3 см (1.69 дюйм.)', $current],
            ['5 см (2 дюйм.)', '5 см (2 дюйм.)', $current],
            ['7.6 см (3 дюйм.)', '7.6 см (3 дюйм.)', $current],
            ['8.7 см (3.5 дюйм.)', '8.7 см (3.5 дюйм.)', $current],
            ['9.5 см (3.7 дюйм.)', '9.5 см (3.7 дюйм.)', $current],
            ['10 см (4 дюйм.)', '10 см (4 дюйм.)', $current],
            ['13 см (5 дюйм.)', '13 см (5 дюйм.)', $current],
            ['16 см (6 дюйм.)', '16 см (6 дюйм.)', $current],
            ['16.5 см (6.5 дюйм.)', '16.5 см (6.5 дюйм.)', $current],
            ['17 см (6.75 дюйм.)', '17 см (6.75 дюйм.)', $current],
            ['18 см (7 дюйм.)', '18 см (7 дюйм.)', $current],
            ['20 см (8 дюйм.)', '20 см (8 дюйм.)', $current],
            ['23 см (9 дюйм.)', '23 см (9 дюйм.)', $current],
            ['25 см (10 дюйм.)', '25 см (10 дюйм.)', $current],
            ['30 см (12 дюйм.)', '30 см (12 дюйм.)', $current],
            ['33 см (13 дюйм.)', '33 см (13 дюйм.)', $current],
            ['38 см (15 дюйм.)', '38 см (15 дюйм.)', $current],
            ['46 см (18 дюйм.)', '46 см (18 дюйм.)', $current],
            ['овальный 10x16 см (4x6 дюйм.)', 'овальный 10x16 см (4x6 дюйм.)', $current],
            ['овальный 12.7x17.78 см (5x7 дюйм.)', 'овальный 12.7x17.78 см (5x7 дюйм.)', $current],
            ['овальный 15x20 см (6x8 дюйм.)', 'овальный 15x20 см (6x8 дюйм.)', $current],
            ['овальный 15x23 см (6x9 дюйм.)', 'овальный 15x23 см (6x9 дюйм.)', $current],
            ['овальный 18x25 см (7x10 дюйм.)', 'овальный 18x25 см (7x10 дюйм.)', $current],
        ];
    }

    public static function SpareAudioVoiceCoil($current) {
        return [
            ['1', '1', $current],
            ['2', '2', $current],
            ['3', '3', $current],
            ['4', '4', $current],
            ['5', '5', $current],
        ];
    }

    public static function SpareAudioImpedance($current) {
        return [
            ['1 x 1', '1 x 1', $current],
            ['2', '2', $current],
            ['2 x 2', '2 x 2', $current],
            ['3.4', '3.4', $current],
            ['3.6', '3.6', $current],
            ['3.7', '3.7', $current],
            ['4', '4', $current],
            ['4 x 4', '4 x 4', $current],
            ['5', '5', $current],
            ['6', '6', $current],
            ['7', '7', $current],
            ['8', '8', $current],
        ];
    }

    public static function SpareAudioDesign($current) {
        return [
            ['Видеорегистратор', 'Видеорегистратор', $current],
            ['Видеорегистратор-зеркало', 'Видеорегистратор-зеркало', $current],
            ['Штатный видеорегистратор', 'Штатный видеорегистратор', $current],
        ];
    }

    public static function SpareAudioCamsNumber($current) {
        return [
            ['1', '1', $current],
            ['2', '2', $current],
            ['3', '3', $current],
            ['4', '4', $current],
        ];
    }

    public static function SpareAudioResolution($current) {
        return [
            ['272x340', '272x340', $current],
            ['320x240', '320x240', $current],
            ['640x480', '640x480', $current],
            ['720x480', '720x480', $current],
            ['1024x768', '1024x768', $current],
            ['1200x640', '1200x640', $current],
            ['1280x720 (НD)', '1280x720 (НD)', $current],
            ['1280x960', '1280x960', $current],
            ['1440x1080', '1440x1080', $current],
            ['1728x1296', '1728x1296', $current],
            ['1920x720', '1920x720', $current],
            ['1920x1080 (Full НD)', '1920x1080 (Full НD)', $current],
            ['2048x1536', '2048x1536', $current],
            ['2048х1080', '2048х1080', $current],
            ['2304х1296 (Super НD)', '2304х1296 (Super НD)', $current],
            ['2312x1080', '2312x1080', $current],
            ['2340х1080', '2340х1080', $current],
            ['2560x1080', '2560x1080', $current],
            ['2560x1440 (2К)', '2560x1440 (2К)', $current],
            ['2560x1440', '2560x1440', $current],
            ['2560x1600', '2560x1600', $current],
            ['2592x1944', '2592x1944', $current],
            ['2720x2720', '2720x2720', $current],
            ['2880x2160', '2880x2160', $current],
            ['3840x2160 (4K)', '3840x2160 (4K)', $current],
        ];
    }
    
    public static function SpareAudioAmplifierType($current) {
        return [
            ['Универсальный', 'Универсальный', $current],
            ['Штатный', 'Штатный', $current],
        ];
    }
    
    public static function SpareAudioChannelsNumber($current) {
        return [
            ['1', '1', $current],
            ['2', '2', $current],
            ['3', '3', $current],
            ['4', '4', $current],
            ['5', '5', $current],
            ['6', '6', $current],
            ['7', '7', $current],
            ['8', '8', $current],
        ];
    }
    

    public static function getOption($key) {
        if (!is_array(self::$options)) {
            $PHPShopOrm = new PHPShopOrm('phpshop_modules_avito_system');
            self::$options = $PHPShopOrm->select();
        }

        if (isset(self::$options[$key])) {
            return self::$options[$key];
        }

        return null;
    }

}
