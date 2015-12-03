<?php
if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Statistics extends Controller
{

    public function __construct()
    {
        parent::Controller();
    }

    public function index()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate");

        //header('Content-Type: text/html; charset=utf-8');
        $data = $this->input->post('postname');
        $this->load->model('statistics_model');
        $status = $this->statistics_model->get_server_status();
        $pilots_online = $this->statistics_model->main_pilots_online();
        $data = array();
        if ($status['status'] == 0) {
            $data['server_status'] = '<b style="color:red;">OFFLINE</b>';
            $data['current_flights'] = '';
            $data['pilots_online'] = '';
        } else {
            $data['server_status'] = '<b style="color:green;">ONLINE</b>';
            $data['pilots_online'] = $pilots_online;
            $active_flights = $this->statistics_model->main_get_current_flights();
            if ($active_flights != null) {
                //echo "Список пилотов, находящихся в полёте:<br />";
                $data['current_flights'] = $active_flights;
            } else {
                $data['current_flights'] = '';
            }
            $data['spectators'] = $this->statistics_model->get_spectators();
            $data['red_team'] = $this->statistics_model->get_redteam();
            $data['blue_team'] = $this->statistics_model->get_blueteam();
        }
        $flights = $this->statistics_model->main_get_all_flights();
        //echo "<pre>";print_r($flights);exit;

        //echo "Список пилотов, находящихся в полёте:<br />";
        $data['flight_players'] = $flights;
        $this->load->view('statistics/mainpage_view', $data);

    }

    public function show($id)
    {
        $this->load->model('statistics_model');
        $id = (int)$id;
        $data = array();
        $data['pilot'] = $this->statistics_model->get_pilot_name($id);
        if(empty($data['pilot']))die("Can't find pilot with ID$id");
        $data['unit_types'] = $this->statistics_model->get_pilot_kills_by_category($id);
        $data['total_count'] = $this->statistics_model->get_total_count($id);
        $data['statistics'] = $this->statistics_model->flight_statistic($id);
        $data['dogfights'] = $this->statistics_model->get_dogfights_by_id($id);
        $data['now_streak'] = $this->statistics_model->get_temporary_streak($id);
        $data['best_streak'] = $this->statistics_model->get_best_streak($id);
        $kill_points = $this->statistics_model->get_total_points_by_id($id);
        $dogfight_points = $this->statistics_model->get_points_for_dogfights($id);
        $points = $kill_points['points'] + $dogfight_points['points'];
        $data['total_points'] = $points;
        if(!empty($kill_points) && !empty($dogfight_points) && $points > 0){
            $data['medals'] = $this->statistics_model->get_medals_by_points($points);
        }
        $this->load->view('statistics/pilot_stat_view', $data);
    }

    public function log()
    {
        header('Content-Type: text/html; charset=utf-8');
        $file = './tmp/stat.txt';
        if(file_exists($file)){
            $handle = fopen($file, "r");
            $log = array();
            while (($data = fgets($handle, 4096)) !== FALSE) {
                $log[] = $data;
            }
            fclose($handle);
            $count = count($log);
            $offset = $count - 50;
            for ($i = 0; $i < $count; $i++) {
                echo $log[$i] . "<br />";
            }
        }else{
            echo "Файл лога не существует!";
        }
    }

    /************************parsing  requests from DCS server************************/

    function record()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $string = trim($this->input->post('postname'));
        if (empty($string) || $string == '') {
            exit();
        }
        /************************recording into logfile***************************/
        $file = './tmp/stat.txt';
        $fp = fopen($file, "a+");
        fwrite($fp, $string . "\r\n");
        fclose($fp);
        /**************************************************/
