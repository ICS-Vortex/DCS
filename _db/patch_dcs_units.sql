-- Создание новой таблицы типов юнитов
CREATE TABLE `dcs_units_types` SELECT DISTINCT type_unit FROM `units`;
-- Добавление Primary Key
ALTER TABLE `dcs_units_types` ADD COLUMN id INT NOT NULL AUTO_INCREMENT PRIMARY KEY;
-- Удаление поля points
ALTER TABLE `dcs_units` DROP COLUMN `point`;
-- добавление индекса для поля name
ALTER TABLE `dcs_units` ADD INDEX `ix_name`(`name`);