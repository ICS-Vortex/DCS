-- Добавление индекса для таблицы пилотов
ALTER TABLE pilots ADD INDEX `ix_pilots_nickname` (`nickname`);
-- Добавление колонки hash
ALTER TABLE pilots ADD COLUMN hash VARCHAR (128) NOT NULL;
-- Добавление индекса для hash
ALTER TABLE pilots ADD INDEX `ix_hash_index` (`hash`);