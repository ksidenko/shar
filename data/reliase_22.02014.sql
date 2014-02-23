ALTER TABLE  `photo` ADD  `is_main` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER  `path` ;

ALTER TABLE  `photo` ADD INDEX (  `article_id`, `is_main` ) ;