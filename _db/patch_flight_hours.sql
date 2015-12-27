-- Добавление нового поля (Аєродром взлёта)
ALTER TABLE `flight_hours` ADD COLUMN `takeoff_from` VARCHAR(128);

-- Добавление нового поля (Аэродром посадки)
ALTER TABLE `flight_hours` ADD COLUMN `landed_at` VARCHAR(128);

-- Добавление автоинкремента
ALTER TABLE `flight_hours` ADD COLUMN id INT NOT NULL AUTO_INCREMENT PRIMARY KEY;