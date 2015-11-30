-- Индексирование поля очков
ALTER TABLE `dcs_awards` ADD INDEX `ix_dcs_awards`(`points`);