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

#Хотелки:
1. После посадки - отправлять количество израсходуваного Боекомплекта.
2. Цвет ника в списке статистики игроков - тем цветом за какую строну игрок чаще заходил
2.5. (ВАЖНО!!!) Добавить колонку "Score" ( общее количество очков) в табличку на главной последней колонкой!
3. (ВАЖНО!!!) Добавить колонку K/L - отношение воздушных побед к потерям самолёта. K/L = количество воздушных побед разделить на количество потерянных самолётов(если потерянных самолетов 0, то на 1)
4. (ВАЖНО!!!) Добавить колонку Air Streak - количество воздушных побед между смертями пилота.
5. Английская версия сайта статистики
6. Придумать формулу начисления очков и колонка с очками
7. Иконки вместо текстовых заголовков колонок со всплывающей подсказкой типа как href TITLE
8. счётчик онлайна(желательно графиком).
9. В событие left Добавлять UID пилота.
10. В расширенную статистику пилота добавить аутентичный лог-бук.
------------11. Писать категорию наземки при убийстве(событие killed). - СДЕЛАНО!-------------
12. Статистика по типам самолёта. Т.е. как в табличке на главной, только вместо имен пилотов - типы самолётов (P-51D, FW190 и тд)
13. Статистика по сторонам. Т.е. как в табличке на главной, только вместо имен пилотов - две стороны RED и BLUE
14. Добавить количество очков

#Баги:

1. Иногда, при входе юзера на сервер, в строке запроса приходит пустое имя игрока. Пример:
11/27/15 14:44:45;;entered the game;d928e94d6e2044fc6ee01a7bf699f00b
11/27/15 14:45:17;;joined RED
11/27/15 14:48:56;;joined SPECTATORS


2. Не работает выборка смертей (для victim) пилота на расширеной стататистике.

#Отчёты:
1. Поправил количество сбитий для игрока.
2. Добавил общее количество очков на Главную страницу.
3. Добавил коефициент K/L.
4. Добавил Текущий и Лучший стрик.