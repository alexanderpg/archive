

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------
-- 
-- Структура таблицы `phpshop_notice`
-- 

CREATE TABLE `phpshop_notice` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `datas_start` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- Структура таблицы `phpshop_payment`
-- 

CREATE TABLE `phpshop_payment` (
  `uid` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `sum` float NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `order` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;
   

-- 
-- Структура таблицы `phpshop_order_status`
-- 

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `color` varchar(64) NOT NULL default '',
  `sklad_action` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Дамп данных таблицы `phpshop_order_status`
-- 

INSERT INTO `phpshop_order_status` VALUES (1, 'Аннулирован', 'red', '');
INSERT INTO `phpshop_order_status` VALUES (2, 'Выполняется', '#99cccc', '');
INSERT INTO `phpshop_order_status` VALUES (3, 'Доставляется', '#ff9900', '');
INSERT INTO `phpshop_order_status` VALUES (4, 'Выполнен', '#ccffcc', '1');

-- 
-- Структура таблицы `phpshop_search_base`
-- 

CREATE TABLE `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `uid` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- 
-- Структура таблицы `phpshop_servers`
-- 

CREATE TABLE `phpshop_servers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `host` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- 
-- Структура таблицы `phpshop_baners`
-- 

CREATE TABLE `phpshop_baners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `content` text NOT NULL,
  `count_all` int(11) NOT NULL default '0',
  `count_today` int(11) NOT NULL default '0',
  `flag` enum('0','1') NOT NULL default '0',
  `datas` varchar(32) NOT NULL default '',
  `limit_all` int(11) NOT NULL default '0',
  `dir` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_black_list`
-- 

CREATE TABLE `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip` varchar(32) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_cache`
-- 

CREATE TABLE `phpshop_cache` (
  `sesid` varchar(64) NOT NULL default '',
  `cache` longblob NOT NULL,
  `datas` int(11) NOT NULL default '0',
  PRIMARY KEY  (`sesid`),
  KEY `datas` (`datas`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_categories`
-- 

CREATE TABLE `phpshop_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `num` tinyint(11) NOT NULL default '0',
  `parent_to` int(11) NOT NULL default '0',
  `yml` enum('0','1') NOT NULL default '1',
  `num_row` enum('1','2','3') NOT NULL default '2',
  `num_cow` tinyint(11) NOT NULL default '0',
  `sort` blob NOT NULL,
  `content` text NOT NULL,
  `vid` enum('0','1') NOT NULL default '0',
  `name_rambler` varchar(255) NOT NULL default '',
  `servers` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `title_enabled` enum('0','1','2') NOT NULL default '0',
  `title_shablon` varchar(255) NOT NULL default '',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_enabled` enum('0','1','2') NOT NULL default '0',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `keywords_enabled` enum('0','1','2') NOT NULL default '0',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `skin` varchar(64) NOT NULL default '',
  `skin_enabled` enum('0','1') NOT NULL default '0',
  `order_by` enum('1','2','3') NOT NULL default '3',
  `order_to` enum('1','2') NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`),
  KEY `servers` (`servers`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_jurnal`
-- 

CREATE TABLE `phpshop_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `ip` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_links`
-- 

CREATE TABLE `phpshop_links` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `image` text NOT NULL,
  `opis` text NOT NULL,
  `link` text NOT NULL,
  `num` int(11) default NULL,
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_menu`
-- 

CREATE TABLE `phpshop_menu` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `content` text NOT NULL,
  `flag` enum('0','1') NOT NULL default '1',
  `num` int(11) NOT NULL default '0',
  `dir` varchar(64) NOT NULL default '',
  `element` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `flag` (`flag`),
  KEY `element` (`element`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_news`
-- 

CREATE TABLE `phpshop_news` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(32) NOT NULL default '',
  `zag` varchar(255) NOT NULL default '',
  `kratko` text NOT NULL,
  `podrob` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_opros`
-- 

CREATE TABLE `phpshop_opros` (
  `id` int(11) NOT NULL auto_increment,
  `category` int(11) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `total` int(11) NOT NULL default '0',
  `num` tinyint(32) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_discount`
-- 

CREATE TABLE `phpshop_discount` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `sum` int(255) NOT NULL default '0',
  `discount` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_opros_categories`
-- 

CREATE TABLE `phpshop_opros_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `dir` varchar(32) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_orders`
-- 

CREATE TABLE `phpshop_orders` (
  `id` int(11) NOT NULL auto_increment,
  `datas` varchar(64) NOT NULL default '',
  `uid` int(10) NOT NULL default '0',
  `orders` blob NOT NULL,
  `status` text NOT NULL,
  `user` tinyint(11) unsigned NOT NULL default '0',
  `seller` tinyblob NOT NULL,
  `statusi` tinyint(11) NOT NULL default '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_pages`
-- 


CREATE TABLE `phpshop_page` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `link` varchar(64) NOT NULL default '',
  `category` int(11) NOT NULL default '0',
  `keywords` text NOT NULL,
  `description` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `flag` varchar(16) NOT NULL default '1',
  `num` smallint(3) NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  `odnotip` text NOT NULL,
  `title` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `secure` enum('0','1') NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `link` (`link`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 ;



-- 
-- Структура таблицы `phpshop_page_categories`
-- 

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `num` int(64) NOT NULL default '1',
  `parent_to` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_products`
-- 

CREATE TABLE `phpshop_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `category` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `price` float NOT NULL default '0',
  `price_n` float NOT NULL default '0',
  `sklad` enum('0','1') NOT NULL default '0',
  `p_enabled` enum('0','1') NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `uid` varchar(32) NOT NULL default '',
  `spec` enum('0','1') NOT NULL default '0',
  `odnotip` varchar(64) NOT NULL default '',
  `vendor` varchar(255) NOT NULL default '',
  `vendor_array` blob NOT NULL,
  `yml` enum('0','1') NOT NULL default '0',
  `num` int(11) NOT NULL default '1',
  `newtip` enum('0','1') NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `title_enabled` enum('0','1') NOT NULL default '0',
  `datas` int(11) NOT NULL default '0',
  `page` varchar(255) NOT NULL default '',
  `user` tinyint(11) NOT NULL default '0',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_enabled` enum('0','1','2') NOT NULL default '0',
  `title_shablon` varchar(255) NOT NULL default '',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `keywords_enabled` enum('0','1','2') NOT NULL default '0',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `pic_small` varchar(255) NOT NULL default '',
  `pic_big` varchar(255) NOT NULL default '',
  `yml_bid_array` tinyblob NOT NULL,
  `parent_enabled` enum('0','1') NOT NULL default '0',
  `parent` varchar(255) NOT NULL default '',
  `items` int(11) NOT NULL default '0',
  `weight` float NOT NULL default '0',
  `price2` float NOT NULL default '0',
  `price3` float NOT NULL default '0',
  `price4` float NOT NULL default '0',
  `price5` float NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`),
  KEY `enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_search_jurnal`
-- 

CREATE TABLE `phpshop_search_jurnal` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `num` tinyint(32) NOT NULL default '0',
  `datas` varchar(11) NOT NULL default '',
  `dir` varchar(255) NOT NULL default '',
  `cat` tinyint(11) NOT NULL default '0',
  `set` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;



-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_sort`
-- 

CREATE TABLE `phpshop_sort` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `category` int(11) unsigned NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_sort_categories`
-- 

CREATE TABLE `phpshop_sort_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `flag` enum('0','1') NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `category` int(11) NOT NULL default '-1',
  `filtr` enum('0','1') NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_system`
-- 

CREATE TABLE `phpshop_system` (
  `id` int(32) NOT NULL auto_increment,
  `name` text,
  `company` text,
  `num_row` int(10) default NULL,
  `num_row_adm` int(10) default NULL,
  `dengi` tinyint(11) default NULL,
  `percent` varchar(16) NOT NULL default '',
  `skin` varchar(32) default NULL,
  `adminmail2` varchar(64) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `kurs` tinyint(11) NOT NULL default '0',
  `spec_num` tinyint(5) NOT NULL default '0',
  `new_num` tinyint(11) NOT NULL default '0',
  `tel` text NOT NULL,
  `bank` blob NOT NULL,
  `num_vitrina` enum('1','2','3') NOT NULL default '3',
  `width_icon` varchar(11) NOT NULL default '',
  `updateU` varchar(32) NOT NULL default '',
  `nds` varchar(64) NOT NULL default '',
  `nds_enabled` enum('0','1') NOT NULL default '1',
  `admoption` blob NOT NULL,
  `kurs_beznal` tinyint(11) NOT NULL default '0',
  `descrip` varchar(255) NOT NULL default '',
  `descrip_shablon` varchar(255) NOT NULL default '',
  `title_shablon` varchar(255) NOT NULL default '',
  `keywords_shablon` varchar(255) NOT NULL default '',
  `title_shablon2` varchar(255) NOT NULL default '',
  `descrip_shablon2` varchar(255) NOT NULL default '',
  `keywords_shablon2` varchar(255) NOT NULL default '',
  `logo` varchar(255) NOT NULL default '',
  `promotext` text NOT NULL,
  `title_shablon3` varchar(255) NOT NULL default '',
  `descrip_shablon3` varchar(255) NOT NULL default '',
  `keywords_shablon3` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;




-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_users`
-- 

CREATE TABLE `phpshop_users` (
  `id` int(11) NOT NULL auto_increment,
  `status` blob NOT NULL,
  `login` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `mail` varchar(64) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  `content` text NOT NULL,
  `skin` varchar(255) NOT NULL default '',
  `skin_enabled` enum('0','1') NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `name_enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

	
-- 
-- Структура таблицы `phpshop_valuta`
-- 

CREATE TABLE `phpshop_valuta` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `code` varchar(64) NOT NULL default '',
  `iso` varchar(64) NOT NULL default '',
  `kurs` varchar(64) NOT NULL default '0',
  `num` tinyint(11) NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- Структура таблицы `phpshop_shopusers`
-- 

CREATE TABLE `phpshop_shopusers` (
  `id` int(64) unsigned NOT NULL auto_increment,
  `login` varchar(64) NOT NULL default '',
  `password` varchar(64) NOT NULL default '',
  `datas` varchar(64) NOT NULL default '',
  `mail` varchar(64) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `inn` varchar(64) NOT NULL default '',
  `tel` varchar(64) NOT NULL default '',
  `adres` text NOT NULL,
  `enabled` enum('0','1') NOT NULL default '0',
  `status` varchar(64) NOT NULL default '0',
  `kpp` varchar(64) NOT NULL default '',
  `tel_code` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- 
-- Структура таблицы `phpshop_shopusers_status`
-- 

CREATE TABLE `phpshop_shopusers_status` (
  `id` tinyint(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `discount` float NOT NULL default '0',
  `price` enum('1','2','3','4','5') NOT NULL default '1',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


CREATE TABLE `phpshop_delivery` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `city` varchar(255) NOT NULL default '',
  `price` float NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `flag` enum('0','1') NOT NULL default '0',
  `price_null` float NOT NULL default '0',
  `price_null_enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;


-- --------------------------------------------------------



-- 
-- Дамп данных таблицы `phpshop_delivery`
-- 

INSERT INTO `phpshop_delivery` VALUES (1, 'Москва в пределах МКАД', 180, '1', '1', 300, '1');
INSERT INTO `phpshop_delivery` VALUES (2, 'Московская обл.', 255, '1', '', 0, '');
INSERT INTO `phpshop_delivery` VALUES (3, 'Москва за пределами МКАД', 230, '1', '', 350, '1');



-- 
-- Дамп данных таблицы `phpshop_valuta`
-- 

INSERT INTO `phpshop_valuta` VALUES (1, 'Доллары США', '$', 'USD', '0.0358', 1, '0');
INSERT INTO `phpshop_valuta` VALUES (2, 'Рубли', 'руб.', 'RUR', '1', 0, '0');
INSERT INTO `phpshop_valuta` VALUES (3, 'Евро', '&euro;', 'EUR', '0.0286', 2, '1');
INSERT INTO `phpshop_valuta` VALUES (4, 'Гривны', 'гр.', 'UAU', '0.015', 4, '1');
INSERT INTO `phpshop_valuta` VALUES (5, 'Доллары США', '$', 'USD', '1', 0, '1');
INSERT INTO `phpshop_valuta` VALUES (6, 'Рубли', 'руб', 'RUR', '28', 1, '1');
        


   
-- 
-- Дамп данных таблицы `phpshop_system`
-- 
INSERT INTO `phpshop_system` VALUES (1, 'Интернет-магазин PHPShop', 'PHPShop', 10, 0, 5, '0', 'aeroblue', 'support@mysoft.ru', 'Купить технику с бесплатной доставкой', 'детские, товары, купить, бесплатная, доставка, MP3, проигрыватели, автомобильная, электроника, бытовая, техника, аудио, видео, фото, холодильники, телевизоры, плазменные, панели, DEX, SONY, PHILIPS, TEFAL, ROWENTA, SAMSUNG, KRUPS, BINATONE, KENWOOD', 5, 5, 5, '(495) 105-05-50', 0x613a393a7b733a383a226f72675f6e616d65223b733a31303a22cecece20cde5f2f0e8ea223b733a31323a226f72675f75725f6164726573223b733a363a22cceef1eae2e0223b733a393a226f72675f6164726573223b733a363a22cceef1eae2e0223b733a373a226f72675f696e6e223b733a31303a2237373230353238383233223b733a373a226f72675f6b7070223b733a393a22373732303031303031223b733a393a226f72675f7363686574223b733a32303a223430373032383130343030313630303030303830223b733a383a226f72675f62616e6b223b733a31313a22cac120d1c4cc2dc1c0cdca223b733a373a226f72675f626963223b733a393a22303434353833363835223b733a31343a226f72675f62616e6b5f7363686574223b733a32303a223330313031383130363030303030303030363835223b7d, '2', '5', '1202806188', '18', '1', 0x613a33343a7b733a363a22696d675f776d223b733a303a22223b733a353a22696d675f77223b733a333a22333030223b733a353a22696d675f68223b733a333a22333030223b733a363a22696d675f7477223b733a333a22313530223b733a363a22696d675f7468223b733a333a22313530223b733a31343a2277696474685f706f64726f626e6f223b733a323a223730223b733a31323a2277696474685f6b7261746b6f223b733a323a223730223b733a31353a226d6573736167655f656e61626c6564223b733a313a2231223b733a31323a226d6573736167655f74696d65223b733a323a223630223b733a31353a226465736b746f705f656e61626c6564223b4e3b733a31323a226465736b746f705f74696d65223b4e3b733a383a226f706c6174615f31223b733a313a2231223b733a383a226f706c6174615f32223b733a313a2231223b733a383a226f706c6174615f33223b733a313a2231223b733a383a226f706c6174615f34223b4e3b733a383a226f706c6174615f35223b733a313a2231223b733a383a226f706c6174615f36223b733a313a2231223b733a383a226f706c6174615f37223b733a313a2231223b733a383a226f706c6174615f38223b733a313a2231223b733a31343a2273656c6c65725f656e61626c6564223b4e3b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b4e3b733a31343a226e6f746963655f656e61626c6564223b733a313a2231223b733a31343a227570646174655f656e61626c6564223b733a313a2231223b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a343a226c616e67223b733a373a227275737369616e223b733a31333a22736b6c61645f656e61626c6564223b733a313a2231223b733a31303a2270726963655f7a6e616b223b733a303a22223b733a31383a22757365725f6d61696c5f6163746976617465223b733a313a2231223b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a363a22313030303030223b733a31343a22656469746f725f656e61626c6564223b733a313a2231223b7d, 5, 'PHPShop – это готовое решение для быстрого создания Интернет магазина.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '/UserFiles/Image/DEXline.jpg', '', '@Catalog@', '@Catalog@', '@Catalog@');
  
-- 
-- Дамп данных таблицы `phpshop_users`
-- 

INSERT INTO `phpshop_users` VALUES ('', 0x613a32303a7b733a353a2267626f6f6b223b733a353a22312d312d31223b733a343a226e657773223b733a353a22312d312d31223b733a373a2276697369746f72223b733a373a22312d312d312d30223b733a353a227573657273223b733a373a22312d312d312d31223b733a393a2273686f707573657273223b733a353a22312d312d31223b733a383a226361745f70726f64223b733a373a22312d312d312d31223b733a363a22737461747331223b733a353a22312d312d31223b733a353a227275706179223b733a353a22312d302d30223b733a31313a226e6577735f777269746572223b733a353a22312d312d31223b733a393a22706167655f73697465223b733a353a22312d312d31223b733a393a22706167655f6d656e75223b733a353a22312d312d31223b733a353a2262616e6572223b733a353a22312d312d31223b733a353a226c696e6b73223b733a353a22312d312d31223b733a333a22637376223b733a353a22312d312d31223b733a353a226f70726f73223b733a353a22312d312d31223b733a333a2273716c223b733a353a22302d312d31223b733a363a226f7074696f6e223b733a333a22302d31223b733a383a22646973636f756e74223b733a353a22312d312d31223b733a363a2276616c757461223b733a353a22312d312d31223b733a383a2264656c6976657279223b733a353a22312d312d31223b7d, 'root', 'cm9vdA==', 'support@phpshop.ru', '1', '', 'blue', '1', '', '1');
      
-- 
-- Проверка
-- 
SET NAMES 'cp1251';
     