//        $file = './tmp/stat.txt';
//        $handle = @fopen($file, "r");
//        while (($data = fgets($handle, 4096)) !== FALSE)
//        {
//        $string = $data;
//        echo "===================================================<br>".
//            $string
//            ."<br>- - - - - - - - - - - - - - - - - - - - - - - - - -
//            - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br>
//        ";
        //Подготовка даты в нормальный формат
        $data = explode(';', $string);
        $date = explode(' ', $data[0]);
        $month = explode('/',$date[0]);
        $time = date('Y')."-$month[0]-$month[1] ".$date[1];
        if(empty($data[1])){
            exit;//TODO Заменить на continue();
        }
        $nickname = trim(str_replace('"', '', $data[1]));
        $event = trim($data[2]);

        //echo "Обрабатываем событие '$event'. <br>";
        if (array_key_exists(3, $data) == true) {
            $hash = trim($data[3]);

        }
        //echo "Проверка, имя игрока Server или нет?<br>";
        switch($nickname){
            //Server
            case 'Server':
                //echo "Да, єто Server. Операция с сервером!<br>";
                switch ($event){
                    case 'Start':
                        //echo "Старт сервера в $time<br/>";
                        $this->statistics_model->server_online();
                        //echo "Очистка всех таблиц для веб-статистики(Команды, Зрители...).<br>";
                        $this->statistics_model->empty_web_tables();
                        break;
                    case 'Stop':
                        //echo "Остановка сервера в $time<br />";
                        $this->statistics_model->server_offline();
                        //echo "Ищем активные полёты в базе данных.<br>";
                        $flights = $this->statistics_model->get_all_current_flights();
                        if (!empty($flights)) {
                            //echo "Найдено ".count($flights). " активных полётов.Начинаем процедуру сохранения полётов.<br>";
                            $values = '';
                            $fl = 1;//Маркер для дебага
                            //print_r($flights);exit;
                            foreach ($flights as $endflight) {
                                $start = $endflight['flight'];
                                //echo "Время начала полёта #$fl - $start.<br>";
                                $end = $time;
                                //echo "Время окончания полёта #$fl - $end.<br>";
                                $takeoff_from = $endflight['takeoff_from'];
                                $landed_at = null;
                                $hours = strtotime($end) - strtotime($start);
                                if($hours < 0){$hours = $hours*(-1);}
                                //echo "Время полёта #$fl - $hours сек.<br>";
                                $values = $values . "(" . $endflight['pilot_id'] . ",'" . $start . "','" . $end . "'," . $hours . ",'".$takeoff_from."'),";
                                $flight_id = $endflight['pilot_id'];
                                //echo "Удаляем полёт # $fl.<br>";
                                $this->statistics_model->delete_all_flights($flight_id);
                                $fl++;// Добавление маркера дебага
                            }
                            $values = substr($values, 0, -1);
                            //echo $values;exit;
                            //echo "Добавление записей в общий налёт(flight_hours).<br>";
                            $this->statistics_model->add_not_ended_flights($values);
                        }
                        //echo "Активных полётов не обнаружено.<br>";
                        //echo "Получаем список пользователей онлайн.<br>";
                        $online = $this->statistics_model->get_online_all();
                        //echo "Получаем список Зрителей.<br>";
                        $spectators = $this->statistics_model->get_all_spectators();
                        //echo "Получаем список Красных.<br>";
                        $red = $this->statistics_model->get_all_red();
                        //echo "Получаем список Синих.<br>";
                        $blue = $this->statistics_model->get_all_blue();
                        if (!empty($online)) {
                            //echo "Таблица ONLINE не пустая. Выполняется очистка таблицы:<br>";
                            $on = 1;
                            foreach ($online as $delete) {
                                $id = $delete['pilot_id'];
                                $this->statistics_model->delete_online($id);
                                //echo "Удалена запись №$on.<br>";
                                $on++;
                            }
                        }//echo "Таблица ONLINE пустая.<br>";
                        if (!empty($spectators)) {
                            //echo "Таблица Spectators не пустая. Выполняется очистка таблицы:<br>";
                            $sp=1;
                            foreach ($spectators as $spect){
                                $id = $spect['pilot_id'];
                                $this->statistics_model->delete_from_spectators($id);
                                //echo "Удален зритель №$sp.<br>";
                                $sp++;
                            }
                        }//echo "Таблица Spectators пустая.<br>";
                        if (!empty($red)) {
                            //echo "Таблица Красных не пустая. Выполняется очистка таблицы:<br>";
                            $rd = 1;
                            foreach ($red as $member){
                                $id = $member['pilot_id'];
                                $this->statistics_model->left_red($id);
                                //echo "Удален Красный игрок №$rd.<br>";
                                $rd++;
                            }//echo "Таблица Красных пустая.<br>";
                        }
                        if (!empty($blue)) {
                            //echo "Таблица Синих не пустая. Выполняется очистка таблицы:<br>";
                            $bl = 1;
                            foreach ($blue as $member) {
                                $id = $member['pilot_id'];
                                $this->statistics_model->left_blue($id);
                                //echo "Удален Синий игрок №$bl.<br>";
                                $bl++;
                            }
                        }
                        break;
                }
                break;
            //Игроки
            default:
                //echo "Нет. Это не Server.Ищем пилота в базе данных(его ID).<br>";
                if($hash != 'server'){
                    $check_nick = $this->statistics_model->check_nick($hash);
                    if (empty($check_nick)) {
                        //echo "Игрока $nickname нету в базе данных.<br>";
                        $nick = array();
                        $nick['nickname'] = $nickname;
                        $nick['hash'] = $data[3];
                        $record = $this->statistics_model->add_pilot($nick);
                        //echo "Пилот $nickname добавлен в БД.<br>";
                    }
                    $nick_id = $this->statistics_model->get_pilot_id_with_hash($hash);
                    if(!empty($nick_id)){
                        $id = $nick_id['id'];
                        if($check_nick['nickname'] != $nickname){
                            $this->statistics_model->update_nickname($id,$nickname);
                        }
                        //echo "Пилот $nickname найден. ID = $id.<br>";
                    }else{
                        exit;
                    }
                }
                switch ($event) {
                    case 'entered':/*Событие входа игрока на сервер*/
                        //echo "Пилот $nickname присоединился к серверу. Проверяем Базу Данных.<br>";
                        $this->statistics_model->add_online($id, $time);
                        //echo "Добавление пилота $nickname в таблицу 'Online'.<br>";
                        $this->statistics_model->add_spectator($id, $time);
                        //echo "Добавление пилота $nickname в таблицу 'Зрители'.<br>";
                        $check_registrations = $this->statistics_model->check_registration_tickets($id);
                        if(!empty($check_registrations)){
                            $deadline = $check_registrations['deadline'];
                            if(strtotime($time) <= strtotime($deadline)){
                                $this->statistics_model->confirm_pilot_registration($id);
                                $this->statistics_model->delete_pilot_tickets($id);
                            }
                        }
                        break;
                    case 'joined RED':
                        //echo "Игрок $nickname присоединился в команду <b style='color:red;'>Красных</b><br />";
                        $plane = $data[4];
                        $this->statistics_model->delete_from_spectators($id);
                        //echo "Удаляем пилота $nickname из зрителей.<br>";
                        $check_red = $this->statistics_model->check_red($id);
                        //echo "Проверяем таблицу красных.<br>";
                        if ($check_red == 0) {
                            //echo "Пилота $nickname - нету в таблицу красных.<br>";
                            $this->statistics_model->join_red($id, $time, $plane);
                            //echo "Пилот $nickname записан в таблицу Красных.<br>";
                        } else {
                            //echo "Пилот находится уже в таблице красных. Обновляем страницу красных.<br>";
                            $this->statistics_model->update_red_pilot_plane($id, $plane);
                        }
                        //echo "Если пилот находился в таблице синих - удаляем его оттуда.<br>";
                        $this->statistics_model->left_blue($id);
                        //echo "Проверяем, находился ли пилот в воздухе.<br>";
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            //echo '<b style = "color:red;">ВНИМАНИЕ</b>.Игрок '.$nickname.' сменил команду, находясь в полёте. Время выхода - '.$time.'<br>';//exit();
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            //echo "Время полёта игрока $nickname составляет $hours секунд.<br>";
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            //echo "Запись полёта в таблицу flights_hours.<br>";
                            $flight = $this->statistics_model->add_total_flight($total);
                            //echo "Очистка таблицы текущих полётов.<br>";
                            $this->statistics_model->clear_flights($id);
                            //echo "Запись потери летательного аппарата игроком $nickname.<br>";
                            $this->statistics_model->add_fail_crash($id, $time);
                        }else{
                            //echo "Активных полётов при смене команды для игрока $nickname не обнаружено.<br>";
                        }
                        break;
                    case 'joined BLUE':
                        //echo "Игрок $nickname присоединился в команду <b style='color:blue;'>Синих</b><br />";
                        $plane = $data[4];
                        //echo "Удаляем игрока $nickname из таблицы Зрителей, если он там был.<br>";
                        $this->statistics_model->delete_from_spectators($id);
                        //echo "Проверяем, находится ли игрок $nickname в таблице Синих.<br>";
                        $check_blue = $this->statistics_model->check_blue($id);
                        if ($check_blue == 0) {
                            //echo "Игрок $nickname не находился в таблице Синих.<br>";
                            $this->statistics_model->join_blue($id, $time, $plane);
                            //echo "Игрока $nickname записали в таблицу Синих.<br>";
                        } else {
                            //echo "Игрок $nickname находился в таблицу Синих, обновляем запись.<br>";
                            $this->statistics_model->update_blue_pilot_plane($id, $plane);
                        }
                        //echo "Если игрок $nickname находился в таблице Красных, удаляем из Красных.<br>";
                        $this->statistics_model->left_red($id);
                        //echo "Проверяем, находился ли пилот в воздухе.<br>";
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            //echo '<b style = "color:red;">ВНИМАНИЕ</b>.Игрок '.$nickname.' сменил команду, находясь в полёте. Время выхода - '.$time.'<br>';//exit();
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            //echo "Время полёта игрока $nickname составляет $hours секунд.<br>";
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            //echo "Запись полёта в таблицу flights_hours.<br>";
                            $flight = $this->statistics_model->add_total_flight($total);
                            //echo "Очистка таблицы текущих полётов.<br>";
                            $this->statistics_model->clear_flights($id);
                            //echo "Запись потери летательного аппарата игроком $nickname.<br>";
                            $this->statistics_model->add_fail_crash($id, $time);
                        }else{
                            //echo "Активных полётов при смене команды для игрока $nickname не обнаружено.<br>";
                        }
                        break;
                    case 'takeoff from':/*Событие взлёта самолёта/вертолёта с аэродрома/корабля*/
                        //echo 'Игрок '.$nickname.' взлетел с аэродрома '.$object.' в '.$time.'<br>';
                        $flight = array();

                        //$nick_id = $this->statistics_model->get_pilot_id($nickname);
                        //$id = $nick_id['id'];//echo 'ID пилота = '.$id.'<br />';
                        $flight['pilot_id'] = $id;
                        $flight['flight'] = $time;
                        $takeoff_from = $data[4];
                        $flight['takeoff_from'] = $takeoff_from;
                        $this->statistics_model->new_flight($flight);

                        //$this->statistics_model->add_new_flight($id, $time);

                        $this->statistics_model->add_takeoff($id, $time);
                        break;
    //            case 'takeoff': /*Событие взлёта с ППБ*/
    //                //echo 'Игрок '.$nickname.' взлетел на вертолёте в '.$time.'<br>';
    //                $nick_id = $this->statistics_model->get_pilot_id($nickname);
    //                $id = $nick_id['id'];//echo 'ID пилота = '.$id.'<br />';
    //                $this->statistics_model->add_new_flight($id, $time);
    //                $this->statistics_model->add_takeoff($id, $time);
    //                break;
                    case 'dead':
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->clear_flights($id);
                            $this->statistics_model->add_fail_crash($id, $time);
                            //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                        }
                        $death = array(
                            'pilot_id' => $id,
                            'death' => $time,
                        );
                        $dead = $this->statistics_model->add_death($death);
                        $count_temp_streaks = $this->statistics_model->get_temporary_streak($id);
                        $best_streak = $this->statistics_model->get_best_streak($id);
                        if(!empty($best_streak)){
                            if($best_streak['streak'] > $count_temp_streaks['now_streak']){
                                $streak = $best_streak['streak'];
                            }else{
                                $streak = $count_temp_streaks['now_streak'];
                            }
                        }else{
                            $streak = $count_temp_streaks['now_streak'];
                        }
                        $insert_streak = $this->statistics_model->insert_best_streak($id,$streak);
                        $clear_temp_streaks = $this->statistics_model->clear_temp_streaks($id);
                        break;
                    case 'landed at':/*Событие посадки*/
                        //echo 'Игрок '.$nickname.' сел на аэродром '.$object.' в '.$time.'<br>';
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if(!empty($start_flight)){
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = $data[4];
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->add_landing($id, $time);
                        }
                        $this->statistics_model->clear_flights($id);
                        //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                        break;
                    case 'killed':   /*Событие убития*/
                        $temp_victim = $data[5];
                        $check_victim = $this->statistics_model->check_victim_by_hash($temp_victim);
                        if(!empty($check_victim)){
                            $victim_id = $check_victim['id'];
                            $dogfight = array();
                            $dogfight['pilot_id'] = $id;
                            $dogfight['victim_id'] = $victim_id;
                            $dogfight['data'] = $time;
                            $dogfight['friendly'] = 0;
                            $dogfight['points'] = $data[6];
                            $insert = $this->statistics_model->insert_dogfight($dogfight);
                            $streak = $this->statistics_model->add_temporary_streak($id);
                        }else{
                            //echo 'Игрок '.$nickname.' уничтожил '.$object.' с помощью '.$ammunition.' в '.$time.'<br>';//exit();
                            $check_unit_type_temp = $data[5];
                            $check_type = $this->statistics_model->check_unit_type($check_unit_type_temp);
                            if(!empty($check_type)){
                                $unit_id = $check_type['id'];
                                $unit_type_id = $check_type['category'];
                                $points = $data[6];
                                $kill = array();
                                $kill['pilot_id'] = $id;
                                $kill['data'] = $time;
                                $kill['unit_id'] = $unit_id;
                                $kill['unit_type_id'] = $unit_type_id;
                                $kill['points'] = $points;
                                $this->statistics_model->add_new_kill($kill);
                            }else{

                            }
                        }
                        break;
                    case 'ejected': /*Событие катапультирования*/
                        //echo 'Игрок '.$nickname.' катапультировался в '.$time.'<br>';
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->clear_flights($id);
                            //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - " . date("H:i:s", $hours) . "</p><br />";
                            $this->statistics_model->add_fail_crash($id, $time);
                        }
                        $this->statistics_model->add_eject($id, $time);
                        break;
                    case 'crashed': /*Событие потери ЛА*/
                        //echo 'Игрок '.$nickname.' разбил свой ЛА в '.$time.'<br>';
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->clear_flights($id);
                            $this->statistics_model->add_fail_crash($id, $time);
                            //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                        }
                        break;
                    case 'joined SPECTATORS':/*Событие входа Пилота в зрители*/
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            //echo "Пилот $nickname тупо потратил время техников и вышел в зрители!<br />";
                            $this->statistics_model->add_fail_crash($id, $time);
                            $start_flight = $this->statistics_model->get_start_flight($id);
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->clear_flights($id);
                            $this->statistics_model->add_fail_crash($id, $time);
                        } else {
                            $death = array();
                            $death['pilot_id'] = $id;
                            $death['death'] = $time;
                            //$this->statistics_model->add_death($death);
                            //echo "Пилот $nickname присоединился к зрителям сервера!<br />";
                        }
                        $this->statistics_model->left_blue($id);
                        $this->statistics_model->left_red($id);
                        $this->statistics_model->add_spectator($id, $time);
                        break;
                    case 'left':/*Событие покидания сервера пилотом*/
                        $check_nickname = $this->statistics_model->get_pilot_id($nickname);
                        if(!empty($check_nickname)){
                            $id = $check_nickname['id'];
                        }else{
                            exit;
                        }
                        $start_flight = $this->statistics_model->get_start_flight($id);
                        if (!empty($start_flight)) {
                            //echo "Пилот $nickname тупо потратил время техников и своё!<br />";
                            $this->statistics_model->add_fail_crash($id, $time);
                            $start_flight = $this->statistics_model->get_start_flight($id);
                            $start = $start_flight['last_flight'];
                            $hours = strtotime($time) - strtotime($start);
                            $total = array();
                            $total['pilot_id'] = $id;
                            $total['start_flight'] = $start;
                            $total['end_flight'] = $time;
                            $total['total'] = $hours;
                            $from = $start_flight['takeoff_from'];
                            $total['takeoff_from'] = $from;
                            $total['landed_at'] = null;
                            $flight = $this->statistics_model->add_total_flight($total);
                            $this->statistics_model->clear_flights($id);
                        }
                        $this->statistics_model->delete_from_spectators($id);
                        $this->statistics_model->delete_online($id);
                        $this->statistics_model->left_blue($id);
                        $this->statistics_model->left_red($id);
                        break;
                }
                break;
        }
//        }
//        fclose($handle);

    }

    function empty_stat(){
        $this->display_lib->empty_stat();
    }

    function empty_db(){
        $this->dcs_lib->isPost();
        $file = './tmp/stat.txt';
        $pass = md5(trim($this->input->post('password')));
        $main_pass = md5('Vortex2015eekz');
        if($pass != $main_pass){
            echo 0;
        }else{
            $delete = $this->statistics_model->clear_db();
            unlink($file);
            echo 1;
        }
    }
}
