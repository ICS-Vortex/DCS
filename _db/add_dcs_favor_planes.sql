CREATE TABLE IF NOT EXISTS `dcs_favor_planes`(
`pilot_id` INT NOT NULL,
`plane` VARCHAR(64) NOT NULL
)ENGINE=MyISAM;

ALTER TABLE `dcs_favor_planes` ADD INDEX `ix_pilot_id`(`pilot_id`);
ALTER TABLE `dcs_favor_planes` ADD INDEX `ix_plane`(`plane`);