/*634*/
ALTER TABLE `phpshop_payment_systems` ADD `status` INT(11) DEFAULT '0';

/*636*/
ALTER TABLE `phpshop_products` ADD `external_code` varchar(64) DEFAULT '';

/*637*/
ALTER TABLE `phpshop_products` ADD INDEX(`external_code`);

/*639*/
UPDATE `phpshop_system` SET `kurs_beznal` = '0';
ALTER TABLE `phpshop_system` CHANGE `kurs_beznal` `shop_type` ENUM('0','1','2') NULL DEFAULT '0';
ALTER TABLE `phpshop_servers` ADD `shop_type` ENUM('0','1','2') NULL DEFAULT '0';

/*643*/
ALTER TABLE `phpshop_payment_systems` ADD `sum_max` float DEFAULT '0';
ALTER TABLE `phpshop_payment_systems` ADD `sum_min` float DEFAULT '0';
ALTER TABLE `phpshop_payment_systems` ADD `discount_max` float DEFAULT '0';
ALTER TABLE `phpshop_payment_systems` ADD `discount_min` float DEFAULT '0';

/*646*/
ALTER TABLE `phpshop_products` ADD `type` enum('1','2') DEFAULT '1';
ALTER TABLE `phpshop_menu` ADD `dop_cat` VARCHAR(255) DEFAULT '';
ALTER TABLE `phpshop_menu` ADD `mobile` enum('0','1') DEFAULT '0';

/*649*/
ALTER TABLE `phpshop_categories` ADD `podcatalog_view` enum('0','1') DEFAULT '0';
ALTER TABLE `phpshop_system` ADD `ai` BLOB NOT NULL;
ALTER TABLE `phpshop_search_base` ADD `url` VARCHAR(255) NOT NULL;
ALTER TABLE `phpshop_order_status` ADD `external_code` VARCHAR(64) NOT NULL;
ALTER TABLE `phpshop_delivery` ADD `external_code` VARCHAR(64) NOT NULL;
ALTER TABLE `phpshop_dialog` ADD `ai` ENUM('0','1') NOT NULL DEFAULT '0';