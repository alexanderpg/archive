/* 2.6 */
ALTER TABLE `phpshop_categories` ADD `category_avitoapi` varchar(255) NOT NULL;

CREATE TABLE IF NOT EXISTS `phpshop_modules_avitoapi_categories` (
`id` varchar(255) NOT NULL,
`name` varchar(255) NOT NULL,
`parent_to` varchar(255) NOT NULL,
`slug` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;

ALTER TABLE `phpshop_sort_categories` ADD `attribute_avitoapi` varchar(255) NOT NULL;