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