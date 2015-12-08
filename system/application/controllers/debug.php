<?php
if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Debug extends Controller
{

    public function __construct()
    {
        parent::Controller();
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

    function index()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header('Content-Type: text/html; charset=utf-8');

        /**************************************************/
        $file = './tmp/stat.txt';
        $handle = fopen($file, "r");
        while (($data = fgets($handle, 4096)) !== FALSE)
        {
            $string = $data;
            echo "===================================================<br>".
                $string
                ."<br>- - - - - - - - - - - - - - - - - - - - - - - - - -
                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - <br>
            ";
            //Подготовка даты в нормальный формат
            $data = explode(';', $string);
            $date = explode(' ', $data[0]);
            $month = explode('/',$date[0]);
            $time = date('Y')."-$month[0]-$month[1] ".$date[1];
            if(empty($data[1])){
                continue;//TODO Заменить на continue();
            }
            $nickname = trim(str_replace('"', '', $data[1]));
            $event = trim($data[2]);

            echo "Обрабатываем событие '$event'. <br>";
            if (array_key_exists(3, $data) == true) {
                $hash = trim($data[3]);

            }
            echo "Проверка, имя игрока Server или нет?<br>";
            switch($nickname){
                //Server
                case 'Server':
                    echo "Да, єто Server. Операция с сервером!<br>";
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
                    //echo $hash;
                    if($hash != 'server'){
                        $check_nick = $this->statistics_model->check_nick($hash);
                        if (empty($check_nick)) {
                            echo "Игрока $nickname нету в базе данных.<br>";
                            $nick = array();
                            $nick['nickname'] = $nickname;
                            $nick['hash'] = $data[3];
                            $record = $this->statistics_model->add_pilot($nick);
                            echo "Пилот $nickname добавлен в БД.<br>";
                        }
                        $nick_id = $this->statistics_model->get_pilot_id_with_hash($hash);
                        print_r($nick_id);
                        if(!empty($nick_id)){
                            $id = $nick_id['id'];
                            if($nick_id['nickname'] != $nickname){
                                $this->statistics_model->update_nickname($id,$nickname);
                            }
                            echo "Пилот $nickname найден. ID = $id.<br>";
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
                            $this->statistics_model->add_favor_plane($id, $plane);
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
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                $this->statistics_model->add_fail_crash($id, $time);
                                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                                $this->dcs_lib->add_death($id,$time);

                                $this->dcs_lib->calculate_streaks($id);
                            }else{
                                //echo "Активных полётов при смене команды для игрока $nickname не обнаружено.<br>";
                            }
                            break;
                        case 'joined BLUE':
                            //echo "Игрок $nickname присоединился в команду <b style='color:blue;'>Синих</b><br />";
                            $plane = $data[4];
                            $this->statistics_model->add_favor_plane($id, $plane);
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
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                $this->statistics_model->clear_flights($id);
                                $this->statistics_model->add_fail_crash($id, $time);
                                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                                $this->dcs_lib->add_death($id,$time);
                                $this->dcs_lib->calculate_streaks($id);
                            }else{
                                //echo "Активных полётов при смене команды для игрока $nickname не обнаружено.<br>";
                            }
                            break;
                        case 'takeoff from':/*Событие взлёта самолёта/вертолёта с аэродрома/корабля*/
                            //echo 'Игрок '.$nickname.' взлетел с аэродрома '.$data[4].' в '.$time.'<br>';
                            $flight = array();
                            //echo 'ID пилота = '.$id.'<br />';
                            $flight['pilot_id'] = $id;
                            $flight['flight'] = $time;
                            $takeoff_from = $data[4];
                            $flight['takeoff_from'] = $takeoff_from;
                            $this->statistics_model->new_flight($flight);

                            $this->statistics_model->add_new_flight($id, $time);

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
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                            }
                            $this->statistics_model->add_fail_crash($id, $time);
                            $this->dcs_lib->add_death($id,$time);

                            $this->dcs_lib->calculate_streaks($id);

                            break;
                        case 'landed at':/*Событие посадки*/
                            //echo 'Игрок '.$nickname.' сел на аэродром '.$data[4].' в '.$time.'<br>';
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
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - " . date("H:i:s", $hours) . "</p><br />";
                                $this->statistics_model->add_fail_crash($id, $time);
                            }
                            $this->statistics_model->add_eject($id, $time);
                            break;
                        case 'crashed': /*Событие потери ЛА*/
                            //echo 'Игрок '.$nickname.' разбил свой ЛА в '.$time.'<br>';
                            $start_flight = $this->statistics_model->get_start_flight($id);
                            if (!empty($start_flight)) {
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                $this->statistics_model->add_fail_crash($id, $time);
                                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                                $this->dcs_lib->add_death($id,$time);
                                $this->dcs_lib->calculate_streaks($id);
                            }
                            break;
                        case 'joined SPECTATORS':/*Событие входа Пилота в зрители*/
                            $start_flight = $this->statistics_model->get_start_flight($id);
                            if (!empty($start_flight)) {
                                $this->dcs_lib->calculate_flight($id, $time,$start_flight);
                                $this->statistics_model->add_fail_crash($id, $time);
                                echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                                $this->dcs_lib->add_death($id,$time);
                                $this->dcs_lib->calculate_streaks($id);

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
        }
        fclose($handle);

    }
}
