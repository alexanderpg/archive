ALTER TABLE `phpshop_modules_ozonseller_system` ADD `export` enum('0','1','2') NOT NULL default '0';
ALTER TABLE `phpshop_products` CHANGE `export_ozon_task_id` `export_ozon_task_id` BIGINT NULL DEFAULT '0';
ALTER TABLE `phpshop_products` CHANGE `export_ozon_id` `export_ozon_id` BIGINT NULL DEFAULT '0';
ALTER TABLE `phpshop_products` CHANGE `sku_ozon` `sku_ozon` BIGINT NULL DEFAULT '0';