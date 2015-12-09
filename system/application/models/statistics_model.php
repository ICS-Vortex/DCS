<?php

if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Statistics_model extends Model
{
    public function __constructor()
    {
        parent::Model();
    }
    /***********������� ��������*********/
    // Полная очистка статистики!
    function clear_db()
    {
        $this->db->query("TRUNCATE dcs_blueteam");
        $this->db->query("TRUNCATE dcs_online");
        $this->db->query("TRUNCATE dcs_redteam");
        $this->db->query("TRUNCATE dcs_spectators");
        $this->db->query("TRUNCATE fail_flights");
        $this->db->query("TRUNCATE flights");
        $this->db->query("TRUNCATE flight_hours");
        $this->db->query("TRUNCATE pilots");
        $this->db->query("TRUNCATE pilots_death");
        $this->db->query("TRUNCATE pilots_dogfights");
        $this->db->query("TRUNCATE pilots_ejects");
        $this->db->query("TRUNCATE pilots_kills");
        $this->db->query("TRUNCATE pilots_lands");
        $this->db->query("TRUNCATE pilots_takeoffs");
        $this->db->query("TRUNCATE dcs_temporary_streaks");
        $this->db->query("TRUNCATE dcs_best_streaks");
        $this->db->query("TRUNCATE dcs_registration_tickets");
    }
    // Текущие полёты - список ников.
    function main_get_current_flights()
    {
        $query = $this->db->query("
                SELECT flights.pilot_id,
                    pilots.nickname AS nickname
                FROM flights
                LEFT JOIN pilots ON pilots.id=flights.pilot_id
            ");
        return $query->result_array();
    }

    //Список пилотов онлайн.
    function main_pilots_online()
    {
        $query = $this->db->query("
            SELECT dcs_online.pilot_id,
                pilots.nickname AS nickname
            FROM dcs_online
            LEFT JOIN pilots ON pilots.id=dcs_online.pilot_id
           ");
        return $query->result_array();
    }

    // Выборка статистики на главную страницу
    function main_get_all_flights()
    {
        $query = $this->db->query("
                SELECT pilots.nickname AS nickname,
                  pilots.id AS id,
                  flight_hours.total AS total_flights,
                  total_kills.total_kill AS total_kills,
                  count_death.death AS count_death,
                  fails_flights.fails AS total_fail,
                  dogfights.victims AS total_victims,
                  (IFNULL(total_air_points.air_points,0)+IFNULL(total_ground_points.ground_points,0)) AS points,
                  last_streak.streak AS last_streak
                FROM pilots
                LEFT JOIN
                     (SELECT pilot_id, SUM(total) AS total FROM flight_hours
                        GROUP BY pilot_id
                     )AS flight_hours
                ON flight_hours.pilot_id=pilots.id
                LEFT JOIN
                     (SELECT pilot_id, COUNT(unit_id) AS total_kill
                      FROM pilots_kills
                      GROUP BY pilot_id
                     )
                     AS total_kills
                ON total_kills.pilot_id=pilots.id
                LEFT JOIN
                       (SELECT pilot_id, COUNT( death ) AS death
                               FROM  `pilots_death`
                               GROUP BY pilot_id
                       ) AS count_death ON count_death.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id, COUNT( data )  AS fails
                                 FROM  `fail_flights`
                                 GROUP BY pilot_id
                                 ) AS fails_flights ON fails_flights.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(victim_id) AS victims
                            FROM pilots_dogfights
                            GROUP BY pilot_id
                )AS dogfights ON dogfights.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(streak) as streak FROM dcs_temporary_streaks GROUP BY pilot_id) AS last_streak
                  ON last_streak.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,SUM(points) AS ground_points FROM pilots_kills GROUP BY pilot_id)
                  AS total_ground_points ON total_ground_points.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,SUM(points) AS air_points FROM pilots_dogfights GROUP BY pilot_id)
                  AS total_air_points ON total_air_points.pilot_id=pilots.id
                ORDER BY points DESC
            ");
        return $query->result_array();
    }

    // Получение зрителей
    function get_spectators()
    {
        $query = $this->db->query("
            SELECT dcs_spectators.pilot_id AS id,
                    pilots.nickname AS nickname
            FROM dcs_spectators
            JOIN pilots ON pilots.id=dcs_spectators.pilot_id
            ");
        return $query->result_array();
    }

    //Список Красной команды
    function get_redteam()
    {
        $query = $this->db->query("
            SELECT dcs_redteam.pilot_id AS id,
                    pilots.nickname AS nickname,
                    dcs_redteam.plane AS plane
            FROM dcs_redteam
            JOIN pilots ON pilots.id=dcs_redteam.pilot_id
            ");
        return $query->result_array();
    }

    //Получение списка Синей команды
    function get_blueteam()
    {
        $query = $this->db->query("
            SELECT dcs_blueteam.pilot_id AS id,
                    pilots.nickname AS nickname,
                    dcs_blueteam.plane AS plane
            FROM dcs_blueteam
            JOIN pilots ON pilots.id=dcs_blueteam.pilot_id
            ");
        return $query->result_array();
    }

    //Проверка пилота по UID
    function check_nick($hash)
    {
        $query = $this->db->query("SELECT * FROM pilots WHERE licence='{$hash}'");
        return $query->row_array();
    }

    //Обновление никнейма пилота
    function update_nickname($id,$nickname){
        $this->db->query("UPDATE pilots SET nickname='{$nickname}' WHERE id={$id}");
    }

    //Добавление пилота в базу данных
    function add_pilot($nickname,$hash)
    {
        $this->db->query("INSERT IGNORE INTO pilots (nickname,licence) VALUES ('$nickname','$hash')");
    }

    //Проверка пилота по Никнейму
    function get_pilot_id($nickname)
    {
        $query = $this->db->query("SELECT id FROM pilots WHERE nickname='$nickname'");
        return $query->row_array();
    }

    //Получение пилота по UID
    function get_pilot_id_with_hash($hash){
        $query = $this->db->query("SELECT * FROM pilots WHERE licence='{$hash}'");
        return $query->row_array();
    }

    //Проверка жертвы по UID
    function check_victim_by_hash($hash){
        $query = $this->db->query("SELECT * FROM pilots WHERE licence='{$hash}'");
        return $query->row_array();
    }

    //Добавление нового полёта
    function add_new_flight($id, $time)
    {
        $this->db->query("INSERT INTO flights(pilot_id,flight) VALUES($id,'$time')");
    }

    //Новая ункция добавления полёта.
    function new_flight($flight){
        $this->db->insert('flights',$flight);
    }

    //Получение полёта по ID юзера.
    function get_start_flight($id)
    {
        $query = $this->db->query("
        SELECT
          flight AS last_flight,
          takeoff_from
        FROM flights
        WHERE pilot_id=$id
        ORDER BY flight DESC LIMIT 1

        ");
        return $query->row_array();
    }

    //Добавление налёта в базу
    function add_total_flight($data)
    {
        $this->db->insert('flight_hours', $data);
    }

    //Очистка полёта по ID юзера.
    function clear_flights($id)
    {
        $this->db->query("DELETE FROM flights WHERE pilot_id=$id");
    }

    //Получение жертвы по Никнейму.
    function find_victim($nickname)
    {
        $query = $this->db->query("SELECT nickname AS victim,id FROM pilots WHERE nickname='$nickname'");
        return $query->row_array();
    }

    // Получение тимкила TODO Старая функция.
    function get_teamkill($id, $victim_id)
    {
        $query = $this->db->query("SELECT * FROM dcs_redteam WHERE pilot_id='$id' OR pilot_id=$victim_id");
        return $query->num_rows();
    }

    //Добавление нового Креша (уничтожение ЛА)
    function add_fail_crash($id, $time)
    {
        $this->db->query("INSERT INTO fail_flights(pilot_id,data) VALUES($id,'$time')");
    }

    //Добавление убития игрока TODO Ненужная функция
    function add_victim($id, $victim, $time, $friendly)
    {
        $this->db->query("INSERT INTO pilots_dogfights(pilot_id,victim,data,friendly) VALUES ($id,'$victim','$time',$friendly)");
    }

    //Добавление убития игрока
    function add_new_kill($data)
    {
        $this->db->insert('pilots_kills', $data);
    }

    //Получение всех текущих полётов.
    function get_all_current_flights()
    {
        $query = $this->db->query("SELECT * FROM flights");
        return $query->result_array();
    }

    //Получение списка пилотов онлайн.
    function get_online_all()
    {
        $query = $this->db->query("SELECT * FROM dcs_online");
        return $query->result_array();
    }

    //Добавление налёта всех незаконченных вылетов (событие Server Stop)
    function add_not_ended_flights($values)
    {
        $this->db->query("INSERT INTO flight_hours (pilot_id,start_flight,end_flight,total,takeoff_from) VALUES $values");
    }

    //Удаление полёта по ID пилота
    function delete_all_flights($id)
    {
        $this->db->query("DELETE FROM flights WHERE pilot_id=$id");
    }

    //Добавление смерти
    function add_death($data)
    {
        $this->db->insert('pilots_death', $data);
    }

    // Взлёт
    function add_takeoff($id, $time)
    {
        $this->db->query("INSERT INTO pilots_takeoffs(pilot_id,data) VALUES($id,'$time')");
    }

    // Посадка
    function add_landing($id, $time)
    {
        $this->db->query("INSERT INTO pilots_lands(pilot_id,data) VALUES ($id,'$time')");
    }

    //Добавление зрителя
    function add_spectator($id, $time)
    {
        $this->db->query("INSERT IGNORE INTO dcs_spectators (pilot_id,data) VALUES ($id,'$time')");
    }

    // Проверка зрителя по ID
    function check_spectator($id)
    {
        $query = $this->db->query("SELECT * FROM dcs_spectators WHERE pilot_id=$id");
        return $query->result_array();
    }

    //Получение списка всех зрителей
    function get_all_spectators()
    {
        $query = $this->db->query("SELECT * FROM dcs_spectators");
        return $query->result_array();
    }

    //Удаление из списка зрителей по ID пилота
    function delete_from_spectators($id)
    {
        $this->db->query("DELETE FROM dcs_spectators WHERE pilot_id={$id}");
    }

    //Запись пилота в таблицу Красной команды
    function join_red($id, $time, $plane)
    {
        $this->db->query("
            INSERT INTO dcs_redteam(pilot_id,data,plane) VALUES ($id,'$time','$plane')
            ON DUPLICATE KEY UPDATE pilot_id=VALUES(plane) AND data=VALUES(data);

        ");
    }

    //Запись пилота в таблицу Синей команды
    function join_blue($id, $time, $plane)
    {
        $this->db->query("
          INSERT INTO dcs_blueteam(pilot_id,data,plane) VALUES ($id,'$time','$plane')
          ON DUPLICATE KEY UPDATE pilot_id=VALUES(plane) AND data=VALUES(data);

        ");
    }

    //обновление ЛА в таблице Красной команды TODO Старая функция
    function update_red_pilot_plane($id, $plane)
    {
        $this->db->query("UPDATE dcs_redteam SET plane='$plane' WHERE pilot_id=$id");
    }

    //обновление ЛА в таблице Синей команды TODO Старая функция
    function update_blue_pilot_plane($id, $plane)
    {
        $this->db->query("UPDATE dcs_blueteam SET plane='$plane' WHERE pilot_id=$id");
    }

    // Игрок покинул Красную команду
    function left_red($id)
    {
        $this->db->where('pilot_id', $id);
        $this->db->delete('dcs_redteam');
    }

    // Игрок покинул Синюю команду
    function left_blue($id)
    {
        $this->db->where('pilot_id', $id);
        $this->db->delete('dcs_blueteam');
    }

    /*�������� ������� � ������� �����*/

    function check_blue($id)

    {

        $this->db->where('pilot_id', $id);

        $query = $this->db->get('dcs_blueteam');

        return $query->num_rows();

    }

    /*�������� ������� � ������� �������*/

    function check_red($id)

    {

        $this->db->where('pilot_id', $id);

        $query = $this->db->get('dcs_redteam');

        return $query->num_rows();

    }

    /*��������� ���� ������� �������*/

    function get_all_red()

    {

        $query = $this->db->query("SELECT * FROM dcs_redteam");

        return $query->result_array();

    }

    /*��������� ���� ����� �������*/

    function get_all_blue()

    {

        $query = $this->db->query("SELECT * FROM dcs_blueteam");

        return $query->result_array();

    }

    /*****************************���������� ������� �������********************************/

    function server_offline()
    {
        $this->db->query("UPDATE server SET status=0 WHERE server_dcs='Server'");
    }

    function server_online()
    {
        $this->db->query("UPDATE server SET status=1 WHERE server_dcs='Server'");
    }

    function empty_web_tables(){
        $this->db->query("TRUNCATE dcs_blueteam");
        $this->db->query("TRUNCATE dcs_online");
        $this->db->query("TRUNCATE dcs_redteam");
        $this->db->query("TRUNCATE dcs_spectators");
        $this->db->query("TRUNCATE flights");
    }

    /*��������� ������� �������*/

    function get_server_status()
    {
        $query = $this->db->query("SELECT status FROM server WHERE server_dcs ='Server'");
        return $query->row_array();
    }

    function add_online($id, $time)
    {
        $this->db->query("INSERT INTO dcs_online(pilot_id,data) VALUES ($id,'$time')");
    }
    function delete_online($id)
    {
        $this->db->query("DELETE FROM dcs_online WHERE pilot_id=$id");
    }

    /************************�������� ���������� ������ ������***************************************/

    /*��������� ����� ������*/

    function get_pilot_name($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('pilots');
        return $query->row_array();
    }

    /*��������� ������ ������������ ������� �� ID ������*/

    function get_pilot_kills_by_category($id)
    {
        $query = $this->db->query("
                SELECT dcs_categories.title AS title,
                       COUNT(pilots_kills.unit_id) AS count_kills
                FROM pilots_kills
                LEFT JOIN (
                          SELECT
                            DISTINCT name,
                            id,
                            category
                            FROM dcs_units
                          )
                          AS units ON units.id=pilots_kills.unit_id
                LEFT JOIN dcs_categories ON dcs_categories.id=units.category
                WHERE pilots_kills.pilot_id=$id
                GROUP BY dcs_categories.title
            ");
        return $query->result_array();
    }

    /*��������� ���������� ������ ������� �� ID ������*/

    function get_total_count($id)
    {
        $query = $this->db->query("
          SELECT
            COUNT(unit_id) as total_count
            FROM pilots_kills
            WHERE pilot_id=$id
         ");
        return $query->row_array();
    }

    /*��������� ����������������� ��� ����������*/

    function add_eject($id, $time)
    {
        $this->db->query("INSERT INTO pilots_ejects(pilot_id,data) VALUES ($id,'$time')");
    }

    function flight_statistic($id)
    {
        $query = $this->db->query("
                SELECT pilots.id,
               	    pilots.nickname,
                    death.count_death,
                    ejects.count_eject,
                    lands.count_lands,
                    takeoffs.count_takeoffs,
                    crashes.count_crashes
                FROM pilots
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_death FROM pilots_death WHERE pilot_id=$id) AS death
                	ON death.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_eject FROM pilots_ejects WHERE pilot_id=$id) AS ejects
                    ON ejects.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_lands FROM pilots_lands WHERE pilot_id=$id) AS lands ON lands.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_takeoffs FROM pilots_takeoffs WHERE pilot_id=$id) AS takeoffs ON takeoffs.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_crashes FROM fail_flights WHERE pilot_id=$id) AS crashes ON crashes.pilot_id=pilots.id
                WHERE pilots.id=$id
            ");
        return $query->result_array();
    }

    /*��������� ���������� ��������� �� ������ ������*/

    function get_dogfights_by_id($id)
    {
        $query = $this->db->query("SELECT
                pilots.nickname AS nickname,
                killed.counts_kills AS kills,
                dead.counts_death_kills as death
            FROM pilots
            LEFT JOIN (SELECT
                    COUNT(pilot_id) AS counts_kills,
                    pilot_id
                  FROM pilots_dogfights
                  WHERE pilot_id=$id
                  )
                AS killed ON killed.pilot_id=$id
            LEFT JOIN (SELECT
                          COUNT(victim_id) AS counts_death_kills,
                          victim_id
                        FROM pilots_dogfights GROUP BY victim_id) AS dead ON dead.victim_id=pilots.id
            WHERE pilots.id=$id
            ");
        return $query->row_array();
    }

    // Общее количество очков по ID пилота
    function get_total_points_by_id($id){
        $query = $this->db->query("SELECT SUM(points) AS points FROM pilots_kills WHERE pilot_id={$id}");
        return $query->row_array();
    }

    //Выборка очков за воздушные победы
    function get_points_for_dogfights($id){
        $query = $this->db->query("SELECT SUM(points) AS points FROM pilots_dogfights WHERE pilot_id={$id} ");
        return $query->row_array();
    }

    //Получение медалей по очкам
    function get_medals_by_points($points){
        $query = $this->db->query("
            SELECT * FROM dcs_awards WHERE points <= {$points}
        ");
        return $query->result_array();
    }


    function insert_dogfight($dogfight){
        $this->db->insert('pilots_dogfights',$dogfight);
    }

    function check_unit_type($check_unit_type_temp){
        $query = $this->db->query("SELECT * from dcs_units WHERE name='{$check_unit_type_temp}'");
        return $query->row_array();
    }

    //Получение текущего стрика
    function get_temporary_streak($id){
        $query = $this->db->query("SELECT COUNT(streak) AS now_streak FROM dcs_temporary_streaks WHERE pilot_id={$id}");
        return $query->row_array();
    }

    // Получение максимального стрика
    function get_best_streak($id){
        $query = $this->db->query("SELECT * FROM dcs_best_streaks WHERE pilot_id={$id}");
        return $query->row_array();
    }

    function add_temporary_streak($id){
        $this->db->query("INSERT INTO dcs_temporary_streaks(pilot_id) VALUES({$id})");
    }

    //Добавление наилучшего стрика.
    function insert_best_streak($id,$streak){
        $query = $this->db->query("
            INSERT INTO dcs_best_streaks(pilot_id,streak) VALUES ({$id},{$streak})
            ON DUPLICATE KEY UPDATE streak=VALUES(streak)
        ");
    }

    //Очистка временных стриков
    function clear_temp_streaks($id){
        $this->db->query("DELETE FROM dcs_temporary_streaks WHERE pilot_id={$id} ");
    }

    function check_registration_tickets($id){
        $query = $this->db->query("
            SELECT * FROM dcs_registration_tickets
            WHERE pilot_id={$id}
            ORDER BY deadline DESC LIMIT 1
        ");
        return $query->row_array();
    }

    function confirm_pilot_registration($id){
        $this->db->query("UPDATE pilots SET checked=1 WHERE id={$id}");
    }

    function delete_pilot_tickets($id){
        $this->db->query("DELETE FROM dcs_registration_tickets WHERE pilot_id={$id}");
    }

    function add_favor_plane($id, $plane){
        $this->db->query("INSERT INTO dcs_favor_planes (pilot_id,plane) VALUES ({$id},'$plane')");
    }


}


/* INSERT ... ON DUPLICATE KEY UPDATE Syntax*/

/*WHERE period between '$period' and  DATE_ADD(DATE_ADD('$period', INTERVAL 4 MONTH), INTERVAL -1 SECOND)*/

?>