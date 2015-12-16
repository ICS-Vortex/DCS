-- Добавление индексов для pilot_id

ALTER TABLE `dcs_blueteam` ADD CONSTRAINT UNIQUE (pilot_id);
ALTER TABLE `dcs_redteam` ADD CONSTRAINT UNIQUE (pilot_id);
ALTER TABLE `dcs_spectators` ADD CONSTRAINT UNIQUE (pilot_id);
