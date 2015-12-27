-- Удаление колонки IP-адреса
ALTER TABLE `server` DROP COLUMN `ip_adress`;
-- Добавление колонки name
ALTER TABLE server ADD COLUMN server_dcs VARCHAR (25);
-- Очистка таблицы server
TRUNCATE server;
-- Вставка нового значения
INSERT INTO `statistics`.`server` (`status` ,`server_dcs`) VALUES ('0', 'Server');
