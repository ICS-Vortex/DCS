<?php

if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Dcs_lib
{
    /************************DCS Functions************************/

    function calculate_flight($id, $time,$start_flight)
    {

        $CI =& get_instance();

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
        $flight = $CI->statistics_model->add_total_flight($total);
        $CI->statistics_model->clear_flights($id);
    }

    function add_death($id,$time){
        $CI =& get_instance();

        $death = array(
            'pilot_id' => $id,
            'death' => $time,
        );
        $dead = $CI->statistics_model->add_death($death);
    }

    function calculate_streaks($id){
        $CI =& get_instance();

        $count_temp_streaks = $CI->statistics_model->get_temporary_streak($id);
        $best_streak = $CI->statistics_model->get_best_streak($id);
        if(!empty($best_streak)){
            if($best_streak['streak'] > $count_temp_streaks['now_streak']){
                $streak = $best_streak['streak'];
            }else{
                $streak = $count_temp_streaks['now_streak'];
            }
        }else{
            $streak = $count_temp_streaks['now_streak'];
        }
        $insert_streak = $CI->statistics_model->insert_best_streak($id,$streak);
        $clear_temp_streaks = $CI->statistics_model->clear_temp_streaks($id);
    }

    function isPost(){
        $CI =& get_instance ();
        $method = $_SERVER['REQUEST_METHOD'];

        if($method != 'POST'){
            header('Bad Request', true, 400);
            echo "<h1> 400 Bad request</h1>";
            die();
        }
    }

}


?>

