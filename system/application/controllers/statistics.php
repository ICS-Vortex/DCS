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
        //header('Content-Type: text/html; charset=utf-8');
        $data = $this->input->post('postname');
        $this->load->model('statistics_model');
        $status = $this->statistics_model->get_server_status();
        $pilots_online = $this->statistics_model->main_pilots_online();
        $data = array();
        if ($status['status'] == 0) {
            $data['server_status'] = 'OFFLINE';
            $data['current_flights'] = '';
            $data['pilots_online'] = '';
        } else {
            $data['server_status'] = 'ONLINE';
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

        //echo "Список пилотов, находящихся в полёте:<br />";
        $data['flight_players'] = $flights;


        $this->load->view('statistics/mainpage_view', $data);

    }

    public function show($id)
    {
        //echo 'ok';
        $this->load->model('statistics_model');
        $data = array();
        $data['pilot'] = $this->statistics_model->get_pilot_name($id);
        $data['unit_types'] = $this->statistics_model->get_pilot_kills_by_category($id);
        $data['total_count'] = $this->statistics_model->get_total_count($id);
        $data['statistics'] = $this->statistics_model->flight_statistic($id);
        $data['dogfights'] = $this->statistics_model->get_dogfights_by_id($id);
        //print_r($data['dogfights']);exit();       
        $this->load->view('statistics/pilot_stat_view', $data);
    }

    public function log()
    {
        header('Content-Type: text/html; charset=utf-8');
        $file = './tmp/stat.txt';
        $handle = @fopen($file, "r");
        $log = array();
        while (($data = fgets($handle, 4096)) !== FALSE) {
            $log[] = $data;
        }
        fclose($handle);
        $count = count($log);
        $offset = $count - 50;
        for ($i = $offset; $i < $count; $i++) {
            echo $log[$i] . "<br />";
        }
    }

    /************************ПАРСЕР ЗАПРОСОВ С СЕРВЕРА DCS************************/

    function record()
    {
        $this->load->model('statistics_model');
        header('Content-Type: text/html; charset=utf-8');

        $string = trim($this->input->post('postname'));
        if (empty($string) || $string == '') {
            exit();
        }

        /************************ЗАПИСЬ СТАТИСТИКИ В ФАЙЛ***************************/
        $file = './tmp/stat.txt';
        $fp = @fopen($file, "a+");
        fwrite($fp, $string . "\r\n");
        fclose($fp);
        /**************************************************/
        $file = './tmp/stat.txt';
        $handle = @fopen($file, "r");
        //while (($data = fgets($handle, 4096)) !== FALSE)
        //{
        //$string = $data;

        $data = explode(';', $string);
        //print_r($data);echo "<br />";
        $time = date("Y-m-d H:i:s", strtotime($data[0]));
        $nickname = str_replace('"', '', $data[1]);
        $event = trim($data[2]);
        if (array_key_exists(3, $data) == true) {
            $object = str_replace('"', '', $data[3]);
        }
        if (!empty($nickname) || $nickname != '') {

            $check_nick = $this->statistics_model->check_nick($nickname);
            if ($check_nick['pilot_count'] == 0) {
                $nick = array();
                $nick['nickname'] = $nickname;
                $record = $this->statistics_model->add_pilot($nick);
            }
            $nick_id = $this->statistics_model->get_pilot_id($nickname);
            $id = $nick_id['id'];

            if (preg_match("/joined BLUE/", $event) || preg_match("/joined RED/", $event)) {
                if (preg_match("/UH-1H/", $event)) {
                    $plane = 'UH-1H';
                }
                if (preg_match("/Ка-50/", $event)) {
                    $plane = 'Ка-50';
                }
                if (preg_match("/Ми-8МТВ2/", $event)) {
                    $plane = 'Ми-8МТВ2';
                }
                if (preg_match("/TF-51D/", $event)) {
                    $plane = 'TF-51D';
                }
                if (preg_match("/Bf 109 K-4/", $event)) {
                    $plane = 'Bf 109 K-4';
                }
                if (preg_match("/Су-25/", $event)) {
                    $plane = 'Су-25';
                }
                if (preg_match("/Су-25Т/", $event)) {
                    $plane = 'Су-25Т';
                }
                if (preg_match("/Су-27/", $event)) {
                    $plane = 'Су-27';
                }
                if (preg_match("/Су-33/", $event)) {
                    $plane = 'Су-33';
                }
                if (preg_match("/МиГ-29А/", $event)) {
                    $plane = 'МиГ-29А';
                }
                if (preg_match("/МиГ-29С/", $event)) {
                    $plane = 'МиГ-29С';
                }
                if (preg_match("/A-10C/", $event)) {
                    $plane = 'A-10C';
                }
                if (preg_match("/F-15C/", $event)) {
                    $plane = 'F-15C';
                }
                if (preg_match("/А-10А/", $event)) {
                    $plane = 'А-10А';
                }
                if (preg_match("/F-86F/", $event)) {
                    $plane = 'F-86F';
                }
                if (preg_match("/MiG-15bis/", $event)) {
                    $plane = 'MiG-15bis';
                }
                if (preg_match("/MiG-21Bis/", $event)) {
                    $plane = 'MiG-21Bis';
                }
                $start_flight = $this->statistics_model->get_start_flight($id);
                if (!empty($start_flight)) {
                    //echo '<b style = "color:red;">ВНИМАНИЕ</b>.Игрок '.$nickname.' сменил команду, находясь в полёте. Время выхода - '.$time.'<br>';//exit();
                    $start = $start_flight['last_flight'];
                    $hours = strtotime($time) - strtotime($start);
                    $total = array();
                    $total['pilot_id'] = $id;
                    $total['start_flight'] = $start;
                    $total['end_flight'] = $time;
                    $total['total'] = $hours;
                    $flight = $this->statistics_model->add_total_flight($total);
                    $this->statistics_model->clear_flights($id);
                    echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - " . date("H:i:s", $hours) . "</p><br />";
                    $this->statistics_model->add_fail_crash($id, $time);
                    //exit();
                } else {
                    if (preg_match("/joined BLUE/", $event)) {
                        //echo "Игрок $nickname присоединился в команду <b style='color:blue;'>Синих</b><br />";
                        $this->statistics_model->delete_from_spectators($id);

                        $check_blue = $this->statistics_model->check_blue($id);
                        if ($check_blue == 0) {
                            $this->statistics_model->join_blue($id, $time, $plane);
                        } else {
                            $this->statistics_model->update_blue_pilot_plane($id, $plane);
                        }
                        $this->statistics_model->left_red($id);
                    }
                    if (preg_match("/joined RED/", $event)) {
                        //echo "Игрок $nickname присоединился в команду <b style='color:red;'>Красных</b><br />";
                        $this->statistics_model->delete_from_spectators($id);
                        $check_red = $this->statistics_model->check_red($id);
                        if ($check_red == 0) {
                            $this->statistics_model->join_red($id, $time, $plane);
                        } else {
                            $this->statistics_model->update_red_pilot_plane($id, $plane);
                        }
                        $this->statistics_model->left_blue($id);
                    }

                }

            }
        }
        switch ($event) {
            case 'Start':
                //echo "Старт сервера в $time<br />";
                $this->statistics_model->server_online();
                break;

            case 'Stop':
                //echo "Остановка сервера в $time<br />";
                $this->statistics_model->server_offline();
                $flights = $this->statistics_model->get_all_current_flights();
                if (!empty($flights)) {
                    $values = '';
                    foreach ($flights as $endflight) {
                        $start = $endflight['flight'];
                        $end = $time;
                        $hours = strtotime($end) - strtotime($start);
                        $values = $values . "(" . $endflight['pilot_id'] . ",'" . $start . "','" . $end . "'," . $hours . "),";
                        $id = $endflight['pilot_id'];
                        $this->statistics_model->delete_all_flights($id);
                    }
                    $values = substr($values, 0, -1);
                    $this->statistics_model->add_not_ended_flights($values);
                }
                $online = $this->statistics_model->get_online_all();
                $spectators = $this->statistics_model->get_all_spectators();
                $red = $this->statistics_model->get_all_red();
                $blue = $this->statistics_model->get_all_blue();
                if (!empty($online)) {
                    foreach ($online as $delete): {
                        $id = $delete['pilot_id'];
                        $this->statistics_model->delete_online($id);
                    }
                    endforeach;
                }
                if (!empty($spectators)) {
                    foreach ($spectators as $spect): {
                        $id = $spect['pilot_id'];
                        $this->statistics_model->delete_from_spectators($id);
                    }
                    endforeach;
                }
                if (!empty($red)) {
                    foreach ($red as $member): {
                        $id = $member['pilot_id'];
                        $this->statistics_model->left_red($id);
                    }
                    endforeach;
                }
                if (!empty($blue)) {
                    foreach ($blue as $member): {
                        $id = $member['pilot_id'];
                        $this->statistics_model->left_blue($id);
                    }
                    endforeach;
                }

                break;

            case 'entered the game':/*Событие входа игрока на сервер*/
                $start_flight = $this->statistics_model->get_start_flight($id);
                if (!empty($start_flight)) {
                    $this->statistics_model->clear_flights($id);
                    //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                }
                $this->statistics_model->add_online($id, $time);
                $this->statistics_model->add_spectator($id, $time);
                break;

            case 'takeoff from':/*Событие взлёта самолёта/вертолёта с аэродрома/корабля*/
                //echo 'Игрок '.$nickname.' взлетел с аэродрома '.$object.' в '.$time.'<br>';
                $nick_id = $this->statistics_model->get_pilot_id($nickname);
                $id = $nick_id['id'];//echo 'ID пилота = '.$id.'<br />';
                $this->statistics_model->add_new_flight($id, $time);
                $this->statistics_model->add_takeoff($id, $time);
                break;

            case 'takeoff': /*Событие взлёта с ППБ*/
                //echo 'Игрок '.$nickname.' взлетел на вертолёте в '.$time.'<br>';
                $nick_id = $this->statistics_model->get_pilot_id($nickname);
                $id = $nick_id['id'];//echo 'ID пилота = '.$id.'<br />';
                $this->statistics_model->add_new_flight($id, $time);
                $this->statistics_model->add_takeoff($id, $time);
                break;

            case 'landed at':/*Событие посадки*/
                //echo 'Игрок '.$nickname.' сел на аэродром '.$object.' в '.$time.'<br>';

                $start_flight = $this->statistics_model->get_start_flight($id);
                $start = $start_flight['last_flight'];
                $hours = strtotime($time) - strtotime($start);
                $total = array();
                $total['pilot_id'] = $id;
                $total['start_flight'] = $start;
                $total['end_flight'] = $time;
                $total['total'] = $hours;
                $flight = $this->statistics_model->add_total_flight($total);
                $this->statistics_model->clear_flights($id);
                $this->statistics_model->add_landing($id, $time);
                //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                break;


            case 'killed':   /*Событие убития*/
                if (preg_match("/$nickname/", $object)) /*ИГРОКА*/ {
                    echo 'Игрок ' . $nickname . ' самоубился в ' . $time . '<br />';//exit();
                    $player_kill = array();
                    $player_kill['pilot_id'] = $id;
                    $player_kill['death'] = $time;
                    $this->statistics_model->add_death($player_kill);
                    $start_flight = $this->statistics_model->get_start_flight($id);
                    if (!empty($start_flight)) {
                        $start = $start_flight['last_flight'];
                        $hours = strtotime($time) - strtotime($start);
                        $total = array();
                        $total['pilot_id'] = $id;
                        $total['start_flight'] = $start;
                        $total['end_flight'] = $time;
                        $total['total'] = $hours;
                        $flight = $this->statistics_model->add_total_flight($total);
                        $this->statistics_model->clear_flights($id);
                    }
                    $this->statistics_model->add_fail_crash($id, $time);
                } else /*Убитие бота или наземки*/ {
                    $check_nick = $this->statistics_model->find_victim($object);
                    if (!empty($check_nick)) {
                        $victim = $check_nick['victim'];
                        $victim_id = $check_nick['id'];
                        $check_pilot_team = $this->statistics_model->get_teamkill($id, $victim_id);
                        if ($check_pilot_team > 1) {
                            $this->statistics_model->add_victim($id, $victim, $time, 1);
                        } else {
                            $this->statistics_model->add_victim($id, $victim, $time, 0);
                        }
                        //echo 'Игрок '.$nickname.' убил игрока '.$victim.' в '.$time.'<br />';

                    } else {
                        $ammunition = trim($data[4]);
                        //echo 'Игрок '.$nickname.' уничтожил '.$object.' с помощью '.$ammunition.' в '.$time.'<br>';//exit();
                        $kill = array();
                        $kill['pilot_id'] = $id;
                        $kill['object'] = $object;
                        $kill['ammunition'] = $ammunition;
                        $kill['data'] = $time;
                        $this->statistics_model->add_new_kill($kill);
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
                    $flight = $this->statistics_model->add_total_flight($total);
                    $this->statistics_model->clear_flights($id);
                    echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - " . date("H:i:s", $hours) . "</p><br />";
                }
                $this->statistics_model->add_fail_crash($id, $time);
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
                    $flight = $this->statistics_model->add_total_flight($total);
                    $this->statistics_model->clear_flights($id);
                    $this->statistics_model->add_fail_crash($id, $time);
                    //echo "<p>Время полёта игрока <b style='color:red;'>$nickname</b> - ".date("H:i:s",$hours)."</p><br />";
                }
                $this->statistics_model->add_fail_crash($id, $time);
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
                    $flight = $this->statistics_model->add_total_flight($total);
                    $this->statistics_model->clear_flights($id);
                } else {
                    //echo "Пилот $nickname присоединился к зрителям сервера!<br />";
                }
                $this->statistics_model->left_blue($id);
                $this->statistics_model->left_red($id);
                $this->statistics_model->add_spectator($id, $time);
                break;
            case 'left the game':/*Событие покидания сервера пилотом*/
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
                    $flight = $this->statistics_model->add_total_flight($total);
                    $this->statistics_model->clear_flights($id);
                }
                $this->statistics_model->delete_from_spectators($id);
                $this->statistics_model->delete_online($id);
                $this->statistics_model->left_blue($id);
                $this->statistics_model->left_red($id);
                break;
        }

        //}
        //fclose($handle);

    }
    function empty_stat(){
        $this->display_lib->empty_stat();
    }
    function empty_db(){
        $this->dcs_lib->isPost();
        $pass = md5(trim($this->input->post('password')));
        $main_pass = md5('Vortex2015eekz');
        if($pass != $main_pass){
            echo 0;
        }else{
            $delete = $this->statistics_model->clear_db();
            echo 1;
        }
    }
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */