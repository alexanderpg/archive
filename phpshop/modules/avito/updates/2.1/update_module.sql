UPDATE `phpshop_modules_avito_types` SET `name` = 'Аудио и видеотехника' WHERE `id` = 203;

INSERT INTO `phpshop_modules_avito_subtypes` (`id`, `name`, `type_id`) VALUES
(13, 'Аксессуары для автоакустики', 203),
(14, 'Магнитолы', 203),
(15, 'Автоакустика', 203),
(16, 'Видеорегистраторы', 203),
(17, 'Усилители', 203),
(18, 'Переходные рамки', 203),
(19, 'Короба и подиумы', 203),
(20, 'Другое', 203);

ALTER TABLE `phpshop_modules_avito_system` ADD `latitude` varchar(255) default '';
ALTER TABLE `phpshop_modules_avito_system` ADD `longitude` varchar(255) default '';