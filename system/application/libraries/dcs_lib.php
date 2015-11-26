<?php

if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Dcs_lib
{
    /************************DCS Functions************************/

    function calculate_flight($id, $time)
    {
        //header('Content-Type: text/html; charset=utf-8');

        $CI =& get_instance();

        $start = $start_flight['last_flight'];
        $hours = strtotime($time) - strtotime($start);
        $total = array();
        $total['pilot_id'] = $id;
        $total['start_flight'] = $start;
        $total['end_flight'] = $time;
        $total['total'] = $hours;
        $flight = $CI->statistics_model->add_total_flight($total);
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

