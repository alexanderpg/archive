
-- 
-- Структура таблицы `phpshop_notice`
-- 

CREATE TABLE `phpshop_notice` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `datas_start` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM ;

-- 
-- Обновление таблицы `phpshop_orders`
-- 

ALTER TABLE `phpshop_orders` ADD `statusi` tinyint(11) NOT NULL default '0';

-- 
-- Структура таблицы `phpshop_order_status`
-- 

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `color` varchar(64) NOT NULL default '',
  `sklad_action` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- 
-- Дамп данных таблицы `phpshop_order_status`
-- 

INSERT INTO `phpshop_order_status` VALUES (1, 'Аннулирован', 'red', '');
INSERT INTO `phpshop_order_status` VALUES (2, 'Выполняется', '#99cccc', '');
INSERT INTO `phpshop_order_status` VALUES (3, 'Доставляется', '#ff9900', '');
INSERT INTO `phpshop_order_status` VALUES (4, 'Выполнен', '#ccffcc', '1');

-- 
-- Обновление таблицы `phpshop_page`
-- 

ALTER TABLE `phpshop_page` ADD `title` varchar(255) NOT NULL default '';
ALTER TABLE `phpshop_page` ADD `enabled` enum('0','1') NOT NULL default '0'; 
ALTER TABLE `phpshop_page` ADD `secure` enum('0','1') NOT NULL default '0';

-- 
-- Обновление таблицы `phpshop_delivery`
-- 

ALTER TABLE `phpshop_delivery` ADD `price_null` float NOT NULL default '0'; 
ALTER TABLE `phpshop_delivery` ADD `price_null_enabled` enum('0','1') NOT NULL default '0';

-- 
-- Обновление таблицы `phpshop_categories`
-- 
ALTER TABLE `phpshop_categories` ADD `skin` VARCHAR( 64 ) NOT NULL;
ALTER TABLE `phpshop_categories` ADD `skin_enabled` enum('0','1') NOT NULL default '0';
ALTER TABLE `phpshop_categories` ADD `order_by` enum('1','2','3') NOT NULL default '3';
ALTER TABLE `phpshop_categories` ADD `order_to` enum('1','2') NOT NULL default '1';



-- 
-- Структура таблицы `phpshop_payment`
-- 

CREATE TABLE `phpshop_payment` (
  `uid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `sum` float NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `order` (`uid`)
) TYPE=MyISAM;


-- 
-- Обновление таблицы `phpshop_sort_categories `
-- 
ALTER TABLE `phpshop_sort_categories` ADD `description` varchar(255) NOT NULL default '';


-- 
-- Обновление таблицы `phpshop_page_categories`
-- 

ALTER TABLE `phpshop_page_categories` CHANGE `parent_to` `parent_to` INT( 11 ) DEFAULT '0' NOT NULL;

-- 
-- Проверка
-- 


