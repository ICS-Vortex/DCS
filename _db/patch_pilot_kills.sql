--Удаление ненужных полей.
ALTER TABLE pilots_kills DROP COLUMN object;
ALTER TABLE pilots_kills DROP COLUMN ammunition;

-- Добавление новых полей
ALTER TABLE pilots_kills ADD COLUMN unit_id INT NOT NULL;
ALTER TABLE `pilots_kills` ADD INDEX `ix_unit_id`(`unit_id`);

ALTER TABLE pilots_kills ADD COLUMN unit_type_id INT NOT NULL;
ALTER TABLE `pilots_kills` ADD INDEX `ix_unit_type_id`(`unit_type_id`);

-- Добавление поля Очки
ALTER TABLE pilots_kills ADD COLUMN points INT NOT NULL;