/*650*/
ALTER TABLE `phpshop_products` ADD INDEX(`spec`);
ALTER TABLE `phpshop_products` ADD INDEX(`newtip`);
ALTER TABLE `phpshop_products` ADD INDEX(`yml`);
ALTER TABLE `phpshop_products` ADD INDEX(`parent_enabled`);
ALTER TABLE `phpshop_products` ADD INDEX(`sklad`);
ALTER TABLE `phpshop_products` ADD INDEX(`dop_cat`);
ALTER TABLE `phpshop_categories` ADD INDEX(`vid`);
ALTER TABLE `phpshop_categories` ADD INDEX(`skin_enabled`);
ALTER TABLE `phpshop_categories` ADD INDEX(`menu`);
ALTER TABLE `phpshop_categories` ADD INDEX(`tile`);
ALTER TABLE `phpshop_categories` ADD INDEX(`podcatalog_view`);
ALTER TABLE `phpshop_categories` ADD INDEX(`dop_cat`);

/*652*/
ALTER TABLE `phpshop_products` ADD `import_id` VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE `phpshop_exchanges_log` ADD `import_id` VARCHAR(64) NOT NULL DEFAULT '';

/*657*/
ALTER TABLE `phpshop_newsletter` ADD `recipients` text NULL;

/*658*/
CREATE TABLE IF NOT EXISTS `phpshop_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `time` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;