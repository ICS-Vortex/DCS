-- Добавление поля (Аєродром взлёта)
ALTER TABLE `flights` ADD COLUMN `takeoff_from` VARCHAR(128) NOT NULL;

-- Удаление ненужного поля коалиция.
ALTER TABLE `flights` DROP COLUMN `coalition`;