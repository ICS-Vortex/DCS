<?php

	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');

    class Functions_lib

    {

        function main_authorize()

        {

            //header('Content-Type: text/html; charset=utf-8');

            $CI =& get_instance ();

            $ip = $_SERVER["REMOTE_ADDR"];

            $login = $CI->session->userdata('login');

            $email = $CI->session->userdata('email');

            if (empty($login) || empty($email))

            {

                redirect(base_url());

            }

            $CI->load->model('main_model');

            $CI->load->library('session');

            $check_ip = $CI->main_model->check_ip($ip); 

            //exit($check_ip);           

            if ($check_ip > 0)

            {

                $CI->session->sess_destroy();

                $CI->main_model->clear_db_sessions($ip);

                redirect(base_url().'banned');

            }            

            $session_data = $CI->main_model->get_session_data($login);

            if(!$session_data) redirect(base_url());

            $now = time()+10800;

            $last = strtotime($session_data['last_activity']);

            $timeout = $now-$last;

            //exit($timeout);                

            if($timeout > 2400 || $login == '')

            {

                redirect(base_url());   

            }            

            $now = date("Y-m-d H:i:s",time()+10800);

            $time = array('last_activity'=>$now);

            $CI->admin_model->update_sessions($email,$now);            

        }

        function authorize()

        {

            header('Content-Type: text/html; charset=utf-8');

            $CI =& get_instance ();

            $ip = $ip = $_SERVER["REMOTE_ADDR"];

            $login = $CI->session->userdata('login');

            $email = $CI->session->userdata('email');

            $CI->load->model('main_model');

            $CI->load->library('session');

            $check_ip = $CI->main_model->check_ip($ip); 

            //exit($check_ip);           

            if ($check_ip > 0)

            {

                $CI->session->sess_destroy();

                $CI->main_model->clear_db_sessions($ip);

                redirect(base_url().'banned');

            }            

            $session_data = $CI->main_model->get_session_data($login);

            if(!$session_data) redirect(base_url().'admin/index');

            $now = time()+10800;

            $last = strtotime($session_data['last_activity']);

            $timeout = $now-$last;

            //exit($timeout);                

            if($timeout > 2400 || $login == '')

            {

                redirect(base_url().'admin/lockscreen');   

            }            

            $now = date("Y-m-d H:i:s",time()+10800);

            $time = array('last_activity'=>$now);

            $CI->admin_model->update_sessions($email,$now);

            $admin = $CI->main_model->get_admin($login);

            $check = $admin['admin'];

            if ($check != 1)

            {

                $CI->load->view('system_header_view');

                $CI->load->view('header_access_view');

                $CI->load->view('access_view'); 

                $CI->load->view('footer_view'); 

            }

            

        }

        

        function check_login($ip)

        {

            $CI = & get_instance();

            header('Content-Type: text/html; charset=utf-8');            

            $CI->sessions_lib->check_ip($ip);

    		$CI->sessions_lib->check_sesions();

            $CI->sessions_lib->check_admin();          

        }

        

        function change_date($d)

        {

            $CI =& get_instance ();

            $date=explode("-", $d);

                switch ($date[1]){

                case 1: $m='Січень'; break;

                case 2: $m='Лютий'; break;

                case 3: $m='Березень'; break;

                case 4: $m='Квітень'; break;

                case 5: $m='Травень'; break;

                case 6: $m='Червень'; break;

                case 7: $m='Липень'; break;

                case 8: $m='Серпень'; break;

                case 9: $m='Вересень'; break;

                case 10: $m='Жовтень'; break;

                case 11: $m='Листопад'; break;

                case 12: $m='Грудень'; break;

                }

            $result = $m.'&nbsp;'.$date[0].' р.';

            return $result; 

        }

    

    }





?>