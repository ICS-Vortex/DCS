-- Удаление ненужного поля.
ALTER TABLE pilots_dogfights DROP COLUMN victim;
-- Добавление поля Жертва
ALTER TABLE pilots_dogfights ADD COLUMN victim_id INT NOT NULL;
-- Добавление индекса для поля Жертва.
ALTER TABLE pilots_dogfights ADD INDEX `ix_victim_id` (`victim_id`);
--Добавление поля очков
ALTER TABLE pilots_dogfights ADD COLUMN points INT NOT NULL;