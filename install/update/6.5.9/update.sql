/*660*/
ALTER TABLE `phpshop_shopusers_status` ADD `cart_min` INT(11) NOT NULL DEFAULT '0';

/*661*/
ALTER TABLE `phpshop_order_status` ADD `bot_message` TEXT NOT NULL;
ALTER TABLE `phpshop_newsletter` ADD `bot_message` TEXT NOT NULL;