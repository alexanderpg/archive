

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_baners`
-- 

INSERT INTO `phpshop_baners` VALUES (1, 'PHPShop Start', '<A href="http://www.phpshop.ru"><IMG height=60 alt="" src="/UserFiles/Image/Trial/baner_start.gif" width=468 border=0></A>', 63, 63, '0', '14.04.08', 2147483647, '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_black_list`
-- 

CREATE TABLE `phpshop_black_list` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `ip` varchar(32) NOT NULL default '',
  `datas` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_black_list`
-- 


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

-- 
-- Дамп данных таблицы `phpshop_cache`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=13 ;

-- 
-- Дамп данных таблицы `phpshop_categories`
-- 

INSERT INTO `phpshop_categories` VALUES (1, 'Мелкая бытовая техника', 0, 0, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (2, 'Утюги', 0, 1, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (3, 'Машинки для стрижки', 0, 1, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (4, 'Электрочайники', 0, 1, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (5, 'Крупная бытовая техника', 0, 0, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (6, 'Микроволновые печи', 0, 5, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (7, 'Стиральные машины', 0, 5, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (8, 'Печи-духовки', 0, 5, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (9, 'Аудио-Видео-Фото', 0, 0, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (10, 'ЖК-телевизоры', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (11, 'Цифровые фотоаппараты', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');
INSERT INTO `phpshop_categories` VALUES (12, 'MP3-плееры', 0, 9, '', '2', 0, 0x4e3b, '', '', '', '', '', '0', '', '', '0', '', '', '0', '', 'PHPshop_1', '', '1', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_comment`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_delivery`
-- 

CREATE TABLE `phpshop_delivery` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `city` varchar(255) NOT NULL default '',
  `price` float NOT NULL default '0',
  `enabled` enum('0','1') NOT NULL default '1',
  `flag` enum('0','1') NOT NULL default '0',
  `price_null` float NOT NULL default '0',
  `price_null_enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `phpshop_delivery`
-- 

INSERT INTO `phpshop_delivery` VALUES (1, 'Москва в пределах МКАД', 180, '1', '1', 300, '1');
INSERT INTO `phpshop_delivery` VALUES (2, 'Московская обл.', 255, '1', '', 0, '');
INSERT INTO `phpshop_delivery` VALUES (3, 'Москва за пределами МКАД', 230, '1', '', 350, '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_discount`
-- 


-- --------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=51 ;

-- 
-- Дамп данных таблицы `phpshop_foto`
-- 

INSERT INTO `phpshop_foto` VALUES (4, 1, '/UserFiles/Image/Trial/img1_15201.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (5, 2, '/UserFiles/Image/Trial/img2_20923.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (6, 3, '/UserFiles/Image/Trial/img3_27387.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (7, 4, '/UserFiles/Image/Trial/img4_97080.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (17, 6, '/UserFiles/Image/Trial/img6_94790.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (16, 5, '/UserFiles/Image/Trial/img5_13875.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (18, 7, '/UserFiles/Image/Trial/img7_21593.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (19, 8, '/UserFiles/Image/Trial/img8_19242.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (20, 9, '/UserFiles/Image/Trial/img9_18900.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (22, 10, '/UserFiles/Image/Trial/img10_16509.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (23, 11, '/UserFiles/Image/Trial/img11_10500.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (24, 12, '/UserFiles/Image/Trial/img12_17764.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (25, 13, '/UserFiles/Image/Trial/img13_15187.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (28, 15, '/UserFiles/Image/Trial/img15_10754.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (27, 14, '/UserFiles/Image/Trial/img14_72079.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (29, 16, '/UserFiles/Image/Trial/img16_23131.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (30, 17, '/UserFiles/Image/Trial/img17_15624.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (31, 18, '/UserFiles/Image/Trial/img18_17180.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (32, 19, '/UserFiles/Image/Trial/img19_20468.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (33, 20, '/UserFiles/Image/Trial/img20_12661.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (35, 21, '/UserFiles/Image/Trial/img21_66070.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (36, 22, '/UserFiles/Image/Trial/img22_40627.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (37, 23, '/UserFiles/Image/Trial/img23_60070.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (38, 24, '/UserFiles/Image/Trial/img24_92740.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (39, 25, '/UserFiles/Image/Trial/img25_89668.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (40, 26, '/UserFiles/Image/Trial/img26_20400.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (41, 27, '/UserFiles/Image/Trial/img27_20637.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (42, 28, '/UserFiles/Image/Trial/img28_22696.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (43, 29, '/UserFiles/Image/Trial/img29_10321.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (44, 30, '/UserFiles/Image/Trial/img30_20017.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (45, 31, '/UserFiles/Image/Trial/img31_16234.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (46, 32, '/UserFiles/Image/Trial/img32_23078.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (47, 33, '/UserFiles/Image/Trial/img33_11122.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (48, 34, '/UserFiles/Image/Trial/img34_12151.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (49, 35, '/UserFiles/Image/Trial/img35_18833.jpg', 0, '');
INSERT INTO `phpshop_foto` VALUES (50, 36, '/UserFiles/Image/Trial/img36_16386.jpg', 0, '');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

-- 
-- Дамп данных таблицы `phpshop_jurnal`
-- 

INSERT INTO `phpshop_jurnal` VALUES (1, 'root', '1207915618', '0', '127.0.0.1');
INSERT INTO `phpshop_jurnal` VALUES (2, 'root', '1208156181', '0', '127.0.0.1');
INSERT INTO `phpshop_jurnal` VALUES (3, 'root', '1208184063', '0', '127.0.0.1');
INSERT INTO `phpshop_jurnal` VALUES (4, 'root', '1208246214', '0', '127.0.0.1');
INSERT INTO `phpshop_jurnal` VALUES (5, 'root', '1208253380', '0', '127.0.0.1');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `phpshop_links`
-- 

INSERT INTO `phpshop_links` VALUES (1, 'PHPShop Software', '', 'Создание интернет-магазина, скрипт интернет-магазина PHPShop.', 'http://www.phpshop.ru', 5, '1');
INSERT INTO `phpshop_links` VALUES (2, 'PHPShop CMS Free', '', 'Бесплатная сиcтема управления сайтом PHPShop CMS Free.', 'http://www.phpshopcms.ru', 3, '1');
INSERT INTO `phpshop_links` VALUES (3, 'Vsego Mnogo', '', 'Vsego-mnogo.ru – сайт о бытовой технике, электронике, авто-товарах, видео-товарах. ', 'http://www.vsego-mnogo.ru/', 1, '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `phpshop_menu`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `phpshop_news`
-- 

INSERT INTO `phpshop_news` VALUES (1, '14-04-2008', 'Доступна курьеская доставка PHPShop Software', 'Добавлена услуга доставки продукции PHPShop Software курьерами по г. Москва и Подмосковью. Подключен новый ресселер для распространения в данном регионе.', 'Добавлена услуга доставки продукции PHPShop Software курьерами по г. Москва и Подмосковью. Подключен новый ресселер для распространения. Теперь вы можете получить свой заказ в течении 1 дня или приобрести коробочную версию по адресу м. Тимирязевская, Дмитровское шоссе д.5 стр.1, ООО «Плейолл»<BR><BR>Для заказа доставки <A href="http://www.phpshop.ru/order/"><FONT color=#0000ff>оформите заказ</FONT></A>, выберите форму оплаты "Наличными курьеру", укажите&nbsp; адрес доставки и телефон для связи. Цены у распространителей не отличаются от официальных, указанных на нашем сайте. ');
INSERT INTO `phpshop_news` VALUES (2, '14-04-2008', 'Поддержка неограниченного кол-ва независимых магазинов на едином домене', 'Начиная с версии PHPShop Enterprise 2.1.8.2.0, реализована возможность размещение <STRONG>2-х и более независимых интернет-магазинов в любых директориях домена</STRONG>. Данная особенность позволяет создавать многоязычные проекты и гиппермаркеты,&nbsp;используя 1 лицензию. ', 'Начиная с версии PHPShop Enterprise 2.1.8.2.0, реализована возможность размещение 2-х и более независимых интернет-магазинов в любых директориях домена. Данная особенность позволяет создавать многоязычные проекты и гиппермаркеты,&nbsp;используя 1 <A href="http://www.phpshop.ru/docs/license.html"><FONT color=#810081>лицензию</FONT></A>.<BR><BR>Для задания папки размещения требуется выполнить всего несколько шагов:<BR><BR>1. копируем скрипт в любую директорию, например /free/<BR>2. библиотеку /phpshop/lib/ копируем в корень /<BR>3. в файле конфигурации /free/phpshop/inc/config.ini указываем имя директории, куда установлен скрипт<BR><BR>[dir]<BR>dir="/free";&nbsp;<BR><BR>4. магазин запуcкается и работает независимо от остальных&nbsp;из папки /free/<BR><BR>Таким образом, можно установить неограниченное кол-во интернет-магазинов на одном домене.<BR>Поддерживается возможность установки нескольких магазинов в единую базу, для этого служит опция префикс в названиях таблиц:<BR>phpshop_&nbsp;&nbsp; - 1 магазин<BR>phpshop2_ - 2 и т.д.<BR>Тип префикса задается в файле config.ini ');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_notice`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

-- 
-- Дамп данных таблицы `phpshop_opros`
-- 

INSERT INTO `phpshop_opros` VALUES (1, 1, 'Да', 1, 0);
INSERT INTO `phpshop_opros` VALUES (2, 1, 'Нормально', 0, 0);
INSERT INTO `phpshop_opros` VALUES (3, 1, 'Не очень', 0, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_opros_categories`
-- 

INSERT INTO `phpshop_opros_categories` VALUES (1, 'Вам нравится новый дизайн?', '', '1');

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_order_status`
-- 

CREATE TABLE `phpshop_order_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `color` varchar(64) NOT NULL default '',
  `sklad_action` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5 ;

-- 
-- Дамп данных таблицы `phpshop_order_status`
-- 

INSERT INTO `phpshop_order_status` VALUES (1, 'Аннулирован', 'red', '');
INSERT INTO `phpshop_order_status` VALUES (2, 'Выполняется', '#99cccc', '');
INSERT INTO `phpshop_order_status` VALUES (3, 'Доставляется', '#ff9900', '');
INSERT INTO `phpshop_order_status` VALUES (4, 'Выполнен', '#ccffcc', '1');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_orders`
-- 

INSERT INTO `phpshop_orders` VALUES (1, '1208239163', 101, 0x613a323a7b733a343a2243617274223b613a343a7b733a343a2263617274223b613a323a7b693a33363b613a363a7b733a323a226964223b733a323a223336223b733a343a226e616d65223b733a34313a224d50332defebe5e5f020444558204d50582d31383620283247622920426c61636b202f205768697465223b733a353a227072696365223b693a313530303b733a333a22756964223b733a303a22223b733a333a226e756d223b693a3130303b733a343a2275736572223b733a313a2231223b7d693a33353b613a363a7b733a323a226964223b733a323a223335223b733a343a226e616d65223b733a34303a224d50332defebe5e5f020444558204d50582d31353620283247622920426c61636b2f53696c766572223b733a353a227072696365223b693a3930303b733a333a22756964223b733a303a22223b733a333a226e756d223b733a313a2231223b733a343a2275736572223b733a313a2231223b7d7d733a333a226e756d223b693a3130313b733a333a2273756d223b733a393a223135303930302e3030223b733a383a22646f737461766b61223b693a303b7d733a363a22506572736f6e223b613a31373a7b733a343a226f756964223b733a333a22313031223b733a343a2264617461223b733a31303a2231323038323339313633223b733a343a2274696d65223b733a383a2230393a323320616d223b733a343a226d61696c223b733a31343a2264656e4070687073686f702e7275223b733a31313a226e616d655f706572736f6e223b733a353a22c4e5ede8f1223b733a383a226f72675f6e616d65223b733a303a22223b733a373a226f72675f696e6e223b733a303a22223b733a373a226f72675f6b7070223b733a303a22223b733a383a2274656c5f636f6465223b733a303a22223b733a383a2274656c5f6e616d65223b733a373a2235303530363431223b733a383a226164725f6e616d65223b733a363a22cceef1eae2e0223b733a31343a22646f737461766b615f6d65746f64223b733a313a2231223b733a383a22646973636f756e74223b693a303b733a373a22757365725f6964223b733a313a2231223b733a363a22646f735f6f74223b733a303a22223b733a363a22646f735f646f223b733a303a22223b733a31313a226f726465725f6d65746f64223b733a313a2233223b7d7d, 'a:2:{s:7:"maneger";s:0:"";s:4:"time";s:0:"";}', 1, 0x693169693169, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_page`
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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `phpshop_page`
-- 

INSERT INTO `phpshop_page` VALUES (1, 'Выбор дизайна', 'page1', 2000, '', '', '<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px" align=center>\r\n<TABLE align=center>\r\n<TBODY>\r\n<TR>\r\n<TD><A title="Посмотреть в действии" href="/?skin=PHPshop_1"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_9_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=PHPshop_2"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_10_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=PHPshop_3"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_11_small.gif" width=100 border=0> </A></TD>\r\n<TD style="BORDER-RIGHT: #d3d3d3 1px dashed; PADDING-RIGHT: 5px; BORDER-TOP: #d3d3d3 1px dashed; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; BORDER-LEFT: #d3d3d3 1px dashed; PADDING-TOP: 5px; BORDER-BOTTOM: #d3d3d3 1px dashed" align=middle><IMG src="/UserFiles/Image/Trial/palette.png" border=0> <BR><A class=b title="Создание персонального дизайна" href="http://www.phpshop.ru/docs/service.html#1">Дизайн<BR>под заказ »</A></TD></TR>\r\n<TR>\r\n<TD><A title="Посмотреть в действии" href="/?skin=aeroblue"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_5_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=pink" ?><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_7_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=grass"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_6_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=gray"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_8_small.gif" width=100 border=0></A> </TD></TR>\r\n<TR>\r\n<TD><A title="Посмотреть в действии" href="/?skin=blue_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_1_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=red_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_2_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=green_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_3_small.gif" width=100 border=0></A> </TD>\r\n<TD><A title="Посмотреть в действии" href="/?skin=yellow_classic"><IMG class=imgOff onmouseover=ButOn(this) onmouseout=ButOff(this) height=80 alt="Посмотреть в действии" src="/UserFiles/Image/Trial/def_skin_4_small.gif" width=100 border=0></A> </TD></TR></TBODY></TABLE></DIV>', '', 0, 1208180402, '', '', '1', '');
INSERT INTO `phpshop_page` VALUES (2, 'Как сделать заказ?', 'page2', 1000, '', '', '<H3 align=center>Как сделать заказ?</H3>\r\n<DIV><STRONG>1. Выбираете товары</STRONG><BR>Все товары в нашем интернет-магазине сгруппированы в тематические разделы. Для Вашего удобства, сайт магазина оснащен удобной поисковой системой, которая поможет вам быстро найти нужные товары.<BR>Выбрав товар, нажмите кнопку «В корзину» – товар будет добавлен в Ваш заказ («корзина»). Посередине в верху каждой страницы сайта постоянно отображается количество товаров в вашей корзине и сумма стоимости выбранных Вами товаров.<BR>После добавления товара в корзину, Вы можете продолжить выбирать товары или перейти к оформлению заказа.</DIV>\r\n<DIV><BR><STRONG>2. Оформляете заказ</STRONG><BR>Для просмотра содержимого вашего заказа нажмите на надпись «Оформить заказ».<BR>Количество единиц товара может быть увеличено или уменьшено по Вашему желанию - просто измените цифру в строке товара и нажмите кнопку «Пересчитать». Если Вы случайно добавили в корзину лишний товар, то всегда можете удалить его с помощью кнопки «Удалить».<BR>Общая стоимость заказа подсчитывается автоматически и отображается внизу вашего списка товаров. Стоимость может отличаться в зависимости от способа оплаты.<BR>Заполните несложную форму заказа. В ней Вам необходимо указать свои контактные данные, время и адрес для доставки заказа, выбрать способ оплаты.<BR>После этого нажмите кнопку «Оформить покупку». Вот и все - заказ оформлен!<BR>По электронной почте вы получите уведомление о приеме Вашего заказа.</DIV>\r\n<DIV><BR><STRONG>3. Ожидаете доставки Вашего заказа!</STRONG><BR>В кратчайший срок менеджер нашего магазина свяжется с Вами, согласует перечень заказанных товаров и способ оплаты, подтвердит возможность доставки заказа в указанное Вами время, или обсудит другое удобное для вас время получения заказа.</DIV>\r\n<P><STRONG>Обратите внимание:</STRONG><BR>Делая заказ в нашем интернет-магазине, Вы еще не платите деньги, а всего лишь сообщаете нам о своих намерениях. В любом случае, Вы имеете право отказаться от заказанного товара до момента его доставки курьером.</P>\r\n<P><STRONG>Возникли вопросы?</STRONG><BR>Наши менеджеры проконсультируют Вас по всем вопросам, связанным с оформлением заказа, оплатой и доставкой по телефону: 200-30-40 (Пн-Пт, с 9 до 18 часов).</P>', '', 0, 1208172153, '', '', '1', '');
INSERT INTO `phpshop_page` VALUES (3, 'Затраты и отдача', 'page3', 1000, '', '', '<H1>Затраты и отдача</H1>\r\n<DIV class=cl>Вы уже решили, что Интернет необходим Вашему бизнесу, и начали задумываться о том, как спланировтаь свою рекламную кампанию, сколько денег «вбухать» и, само собой, какого результата стоит ожидать. Если Интернет-реклама входит в Ваши планы, то мы можем говорить о двух вариантах Вашего медиаплана:<BR><BR></DIV>\r\n<DIV class=text>\r\n<UL>\r\n<LI><STRONG>Интернет оказывает информационную поддержку, оффлайн-реклама – основной канал.</STRONG> </LI></UL>\r\n<P><STRONG>Затраты</STRONG>: в этом случае главным носителем будет являться промо-сайт компании или рекламной акции. Вам понадобится новая страничка на Вашем корпоративном сайте, либо небольшой промо-сайт на отдельном домене. Мы склоняемся к последнему варианту, потому как зачастую фирменный стиль компании может отличаться от идеи проводимой акции. Промо-сайты отличаются ярким дизайном, использованием новых мультимедиа-технологий, что может совсем не вязаться со сдержанным стилем Вашего корпоративного сайта. К тому же промо-сайту необходима рекламная баннерная поддержка.<BR><BR><STRONG>Отдача</STRONG>: Во многом Вам стоит положиться на то, как будет реализована сама акция, в основном ее креативная часть, и… удачу. Даже если заядлый интернетчик клюнет на дизайн и перечитает все странички Вашего сайта, еще не факт, что он появится в нужном Вам месте. Говорить же о привлечении людей из оффлайна в Интернет вообще опасно – если Вы говорите о том, что подробности акции можно увидеть на Вашей странице в Интернете, то существует большая вероятность того, что это будет последнее, что Вы им сообщили. А если Вы используете Интернет самостоятельно, без профессиональной помощи, то последствия могут быть печальными – ведь Интернет – это, по сути, большой «испорченный телефон», и одна небольшая ошибка может стоить Вам очень дорого.<BR><BR></P>\r\n<UL>\r\n<LI><STRONG>Интернет является главным рекламным каналом.</STRONG> </LI></UL>\r\n<P><STRONG>Затраты</STRONG>: отсутствуют расходы на полиграфию или создание телевизионных роликов. Требования к компьютерной графике намного проще, значительная часть денежных и временных вложений экономится.<BR>Если у Вас уже есть сайт и необходимости в создании промо-сайта для рекламной акции нет, то, опять же, размер рекламного бюджета значительно сокращается.<BR>С точки зрения привлечения аудитории, Интернет во многом выигрывает у оффлайн-рекламы. Главным инструментом здесь принято считать поисковые системы, поэтому оптимизация и продвижение сайта по ключевым словам – самые необходимые действия для привлечения целевого трафика. Оцените ежедневную стоимость прокрутки ролика даже по местному каналу, и сравните с ежемесячной платой за поисковое продвижение Вашего сайта. И зачастую только его бывает достаточно. Так называемые связи с общественностью в реальном (в отличие от виртуального) пространстве требуют значительных затрат, да и охватить все возможные варианты собственного пиара зачастую не представляется возможным. В Интернете же существует едва ли с десяток методов, которые в комплексном подходе способны творить чудеса в деле привлечения целевой аудитории, при условии профессионального подхода. <BR>Представьте себе, сколько Вы сэкономите на промоутерах и биг-бордах, на исследованиях и фуршетах. Ведь в Интернете за те же деньги есть возможность проводить баннерную рекламу, опросы посетителей, осуществлять тематическую рассылку со своего сайта, наладить партнерские отношения с крупными отраслевыми порталами и даже успеть провести небольшую акцию с раздачей призов. <BR><BR><STRONG>Отдача</STRONG>: это идеальный вариант для небольших или малобюджентых компаний, имеющих постоянную целевую аудиторию в Интернете. По сравнению с оффлайн-рекламой Вы тратите гораздо меньшее количество времени и денег, при этом полностью охватывая свою целевую аудиторию. Вы получаете возможность оценивать эффективность Ваших рекламных компаний в реальном времени и корректировать свой бюджет основываясь на результатах. За деньги, потраченные на ограниченное количество рекламы в оффлайне Вы сможете обеспечить себе довольно длительно стабильное положение в своем рынке (поисковые системы), развить лояльность покупателей к своему бренду, провести распродажи, спонсорские акции и т.п. И не забывайте о том, что Вашу рекламу смогут увидеть в любое время суток и в любой точке земного шара.<BR>Существуют также ситуации, когда Ваш бизнес функционирует только в Интернете, который и является основным рекламным каналом, но при этом оффлайн-реклама оказывает информационную поддержку Интернет-ресурсу. Это компромиссный вариант, который имеет смысл учитывать при проведении акций или конкурсов в Интернете.<BR>Кроме основных затрат на Интернет-рекламу в Вашем медиаплане оговариваются расходы на некоторое количество печатных изданий, рекламных щитов или видеороликов, однако все-же основную нагрузку несет Интернет. Таким образом, помимо Интернет-аудитории, Вы привлекаете так же и приверженцев традиционных рекламных носителей - прессы, возможно, телевидения и др. <BR>Как видите, преимуществ у Интернета, как рекламного носителя, много, и не использовать Интернет в рекламной компании было бы неосмотрительно и неразумно с точки зрения перспектив. Однако здесь следует действовать осторожно и выбирать себе надежного и проверенного партнера, потому как некоторые, казалось бы, незначительные ошибки, могут нанести серьезный ущерб Вашему бизнесу, поэтому стоит иметь дело только с опытными профессионалами.<BR><BR>Мы желаем Вам только процветания и успехов!<BR></P></DIV>', '', 0, 1208172033, '', '', '1', '');
INSERT INTO `phpshop_page` VALUES (4, 'Контакты', 'page4', 1000, '', '', '<DIV style="PADDING-RIGHT: 5px; PADDING-LEFT: 5px; PADDING-BOTTOM: 5px; PADDING-TOP: 5px">\r\n<H1>Обратная связь</H1>\r\n<DIV class=cl>Мы находимся по адресу:</DIV>\r\n<DIV class=text>г. Москва, Малый Гнездниковский переулок 9/8 корп.3 офис 7. <BR>Tел./факс: (+7 495) 400-30-20</DIV>\r\n<DIV class=text>Вы можете задать любые интересующие Вас вопросы, касающиеся наших услуг, работы сайта или сотрудничества.<BR></DIV></DIV>', '', 0, 1208172286, '', '', '1', '');
INSERT INTO `phpshop_page` VALUES (5, 'Глобальный маркетинг в Интернете', 'page5', 1, '', '', '<DIV>Интернет называют издательским феноменом 90-х, что идут споры о влия&shy;нии этой сети на коммерцию в следующем столетии. Более половины ком&shy;паний, входящих в список 500 крупнейших фирм США «Fortune 500», используют Интернет, и есть статистика, свидетельствующая о феноменальном росте Сети. Нельзя не знать как о популярности системы World Wide Web, насчитывающей сегодня более&nbsp; 37 000 адресов, так и об усилиях, предпринимаемых&nbsp; для обеспечения безопасной передачи важной информации (например, по кредитным картам), что просто необходимо для развития коммерции в Сети. Например, Netscape Communications — ведущий производитель программного обеспечения для работы в Интернет — уже предлагает продукты, работающие по технологии клиент-сервер и созданные для решения этой задачи; кроме того, множество компаний разрабатывает безопасные системы электронных платежей.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Надо уметь представить на рынке товары и услуги; необходимо также решить все связанные с этим задачи: сегментирование рынка, определение потребностей потребителей в целевых сегмен&shy;тах и способа продвижения товара, связь с потребите&shy;лями (другими словами, реклама).</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Понятие маркетинга в Интернет остается наименее изученным и представляет главную проблему фирмы, ре&shy;шившей заниматься коммерцией в этой области. И хотя вряд ли кто-нибудь в ближайшем будущем сможет дать четкое определение данного термина (так как среда пользователей и технология еще не окончательно сфор&shy;мировались), уже сейчас можно предложить несколь&shy;ко стратегий ведения бизнеса в Сети.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Сеть Интернет создавалась не с коммерческой целью, а для обмена информацией между учеными. Но идея ведения бизнеса не чужда ей — она была заложена в самой структуре Сети, хотя привычные для нас краси&shy;вые названия, такие как «торговые центры», «стендо&shy;вая реклама», «стратегическое положение», практичес&shy;ки ничего не значат в мире электронном. Нехватка новых терминов и обозначений сегодня уже не являет&shy;ся временным неудобством в определении маркетинго&shy;вых подходов, а ставит перед нами вопрос «Что такое маркетинг?», отвечать на который нужно совершенно по-новому.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV><STRONG>Проблемы маркетинга в Интернете</STRONG></DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>Под маркетингом обычно подразумевается изучение рынка (размеров, демографических характеристик, потребностей) для размещения продукта, определения цены, вероятных покупателей и выработки способов общения с последними. Поэтому человек, занимающий&shy;ся маркетингом в Интернет, обычно сталкивается со следующими проблемами:</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; неизвестными размерами рынка, </DIV>\r\n<DIV>·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; пассивностью покупателей </DIV>\r\n<DIV>·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; незнанием потре&shy;бителей.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR><STRONG>Неизвестные размеры рынка<BR></STRONG><BR></DIV>\r\n<DIV>О пользователях Интернет мы знаем очень мало. Невозможно, даже более или менее точно определить их число. Наиболее распространенная оценка размера Интернет, принадлежащая Internet Society, определя&shy;ется как число подключенных к сети узловых компью&shy;теров. Еще в июле 1996 года их было 13 миллионов (на самом деле это лишь часть Сети), при этом за первое полугодие 1996 года это число увеличилось на 35 %. Вычислить количество пользователей в зависимости от серверов так, чтобы результат соответствовал действи&shy;тельности, практически невозможно. По некоторым оценкам, в настоящее время пользова&shy;телей Сети порядка 50 миллионов.</DIV>\r\n<DIV>Ну, а как обстоят дела в России? Приведем выдержку из электронного журнала Computer Week-Moscow (CW-Moscow, 34-35, 1998, http://www.ritmpress.ru/ it/talk/Ol.htm):</DIV>\r\n<DIV>«В нашей стране, даже по самым смелым оценкам, ко&shy;личество пользователей электронной почты не превы&shy;шает 500 тыс., а "Всемирной паутины" — 50 тыс. че&shy;ловек. Однако не следует забывать, что и в России уже есть регионы, в числе которых Москва, Петер&shy;бург, Новосибирск, Ярославль, Новгород, где в Ин&shy;тернет работают не только компьютерные специалис&shy;ты. В частности, в Ярославской области к Всемирной сети подключено свыше 30 сельских школ. С помо&shy;щью Международного научного фонда Сороса по всей стране увеличивается количество университетов, в ко&shy;торых взращивается новое поколение пользователей Интёрнет— высококвалифицированных специалистов и, будем надеяться, состоятельных потребителей про&shy;дуктов и услуг. Отличительной особенностью Интернет как новой инфраструктуры маркетинга и сбыта яв&shy;ляется тот факт, что здесь пока не действует основной принцип рыночной экономики: спрос рождает предло&shy;жение. Опыт многих стран свидетельствует, что не по&shy;требитель определяет объем цифровых услуг. Напро&shy;тив, поставщики и производители приходят к выводу о необходимости вспрыгнуть на подножку отходящего экспресса "Интернет". И объясняется это не только воп&shy;росами престижа, но и опасением, что лучшие места на этом перспективном рынке расхватают другие.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>Если о размерах Интернет (и, в частности, WWW) можно сказать только, что они «очень велики» и «про&shy;должают расти», то как оценить демографические ха&shy;рактеристики пользователей сети? Иными словами, как узнать потребности неизвестного рынка? Что, в конце концов, продавать? Ответ, как вы уже, наверное, до&shy;гадались, тот же: неизвестно. Одно из исследований показало, что 95 % пользователей составляют мужчи&shy;ны в возрасте от 22 до 30 лет, то есть студенты и не&shy;давние выпускники вузов. Появление новых электрон&shy;ных услуг, конечно же, сильно изменит эти цифры (и, скорее всего, в лучшую сторону).</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>\r\n<HR>\r\n</DIV>\r\n<DIV><STRONG>Пассивность потребителей</STRONG></DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>Достаточно ли знать, что потребителей «много» и «их число растет»? Как правило (имеется в виду разновид&shy;ности бизнеса), точные цифры — «сколько» и «как быстро» — не нужны. В конце концов, расходы на подключение к Интернет&nbsp; по сравнению с затратами на открытие настоящего магазина и оплату труда работ&shy;ников относительно невелики.<BR></DIV>\r\n<DIV>Настоящие проблемы возникают, когда вы пытаетесь сообщить (неизвестно кому!) о своем существовании и продукции. Сегодняшние возможности передачи дан&shy;ных — электронная почта и доски объявлений (теле&shy;конференции) — абсолютно неприемлемы для распро&shy;странения такой информации. Необходимо четко понимать, что товары и услуги нельзя рекламировать в Сети так же, как по телевидению, то есть прямо и настойчиво. Предложения своей продукции в подоб&shy;ной форме и явное продвижение самого себя не поощ&shy;ряются. Нарушение неписаных правил немедленно приводит к реакции со стороны пользователей — на&shy;рушителя «сжигают», иными словами, ему посылают тысячи осуждающих сообщений по электронной поч&shy;те. Огромный объем информации способен вывести из строя сеть пользователя, которая окажется не в состо&shy;янии справиться с обработкой такого количества сооб&shy;щений. Это отобьет у нарушителя всякое желание иметь дело с Интернет. Пользователи могут также объявить бойкот товарам и услугам компании и вообще пере&shy;стать связываться с ней по Сети. И уж совсем редко, но все же случается и такое, что нарушителю лично доставляют массу беспокойства телефонными звонка&shy;ми часа в два ночи домой, вызовами по пейджеру, звон&shy;ками на работу.<BR></DIV>\r\n<DIV>Если обычный маркетинговый подход в этой среде не работает, то как же представить свой товар или услугу широкой публике? Некоторые, например электронный магазин «Hotwired» журнала «Wired», пробовали продавать место под рекламу в электронных публикаци&shy;ях. Изображение компании и гипертекстовая связь добавлялись на страницу в надежде на то, что чита&shy;тель не только запомнит название фирмы, но и перей&shy;дет к ее странице и сделает покупку. Более того, в Интернет существует более ста настоящих торговых центров, предоставляющих адреса всевозможных элек&shy;тронных магазинов по категориям. В ряде случаев они дают покупателям, твердо знающим, что им нужно, возможность легко и быстро найти желаемые товары и услуги.<BR></DIV>\r\n<DIV>Результаты таких публикаций и работы торговых цен&shy;тров, конечно же, не могут быть обобщены, а невоз&shy;можность совершать крупные сделки по соображени&shy;ям безопасности не позволяет сделать какие-либо выводы.<BR></DIV>\r\n<DIV>Например, при создании крупнейшей американской коммерческой сети PRODIGY учитывалась возмож&shy;ность подобных операций. Однако, пройдя и через рекламу, и через «торговые центры», PRODIGY изме&shy;нила структуру получения доходов, когда выяснилось, что пользователям нужно, скорее, средство общения, нежели возможность совершать покупки в режиме on&shy;line. А в некоторых случаях — таких как торговля цветами или программным обеспечением — дела шли как нельзя лучше. Так что успех предприятия в Ин&shy;тернет зависит не столько от умения торговца правильно подать себя, сколько от того, окажутся ли полезными его товары или услуги для пользователей.</DIV>\r\n<DIV>Существует множество объяснений, почему некоторые электронные магазины терпят неудачу (здесь не учитывается явные недостатки: плохой пользователь&shy;ский интерфейс, нехватки графики, неудобного ме&shy;ханизма оформления заказов, невозможности оплаты наличными и так далее). Однако, как правило, пове&shy;дение покупателей обуславливается следующими мо&shy;ментами:</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>• привычки: «Обычно я делаю покупки (хлеб, одежду и так далее) совсем не так»;</DIV>\r\n<DIV>• несоответствие цели: «Я сюда не за этим при&shy;шел»;</DIV>\r\n<DIV>• неизвестность: «Я не знаю, что там было, — я искал только то, что хотел найти»;</DIV>\r\n<DIV>• несовершенство систем поиска: «Мне был ну&shy;жен видеомагнитофон, но я не собирался про&shy;сматривать десять разных магазинов».<BR></DIV>\r\n<DIV>По сравнению с обычными средствами массовой ин&shy;формации — газетами, телевидением и радио, — кото&shy;рые, по сути, предназначены для передачи коммерче&shy;ских сообщений, Интернет довольно пассивен в смысле проведения маркетингового комплекса. Вы просто де&shy;лаете вывеску и ждете посетителей.</DIV>\r\n<DIV>&nbsp;</DIV>\r\n<H5><B>&nbsp;Незнание потребителей</B></H5>\r\n<DIV>&nbsp;</DIV>\r\n<DIV>Если разобрались с незнанием реальных объемов рынка сбыта и потребительской пассивностью, то что сказать о маркетинге, основанном на достигнутых ре&shy;зультатах и обратной связи с покупателями? Другими словами, не достаточно ли определить один раз марке&shy;тинговые мероприятия и проводить их, основываясь на собственном опыте, пусть и небольшом? Можно ли не изменять, не адаптировать политику маркетинга, рекламу, основанную лишь на отзывах посетителей? Следующая информация поможет ответить на эти вопросы:</DIV>\r\n<DIV>• возраст и пол пользователей;</DIV>\r\n<DIV>• как пользователи узнают о вашем магазине;</DIV>\r\n<DIV>• что они ищут, находят ли они нужный товар;</DIV>\r\n<DIV>• почему они совершают (или не совершают) по&shy;купки.<BR></DIV>\r\n<DIV>В отличие от пассивной, нисходящей на потребителя модели маркетинга, Интернет позволяет осуществить взаимодействие поставщиков и потребителей, при котором последние сами становятся поставщиками (в частности, поставщиками информации о своих потребностях). Такой подход получил название "grassroots" ("корни травы").<BR></DIV>\r\n<DIV>Поскольку Интернет представляет собой совершенно новую коммуникационную среду в отличие от традиционных средств информации, во многих случаях некоторые приемы и средства маркетинга не могут быть применены в их существующей форме.<BR></DIV>\r\n<DIV>Каким же образом Интернет трансформирует функцию маркетинга? При рассмотрении модели, использующей для рекламы традиционные средства массовой информации, оказывается, что использование Интернет дает возможность потенциальным клиентам не выступать в роли пассивной аудитории, а самостоятельно принимать решение, следует ли им знакомиться с конкретной рекламной информацией.<BR></DIV>\r\n<DIV>При работе в Интернет фирма, раскрывая и удовлетворяя потребности клиента, должна стремиться внести свой вклад в разработку новых идей и методов для электронной коммерции.</DIV>\r\n<DIV>Таким образом, новая роль маркетинга помимо удовлетворения потребностей клиента непосредственно включает в себя "альтруистическую", кооперативную цель облегчения развития рынка. Это полностью соответствует положениям доклада Национальной Академии Наук (Конгресс США, 1994): "В новых условиях деловой среды, сотрудничество может принести гораздо больше пользы, чем конкуренция, и информационная открытость более плодотворна чем информационный контроль".</DIV>\r\n<DIV>В новых условиях менеджерам по маркетингу следует сосредоточиться на разработке новых идей и принципов, поскольку "механический" перенос в среду Интернет старых форм, скорее всего, будет малоэффективным. Недостаточно, например, будет просто поместить в соответствующий раздел телеконференции Usenet корректное и ненавязчивое объявление. Новая среда, предлагая новые возможности, в свою очередь, требует разработки новых подходов к рекламе, сбыту, расчетам с клиентами и другим аспектам коммерческой деятельности.</DIV>', '', 0, 1208172898, '', '', '1', '');
INSERT INTO `phpshop_page` VALUES (6, 'Новые подходы к рекламе, сбыту, расчетам с клиентами', 'page6', 1, '', '', '<DIV>Среда Интернет располагает возможностью не только предоставить клиенту самую полную информацию о товарах и услугах, но и в свою очередь получить от клиентов необходимые для осуществления целей маркетинга данные в гораздо большем объеме по сравнению с традиционными средствами массовой информации.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Кроме этого, как уже отмечалось выше потребитель, играя более активную роль в процессе маркетинга, в силу своей лучшей осведомленности быстрее и вернее принимает решение к своей максимальной выгоде. Очевидно, что это не может не привести к снижению цен на информацию и повышению ее качества, т.е. ранок информации становится более эффективным.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Весьма важной представляется необходимость разработки удобных и надежных систем взаиморасчета клиентов и поставщиков с использованием Интернет. Представляется, например, нецелесообразным простая передача номера кредитной карточки и другой конфиденциальной информации в открытую, т.к. эта информация может отслеживаться. Криптографирование конфиденциальной информации снимает эту проблему, но при этом все же остаются такие проблемы как стоимость мелких платежей и превышения кредита. В качестве альтернативы рядом разработчиков предлагается вариант т.н. цифрового наличного расчета, когда фирма - банк открывает счета, на которые клиенты могут переводить и снимать с них виртуальные "монеты" с помощью специально разработанных для Интернет программ-"digi-cash" или "e-cash", использующих систему паролей и криптографирование.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Следует добавить, что наряду с вышесказанным, большое значение имеет наличие эффективных и удобных "интеллектуальных" средств навигации в том поистине бескрайнем "море" информации и коммерческих предложений, которое уже сейчас представляет собой Интернет. Весьма удачными примерами в этом направлении являются The Global Network Navigator и интерактивный Special Connections List публикуемый Скоттом Яновым (Scott Yanoff), а также ряд отраслевых каталогов, например, по авиакосмической тематике (Aerospace Engineering: A Guide to Internet Resources) или инвестициям (All the Investment Links. Direct links to all the resources in the PFC Investment Index). При этом маркетологам следует пристально изучать подходы и приемы, используемые "искушенными" в области информационного поиска клиентами при работе с такими каталогами.</DIV>\r\n<DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Новые возможности потребителей в части контроля над информационным обменом, например, были использованы фирмой Digital Equipment, когда она пригласила всех желающих принять участие в демонстрационных испытаниях своей новой системы Alpha AXP в интерактивном режиме через Интернет. Другим примером может послужить совместное управление из разных мест моделью марсохода, разработанного в России, причем к испытаниям были допущены самые разные категории желающих, начиная от сотрудников NASA и кончая школьными учителями и студентами.</DIV>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Интернет также в некоторой степени устраняет разницу между большим и малым бизнесом, местными и всемирными корпорациями, сельскохозяйственным и промышленным производством и позволяет проникнуть на рынок практически всем желающим. ', '', 0, 1208172974, '', '', '1', '');

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_page_categories`
-- 

CREATE TABLE `phpshop_page_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `num` int(64) NOT NULL default '1',
  `parent_to` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_to` (`parent_to`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_page_categories`
-- 

INSERT INTO `phpshop_page_categories` VALUES (1, 'Как создать интернет-магазин', 0, 0, '');

-- --------------------------------------------------------

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
-- Дамп данных таблицы `phpshop_payment`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=37 ;

-- 
-- Дамп данных таблицы `phpshop_products`
-- 

INSERT INTO `phpshop_products` VALUES (1, 2, 'Утюг BINATONE SI 2000 A', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', 'Утюг с паром SI-2000A<BR>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы<BR>Возможность сухой глажки<BR>Функция самоочистки<BR>Место для намотки шнура<BR>Мерный стаканчик в комплекте', 288, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208156868, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img1_15201s.jpg', '/UserFiles/Image/Trial/img1_15201.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 100, 100, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (2, 2, 'Утюг BINATONE SI-2000 WG', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', 430, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208157037, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img2_20923s.jpg', '/UserFiles/Image/Trial/img2_20923.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 100, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (3, 2, 'Утюг BINATONE SI 2600 W', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', 1000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208157288, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img3_27387s.jpg', '/UserFiles/Image/Trial/img3_27387.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (4, 2, 'Утюг BINATONE SI 2800', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', '<P>Мощность 1400 Вт<BR>Различные режимы парообразования<BR>Турбо пар<BR>Спрей<BR>Алюминиевая подошва<BR>Различные температурные режимы</P>', 1500, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208157679, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img4_97080s.jpg', '/UserFiles/Image/Trial/img4_97080.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (5, 3, 'Машинка для стрижки PHILIPS QC 5000', 'Самый простой способ идеально подстричь волосы в домашних условиях. Машинка для стрижки волос Complete Control дает максимальный контроль и прекрасные результаты.', 'Самый простой способ идеально подстричь волосы в домашних условиях. Машинка для стрижки волос Complete Control дает максимальный контроль и прекрасные результаты.', 700, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164534, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img5_13875s.jpg', '/UserFiles/Image/Trial/img5_13875.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (6, 3, 'Машинка для стрижки PHILIPS QC 5050', 'Самый простой способ идеально подстричь волосы в домашних условиях. Машинка для стрижки волос Complete Control дает максимальный контроль и прекрасные результаты.', 'Самый простой способ идеально подстричь волосы в домашних условиях. Машинка для стрижки волос Complete Control дает максимальный контроль и прекрасные результаты.', 1000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164510, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img6_94790s.jpg', '/UserFiles/Image/Trial/img6_94790.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (7, 3, 'Машинка для стрижки PHILIPS QC 5070', 'Philishave Super Easy. Простая в использовании машинка для стрижки волос с 8 настройками длины (1-21 мм), гибкой расческой Flexcomb и фиксатором длины. Короткие стрижки в домашних условиях — быстро и просто.', 'Philishave Super Easy. Простая в использовании машинка для стрижки волос с 8 настройками длины (1-21 мм), гибкой расческой Flexcomb и фиксатором длины. Короткие стрижки в домашних условиях — быстро и просто.', 2400, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164613, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img7_21593s.jpg', '/UserFiles/Image/Trial/img7_21593.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (8, 3, 'Машинка для стрижки PHILIPS QC 5099', 'Philishave MaxPricision. Вы сможете в домашних условиях создать практически любую профессиональную стрижку. Машинка для стрижки волос MaxPrecision имеет 15 настроек длины (1-41 мм) и включает прецизионный триммер для создания аккуратных контуров.', 'Philishave MaxPricision. Вы сможете в домашних условиях создать практически любую профессиональную стрижку. Машинка для стрижки волос MaxPrecision имеет 15 настроек длины (1-41 мм) и включает прецизионный триммер для создания аккуратных контуров.', 2600, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208164686, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img8_19242s.jpg', '/UserFiles/Image/Trial/img8_19242.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (9, 4, 'Электрочайник BINATONE AEJ-1501 CG/WG', 'Защита от работы без воды Автоотключение при закипании Вместимость 1.5 л Шкала уровня воды Мощность 2000 Вт Световой индикатор работы', 'Защита от работы без воды Автоотключение при закипании Вместимость 1.5 л Шкала уровня воды Мощность 2000 Вт Световой индикатор работы', 300, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165004, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img9_18900s.jpg', '/UserFiles/Image/Trial/img9_18900.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (10, 4, 'Электрочайник BINATONE CEJ-1012 CP', 'Тип нагревательного элемента: скрытый (дисковый) Покрытие нагревательного элемента: нержавеющая сталь Мощность: 1500 Вт Объем: 1 л Фильтр против накипи: синтетический', 'Тип нагревательного элемента: скрытый (дисковый) Покрытие нагревательного элемента: нержавеющая сталь Мощность: 1500 Вт Объем: 1 л Фильтр против накипи: синтетический', 700, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165103, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img10_16509s.jpg', '/UserFiles/Image/Trial/img10_16509.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (11, 4, 'Электрочайник BINATONE CEJ-3300 CP/SG/T/WG', 'Тип нагревательного элемента: скрытый (дисковый) Покрытие нагревательного элемента: нержавеющая сталь Мощность (Вт): 2200 Объем (л): 2 Фильтр против накипи: синтетический', 'Тип нагревательного элемента: скрытый (дисковый) Покрытие нагревательного элемента: нержавеющая сталь Мощность (Вт): 2200 Объем (л): 2 Фильтр против накипи: синтетический', 1000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165193, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img11_10500s.jpg', '/UserFiles/Image/Trial/img11_10500.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (12, 4, 'Электрочайник BINATONE CEJ-3500 BB/BS/CP', 'MAGIC - thermo control, 2200Вт, 2л., новая технология, позволяющая определять температуру воды в чайнике по цвету внутренней подсветки: - синяя - температура воды до 40°C, - желтая - температура воды от 40°C до 80°C,от 80°C - красная, корпус белый', 'MAGIC - thermo control, 2200Вт, 2л., новая технология, позволяющая определять температуру воды в чайнике по цвету внутренней подсветки: - синяя - температура воды до 40°C, - желтая - температура воды от 40°C до 80°C,от 80°C - красная, корпус белый', 875, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165278, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img12_17764s.jpg', '/UserFiles/Image/Trial/img12_17764.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (13, 6, 'Микроволновая печь DELONGHI MW 355', 'Механическое управление Таймер на 30 мин Звуковой сигнал Встроенные часы Мощность микроволн 700 Вт EMD Количество уровней мощности 5', 'Механическое управление Таймер на 30 мин Звуковой сигнал Встроенные часы Мощность микроволн 700 Вт EMD Количество уровней мощности 5', 1578, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208165769, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img13_15187s.jpg', '/UserFiles/Image/Trial/img13_15187.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (14, 6, 'Микроволновая печь MOULINEX AFM4 43', 'Объём 22 л Тип управления сенсорный Стеклянное блюдо 290 мм Выходная мощность микроволны, Вт 850 Потребляемая мощность гриля, Вт 1100 Нагревательный элемент гриля Тен Уровней мощности - 6', 'Объём 22 л Тип управления сенсорный Стеклянное блюдо 290 мм Выходная мощность микроволны, Вт 850 Потребляемая мощность гриля, Вт 1100 Нагревательный элемент гриля Тен Уровней мощности - 6', 3000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170805, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img14_72079s.jpg', '/UserFiles/Image/Trial/img14_72079.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (15, 6, 'Микроволновая печь SAMSUNG C-100 R-5', 'Объем - 20 л, Микроволновая печь с грилем, Мощность СВЧ - 750 Вт, Мощность гриля - 1100 Вт, 6 уровней мощности, Тип управления - механический, Решетка для гриля, БИО-керамическая эмаль, Таймер на 60 мин., Система С.Т.Р.', 'Объем - 20 л, Микроволновая печь с грилем, Мощность СВЧ - 750 Вт, Мощность гриля - 1100 Вт, 6 уровней мощности, Тип управления - механический, Решетка для гриля, БИО-керамическая эмаль, Таймер на 60 мин., Система С.Т.Р.', 1025, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166069, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img15_10754s.jpg', '/UserFiles/Image/Trial/img15_10754.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (16, 6, 'Микроволновая печь SAMSUNG CE-2833 NR', 'Микроволновая печь с грилем Объем - 23 л Мощность СВЧ - 850 Вт / гриля - 1110 Вт 6 уровней мощности Тип управления - тактовый +Dial БИО-керамическая эмаль Система С.Т.Р.', 'Микроволновая печь с грилем Объем - 23 л Мощность СВЧ - 850 Вт / гриля - 1110 Вт 6 уровней мощности Тип управления - тактовый +Dial БИО-керамическая эмаль Система С.Т.Р.', 2000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166144, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img16_23131s.jpg', '/UserFiles/Image/Trial/img16_23131.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (17, 7, 'Стиральная машина WHIRLPOOL AWO/D 43115', 'Технология Silver Nano Керамический нагреватель Класс энергосбережения - A Класс стирки - A Класс отжима - D Загрузка (кг) - 40 / 4,5 Габариты без упаковки (ШхГхВ, мм) 598 x 404 x 850', 'Технология Silver Nano Керамический нагреватель Класс энергосбережения - A Класс стирки - A Класс отжима - D Загрузка (кг) - 40 / 4,5 Габариты без упаковки (ШхГхВ, мм) 598 x 404 x 850', 7523, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166360, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img17_15624s.jpg', '/UserFiles/Image/Trial/img17_15624.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (18, 7, 'Стиральная машина CANDY Aquamatic 1000T-45', 'Габариты: высота (см) 69.5, ширина (см) 51, глубина (см) 44 Тип загрузки фронтальная Загрузка (кг) 3.5 Отжим (об/мин) 1000 Класс стирки A /Класс А энергоэффективности/ Класс отжима C Cтрана производитель: Италия', 'Габариты: высота (см) 69.5, ширина (см) 51, глубина (см) 44 Тип загрузки фронтальная Загрузка (кг) 3.5 Отжим (об/мин) 1000 Класс стирки A /Класс А энергоэффективности/ Класс отжима C Cтрана производитель: Италия', 2500, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208166430, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img18_17180s.jpg', '/UserFiles/Image/Trial/img18_17180.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (19, 7, 'Стиральная машина CANDY CNL 105', 'Размеры: высота (см) 85, ширина (см) 60, глубина (см) 52 Тип загрузки фронтальная Загрузка (кг) 5 Отжим (об/мин) 0-1000 Класс стирки A /Класс А энергоэффективности!/ Класс отжима C Cтрана производитель: Италия, Испания', 'Размеры: высота (см) 85, ширина (см) 60, глубина (см) 52 Тип загрузки фронтальная Загрузка (кг) 5 Отжим (об/мин) 0-1000 Класс стирки A /Класс А энергоэффективности!/ Класс отжима C Cтрана производитель: Италия, Испания', 8020, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167110, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img19_20468s.jpg', '/UserFiles/Image/Trial/img19_20468.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (20, 7, 'Стиральная машина CANDY Aquamatic 800T-45', 'Габариты: высота (см) 69.5, ширина (см) 51, глубина (см) 44 Тип загрузки фронтальная Загрузка (кг) 3.5 Отжим (об/мин) 800 Класс стирки A /Класс А энергоэффективности/ Класс отжима D Cтрана производитель: Италия', 'Габариты: высота (см) 69.5, ширина (см) 51, глубина (см) 44 Тип загрузки фронтальная Загрузка (кг) 3.5 Отжим (об/мин) 800 Класс стирки A /Класс А энергоэффективности/ Класс отжима D Cтрана производитель: Италия', 11230, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167185, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img20_12661s.jpg', '/UserFiles/Image/Trial/img20_12661.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (21, 8, 'Хлебопечка MOULINEX OW 2000', 'Мощность 610 Вт 12 режимов приготовления 68 различных вариантов приготовления хлеба Съемная чаша с антипригарным покрытием Функция поддержания выпечки в горячем состоянии Объем: 500, 750, 1000 г', 'Мощность 610 Вт 12 режимов приготовления 68 различных вариантов приготовления хлеба Съемная чаша с антипригарным покрытием Функция поддержания выпечки в горячем состоянии Объем: 500, 750, 1000 г', 2005, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167367, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img21_66070s.jpg', '/UserFiles/Image/Trial/img21_66070.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (22, 8, 'Хлебопечка KENWOOD BM 250', 'Вес выпечки от 500 гр до 1 кг. Функция позволяющая приготовить хлеба за 58 мин. Возможность выбора цвета корочки. Мощность: 480 Вт. 12 программ.', 'Вес выпечки от 500 гр до 1 кг. Функция позволяющая приготовить хлеба за 58 мин. Возможность выбора цвета корочки. Мощность: 480 Вт. 12 программ.', 2000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167429, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img22_40627s.jpg', '/UserFiles/Image/Trial/img22_40627.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (23, 8, 'Хлебопечка KENWOOD BM 256', 'Серия: Principio Мощность, Вт: 2600 Внутреннее покрытие - алюминий Тип управления - механический Режимы работы духовки - 2 Термостат - есть Тип гриля - тен', 'Серия: Principio Мощность, Вт: 2600 Внутреннее покрытие - алюминий Тип управления - механический Режимы работы духовки - 2 Термостат - есть Тип гриля - тен', 1863, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167517, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img23_60070s.jpg', '/UserFiles/Image/Trial/img23_60070.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (24, 8, 'Хлебопечка KENWOOD BM 350', 'Вес выпечки от 500 гр до 1 кг. Функция позволяющая приготовить хлеба за 58 мин. Возможность выбора цвета корочки. Мощность: 480 Вт. 12 программ. Корпус из нержавеющей стали с белой пластиковой крышкой и контрольной панелью.', 'Вес выпечки от 500 гр до 1 кг. Функция позволяющая приготовить хлеба за 58 мин. Возможность выбора цвета корочки. Мощность: 480 Вт. 12 программ. Корпус из нержавеющей стали с белой пластиковой крышкой и контрольной панелью.', 3000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208167599, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img24_92740s.jpg', '/UserFiles/Image/Trial/img24_92740.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (25, 10, 'ЖК-телевизор SONY KDL-40V2500', 'Новая серия V с диагональю 46" и поддержкой формата HD обладает эксклюзивными характеристиками от Sony: “Создание живой картинки”, “BRAVIA ENGINE” и высококачественная ЖК-панель, обеспечивающая высокое качество изображения. Серия также включает расширенные возможности подключения и удобные функции.', 'Новая серия V с диагональю 46" и поддержкой формата HD обладает эксклюзивными характеристиками от Sony: “Создание живой картинки”, “BRAVIA ENGINE” и высококачественная ЖК-панель, обеспечивающая высокое качество изображения. Серия также включает расширенные возможности подключения и удобные функции.', 30000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170201, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img25_89668s.jpg', '/UserFiles/Image/Trial/img25_89668.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (26, 10, 'ЖК-телевизор SONY KDL-40S2000', 'Новая серия S с диагональю 40" - это цифровые ЖК-телевизоры с высоким качеством изображения, которое обеспечивается системой “BRAVIA ENGINE” и высококачественной ЖК-панелью', 'Новая серия S с диагональю 40" - это цифровые ЖК-телевизоры с высоким качеством изображения, которое обеспечивается системой “BRAVIA ENGINE” и высококачественной ЖК-панелью', 25000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170276, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img26_20400s.jpg', '/UserFiles/Image/Trial/img26_20400.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (27, 10, 'ЖК-телевизор PHILIPS 42PF5421/10', 'В новой серии V с диагональю 32" и поддержкой формата HD используются эксклюзивные характеристики от Sony: “Live Colour Creation”, BRAVIA ENGINE и высококачественная ЖК-панель. Серия также имеет расширенные возможности подключения и удобные функции.', 'В новой серии V с диагональю 32" и поддержкой формата HD используются эксклюзивные характеристики от Sony: “Live Colour Creation”, BRAVIA ENGINE и высококачественная ЖК-панель. Серия также имеет расширенные возможности подключения и удобные функции.', 32000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170345, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img27_20637s.jpg', '/UserFiles/Image/Trial/img27_20637.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (28, 10, 'ЖК-телевизор SONY KDL-32S2000', 'Диагональ 81 см, 2&#215;10, 1366&#215;768, совместим с HDTV, изображениу DNLe, усилитель LNA+, возможность использования PC, матрица типа S-PVA, контраст 1000:1, яркость 500 Кд/м&#178;, интерфейс HDMI, функции «Картинка в картинке» и «Двойной экран», FM-тюнер, стерео NICAM, звучание SRS TruSurround XT, телетекст: 1000 страниц, эргономичный пульт ДУ', 'Диагональ 81 см, 2&#215;10, 1366&#215;768, совместим с HDTV, изображениу DNLe, усилитель LNA+, возможность использования PC, матрица типа S-PVA, контраст 1000:1, яркость 500 Кд/м&#178;, интерфейс HDMI, функции «Картинка в картинке» и «Двойной экран», FM-тюнер, стерео NICAM, звучание SRS TruSurround XT, телетекст: 1000 страниц, эргономичный пульт ДУ', 35000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208170407, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img28_22696s.jpg', '/UserFiles/Image/Trial/img28_22696.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (29, 11, 'Цифровой фотоаппарат SONY DSC-H5 / Black', 'Камера Cyber-shot H5 - будьте в гуще событий: двойная система повышения четкости снимка, 7,2 эффективных мегапикселей, объектив Carl Zeiss® с 12-кратным оптическим зумом, суперширокий гибридный ЖК-экран Clear Photo 3", полная ручная установка экспозиции, батарея длительного срока службы STAMINA.', 'Камера Cyber-shot H5 - будьте в гуще событий: двойная система повышения четкости снимка, 7,2 эффективных мегапикселей, объектив Carl Zeiss® с 12-кратным оптическим зумом, суперширокий гибридный ЖК-экран Clear Photo 3", полная ручная установка экспозиции, батарея длительного срока службы STAMINA.', 10000, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171095, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img29_10321s.jpg', '/UserFiles/Image/Trial/img29_10321.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (30, 11, 'Цифровой фотоаппарат SONY DSC-T10 / Silver', 'Cyber-shot T10 – стильная и тонкая цифровая камера с двойной системой повышения четкости, сочетающей возможности стабилизатора Super SteadyShot и высокую чувствительность, с разрешением 7,2 эффективных мегапикселов, объективом ZEISS с 3-кратным оптическим увеличением и 2,5-дюймовым ЖК-дисплеем.', 'Cyber-shot T10 – стильная и тонкая цифровая камера с двойной системой повышения четкости, сочетающей возможности стабилизатора Super SteadyShot и высокую чувствительность, с разрешением 7,2 эффективных мегапикселов, объективом ZEISS с 3-кратным оптическим увеличением и 2,5-дюймовым ЖК-дисплеем.', 9800, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171183, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img30_20017s.jpg', '/UserFiles/Image/Trial/img30_20017.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (31, 11, 'Цифровой фотоаппарат SONY DSC-T50 / Red', 'Фотокамера Cyber-shot T50 с двойной системой повышения четкости снимка. Большой сенсорный ЖК-экран 3,0 дюйма с функцией "Показ снимков под музыку", ПЗС-матрица с 7,2 эффективными мегапикселами, объектив Carl Zeiss® с оптическим зумом 3х, батарея STAMINA - и все это в стильном алюминиевом корпусе.', 'Фотокамера Cyber-shot T50 с двойной системой повышения четкости снимка. Большой сенсорный ЖК-экран 3,0 дюйма с функцией "Показ снимков под музыку", ПЗС-матрица с 7,2 эффективными мегапикселами, объектив Carl Zeiss® с оптическим зумом 3х, батарея STAMINA - и все это в стильном алюминиевом корпусе.', 7963, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171271, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img31_16234s.jpg', '/UserFiles/Image/Trial/img31_16234.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (32, 11, 'Цифровой фотоаппарат SONY DCS-W40', 'Модель Cyber-shot W40 - изящный дизайн в черном цвете: 6,0 эффективных мегапикселей, высокая чувствительность ISO для более четких снимков, 3-кратный зум-объектив Carl Zeiss®, яркий ЖК-экран 2 дюйма, батарея длительного срока службы STAMINA, стильная передняя панель. ', 'Модель Cyber-shot W40 - изящный дизайн в черном цвете: 6,0 эффективных мегапикселей, высокая чувствительность ISO для более четких снимков, 3-кратный зум-объектив Carl Zeiss®, яркий ЖК-экран 2 дюйма, батарея длительного срока службы STAMINA, стильная передняя панель. ', 5890, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171352, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img32_23078s.jpg', '/UserFiles/Image/Trial/img32_23078.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (33, 12, 'MP3-плеер DEX MPX-152 (1Gb) White/Black', '1 Gb, 1.5 дюйма цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheizer', '1 Gb, 1.5 дюйма цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheizer', 1200, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171476, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img33_11122s.jpg', '/UserFiles/Image/Trial/img33_11122.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (34, 12, 'MP3-плеер DEX MPX-153 (1Gb) Red/Silver', '1 Gb, 1.5 дюйма цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheizer', '1 Gb, 1.5 дюйма цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheizer', 1110, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171539, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img34_12151s.jpg', '/UserFiles/Image/Trial/img34_12151.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (35, 12, 'MP3-плеер DEX MPX-156 (2Gb) Black/Silver', '2 Gb, 1.5 дюйма цветной ЖК дисплей, 128x128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники', '2 Gb, 1.5 дюйма цветной ЖК дисплей, 128x128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV, MTV, функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники', 900, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171609, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img35_18833s.jpg', '/UserFiles/Image/Trial/img35_18833.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `phpshop_products` VALUES (36, 12, 'MP3-плеер DEX MPX-186 (2Gb) Black / White', '2 Gb, 1.8" цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV(конвертер в комплекте), функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheiser MX400RC.', '2 Gb, 1.8" цветной ЖК дисплей, 128*128 пикс., USB-2.0, FM-тюнер, MP1, MP2, MP3, WMA, WMV, ASF, WAV-воспр., фото и графика в форматах JPEG, BMP, воспроизв.видеофайлов AMV(конвертер в комплекте), функц. диктофона, встр. Li-Ion батарея, зарядн. устр. в комплекте, наушники Sennheiser MX400RC.', 1500, 0, '', '1', '1', '', '1', '', '', 0x4e3b, '', 0, '1', '', '0', 1208171719, '', 1, '', '0', '', '', '', '0', '', '/UserFiles/Image/Trial/img36_16386s.jpg', '/UserFiles/Image/Trial/img36_16386.jpg', 0x613a343a7b733a31313a226269645f656e61626c6564223b733a303a22223b733a333a22626964223b733a303a22223b733a31323a22636269645f656e61626c6564223b733a303a22223b733a343a2263626964223b733a303a22223b7d, '0', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_search_base`
-- 

CREATE TABLE `phpshop_search_base` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `uid` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_search_base`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=14 ;

-- 
-- Дамп данных таблицы `phpshop_search_jurnal`
-- 

INSERT INTO `phpshop_search_jurnal` VALUES (1, 'mp3', 4, '1208183696', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (2, 'mp3', 4, '1208183696', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (3, 'mp3', 4, '1208183749', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (4, 'mp3', 4, '1208183763', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (5, 'mp3', 4, '1208183788', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (6, 'mp3', 4, '1208183800', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (7, 'mp3', 4, '1208183806', 'http://eetrial.mysoft.ru/shop/UID_35.html', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (8, 'mp3', 4, '1208183862', 'http://eetrial.mysoft.ru/search/', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (9, 'mp3', 4, '1208183891', 'http://eetrial.mysoft.ru/search/', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (10, 'mp3', 4, '1208183908', 'http://eetrial.mysoft.ru/search/', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (11, 'mp3', 4, '1208183943', 'http://eetrial.mysoft.ru/search/', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (12, 'mp3', 4, '1208183974', 'http://eetrial.mysoft.ru/search/', 0, 1);
INSERT INTO `phpshop_search_jurnal` VALUES (13, 'mp3', 4, '1208183996', 'http://eetrial.mysoft.ru/search/', 0, 1);

-- --------------------------------------------------------

-- 
-- Структура таблицы `phpshop_servers`
-- 

CREATE TABLE `phpshop_servers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `host` varchar(255) NOT NULL default '',
  `enabled` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_servers`
-- 


-- --------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_shopusers`
-- 

INSERT INTO `phpshop_shopusers` VALUES (1, 'dennion', 'MTIzNDU2', '1208239119', 'den@phpshop.ru', 'Денис', '', '', '', '', '1', '0', '', '');

-- --------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_shopusers_status`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_sort`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `phpshop_sort_categories`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

-- 
-- Дамп данных таблицы `phpshop_system`
-- 

INSERT INTO `phpshop_system` VALUES (1, 'Интернет-магазин PHPShop', 'PHPShop', 10, 0, 6, '0', 'PHPshop_1', 'support@phpshop.ru', 'Купить технику с бесплатной доставкой', 'детские, товары, купить, бесплатная, доставка, MP3, проигрыватели, автомобильная, электроника, бытовая, техника, аудио, видео, фото, холодильники, телевизоры, плазменные, панели, DEX, SONY, PHILIPS, TEFAL, ROWENTA, SAMSUNG, KRUPS, BINATONE, KENWOOD', 6, 4, 4, '(495) 105-05-50', 0x613a393a7b733a383a226f72675f6e616d65223b733a31303a22cecece20cde5f2f0e8ea223b733a31323a226f72675f75725f6164726573223b733a363a22cceef1eae2e0223b733a393a226f72675f6164726573223b733a363a22cceef1eae2e0223b733a373a226f72675f696e6e223b733a31303a2237373230353238383233223b733a373a226f72675f6b7070223b733a393a22373732303031303031223b733a393a226f72675f7363686574223b733a32303a223430373032383130343030313630303030303830223b733a383a226f72675f62616e6b223b733a31313a22cac120d1c4cc2dc1c0cdca223b733a373a226f72675f626963223b733a393a22303434353833363835223b733a31343a226f72675f62616e6b5f7363686574223b733a32303a223330313031383130363030303030303030363835223b7d, '2', '5', '1208173663', '18', '1', 0x613a33343a7b733a363a22696d675f776d223b733a303a22223b733a353a22696d675f77223b733a333a22333030223b733a353a22696d675f68223b733a333a22333030223b733a363a22696d675f7477223b733a333a22313030223b733a363a22696d675f7468223b733a333a22313030223b733a31343a2277696474685f706f64726f626e6f223b733a323a223930223b733a31323a2277696474685f6b7261746b6f223b733a323a223930223b733a31353a226d6573736167655f656e61626c6564223b733a313a2231223b733a31323a226d6573736167655f74696d65223b733a323a223630223b733a31353a226465736b746f705f656e61626c6564223b4e3b733a31323a226465736b746f705f74696d65223b4e3b733a383a226f706c6174615f31223b733a313a2231223b733a383a226f706c6174615f32223b733a313a2231223b733a383a226f706c6174615f33223b733a313a2231223b733a383a226f706c6174615f34223b4e3b733a383a226f706c6174615f35223b733a313a2231223b733a383a226f706c6174615f36223b733a313a2231223b733a383a226f706c6174615f37223b733a313a2231223b733a383a226f706c6174615f38223b733a313a2231223b733a31343a2273656c6c65725f656e61626c6564223b4e3b733a31323a22626173655f656e61626c6564223b4e3b733a31313a22736d735f656e61626c6564223b4e3b733a31343a226e6f746963655f656e61626c6564223b733a313a2231223b733a31343a227570646174655f656e61626c6564223b733a313a2231223b733a373a22626173655f6964223b733a303a22223b733a393a22626173655f686f7374223b733a303a22223b733a343a226c616e67223b733a373a227275737369616e223b733a31333a22736b6c61645f656e61626c6564223b4e3b733a31303a2270726963655f7a6e616b223b733a303a22223b733a31383a22757365725f6d61696c5f6163746976617465223b733a313a2231223b733a31313a22757365725f737461747573223b733a313a2230223b733a393a22757365725f736b696e223b733a313a2231223b733a31323a22636172745f6d696e696d756d223b733a363a22313030303030223b733a31343a22656469746f725f656e61626c6564223b733a313a2231223b7d, 6, 'PHPShop – это готовое решение для быстрого создания Интернет магазина.', '@Podcatalog@, @Catalog@, @System@', '@Podcatalog@ - @Catalog@ - @System@', '@Podcatalog@, @Catalog@, @Generator@', '@Product@ - @Podcatalog@ - @Catalog@', '@Product@, @Podcatalog@, @Catalog@', '@Product@,@System@', '', '', '@Catalog@', '@Catalog@', '@Catalog@');

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

-- 
-- Дамп данных таблицы `phpshop_users`
-- 

INSERT INTO `phpshop_users` VALUES (1, 0x613a32313a7b733a353a2267626f6f6b223b733a353a22312d312d31223b733a343a226e657773223b733a353a22312d312d31223b733a373a2276697369746f72223b733a373a22312d312d312d31223b733a353a227573657273223b733a373a22312d312d312d31223b733a393a2273686f707573657273223b733a353a22312d312d31223b733a383a226361745f70726f64223b733a393a22312d312d312d312d31223b733a363a22737461747331223b733a353a22312d312d31223b733a353a227275706179223b733a353a22302d302d30223b733a31313a226e6577735f777269746572223b733a353a22312d312d31223b733a393a22706167655f73697465223b733a353a22312d312d31223b733a393a22706167655f6d656e75223b733a353a22312d312d31223b733a353a2262616e6572223b733a353a22312d312d31223b733a353a226c696e6b73223b733a353a22312d312d31223b733a333a22637376223b733a353a22312d312d31223b733a353a226f70726f73223b733a353a22312d312d31223b733a333a2273716c223b733a353a22302d312d31223b733a363a226f7074696f6e223b733a333a22302d31223b733a383a22646973636f756e74223b733a353a22312d312d31223b733a363a2276616c757461223b733a353a22312d312d31223b733a383a2264656c6976657279223b733a353a22312d312d31223b733a373a2273657276657273223b733a353a22312d312d31223b7d, 'root', 'cm9vdA==', 'support@phpshop.ru', '1', '\r\n', '', '', '', '');

-- --------------------------------------------------------

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
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

-- 
-- Дамп данных таблицы `phpshop_valuta`
-- 

INSERT INTO `phpshop_valuta` VALUES (4, 'Гривны', 'гр.', 'UAU', '13', 4, '1');
INSERT INTO `phpshop_valuta` VALUES (5, 'Доллары', '$', 'USD', '23.5', 0, '1');
INSERT INTO `phpshop_valuta` VALUES (6, 'Рубли', 'руб', 'RUR', '1', 1, '1');
