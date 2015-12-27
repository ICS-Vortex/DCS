CREATE TABLE IF NOT EXISTS `dcs_registration_tickets` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`pilot_id` INT NOT NULL,
`deadline` DATETIME NOT NULL
)ENGINE=MyISAM;

-- Индексирование
ALTER TABLE `dcs_registration_tickets` ADD INDEX `ix_dcs_registration_tickets`(`pilot_id`);
