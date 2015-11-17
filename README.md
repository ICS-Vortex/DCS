# DCS online-statistics based on php scripts.

1. Настройка подключения к БД осуществляется в файле /system/application/config/database.php
Для смены данных корректного подключения к БД - измените следующие значения переменных

$db['default']['username'] = "root";//имя пользователя MySQL
$db['default']['password'] = "";//пароль
$db['default']['database'] = "statistics";//Название базы данных

на нужные значения.

2. Файлы видов находятся по пути /system/application/views/(названиеКонтроллера)
3. Файлы контроллеров находятся по пути /system/application/controllers/названиеКонтроллера.php
4. Файлы моделей, выполняющих запросы к Базе данных находятся по пути /system/application/models/названиеМодели.php

Доступ через браузер в директории проэкта закрыт.
Контроллер по умолчанию - 'statistics'.

5. Смена контроллера, загружаемого по умолчанию, выполняется в файле /system/application/config/routes.php
$route['default_controller'] = "statistics"; //Значение определяет контроллер, загружаемый по вызову индексного файла
проэкта (http://mysite.com/).

6. Указывайте базовый url вашего домена в файле /system/application/config/config.php

$config['base_url']	= "http://mysite.com/"; //

Значение переменной $config['index_page'] = ""; оставлять пустым.
