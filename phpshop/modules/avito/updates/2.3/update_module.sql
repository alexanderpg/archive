ALTER TABLE `phpshop_modules_avito_system` ADD `transition` enum('0','1') NOT NULL default '0';

/* 2.5 */
ALTER TABLE `phpshop_modules_avito_system` ADD `map_url` varchar(255) DEFAULT '';