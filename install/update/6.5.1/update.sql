/*652*/
ALTER TABLE `phpshop_products` ADD `import_id` VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE `phpshop_exchanges_log` ADD `import_id` VARCHAR(64) NOT NULL DEFAULT '';

/*657*/
ALTER TABLE `phpshop_newsletter` ADD `recipients` text NULL;