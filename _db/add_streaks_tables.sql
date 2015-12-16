-- Создание таблицы dcs_temporary_streaks
CREATE TABLE IF NOT EXISTS `dcs_temporary_streaks`(
`pilot_id` INT NOT NULL
)ENGINE=MyISAM;

-- Индексирование поля pilot_id
ALTER TABLE `dcs_temporary_streaks` ADD INDEX `ix_dcs_temporary_streaks`(`pilot_id`);
-- Добавление поля
ALTER TABLE dcs_temporary_streaks ADD COLUMN streak INT NOT NULL;

-- Создание таблицы dcs_best_streaks
CREATE TABLE IF NOT EXISTS `dcs_best_streaks`(
`pilot_id` INT NOT NULL,
`streak` INT NOT NULL
) ENGINE=MyISAM;

-- Индексирование поля pilot_id
ALTER TABLE `dcs_best_streaks` ADD CONSTRAINT `ix_dcs_best_streaks` UNIQUE(`pilot_id`);
