/*659*/
CREATE TABLE IF NOT EXISTS `phpshop_bot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `enabled` enum('0','1') NOT NULL DEFAULT '1',
  `description` varchar(255) NOT NULL,
  `date_block` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_2` (`name`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;