

ALTER TABLE `phpshop_products` ADD `items` int(11) NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `weight` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price2` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price3` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price4` float NOT NULL default '0';
ALTER TABLE `phpshop_products` ADD `price5` float NOT NULL default '0';





-- 
-- Структура таблицы `phpshop_foto`
-- 

CREATE TABLE `phpshop_foto` (
  `id` int(11) NOT NULL auto_increment,
  `parent` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `info` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM ;


-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_comment`
-- 

CREATE TABLE `phpshop_comment` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `datas` varchar(32) default NULL,
  `name` varchar(32) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `content` text,
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM;




-- 
-- Проверка
-- 



-- 
-- Обновление таблицы `phpshop_page_categories`
-- 

ALTER TABLE `phpshop_page_categories` CHANGE `parent_to` `parent_to` INT( 11 ) DEFAULT '0' NOT NULL;


-- 
-- Проверка
-- 


