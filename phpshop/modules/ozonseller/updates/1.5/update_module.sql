ALTER TABLE `phpshop_modules_ozonseller_system` CHANGE `warehouse` `warehouse` TEXT NOT NULL;
ALTER TABLE `phpshop_modules_ozonseller_system` ADD `link` enum('0','1') NOT NULL default '0';

CREATE TABLE IF NOT EXISTS `phpshop_modules_ozonseller_export` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`date` int(11) NOT NULL,
`message` text NOT NULL,
`product_id` int(11) NOT NULL,
`product_name` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_modules_ozonseller_system` ADD `status_import` varchar(64) default '';
ALTER TABLE `phpshop_modules_ozonseller_system` ADD  `delivery` INT(11) NOT NULL default '0';
ALTER TABLE `phpshop_modules_ozonseller_system` ADD `create_products` enum('0','1') NOT NULL default '0';

CREATE TABLE IF NOT EXISTS `phpshop_modules_ozonseller_type` (
`id` int(11) NOT NULL,
`name` varchar(255) NOT NULL,
`parent_to` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_modules_ozonseller_system` ADD `log` enum('0','1') NOT NULL default '0';

ALTER TABLE `phpshop_modules_ozonseller_system` ADD `export` enum('0','1','2') NOT NULL default '0';

ALTER TABLE `phpshop_products` CHANGE `export_ozon_task_id` `export_ozon_task_id` BIGINT NULL DEFAULT '0';
ALTER TABLE `phpshop_products` CHANGE `export_ozon_id` `export_ozon_id` BIGINT NULL DEFAULT '0';
ALTER TABLE `phpshop_products` CHANGE `sku_ozon` `sku_ozon` BIGINT NULL DEFAULT '0';