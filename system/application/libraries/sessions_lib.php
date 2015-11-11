<?php
	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
    class Sessions_lib
    {
         
        function check_sesions()
        {
                $CI =& get_instance ();
                $login = $CI->session->userdata('login');
                $session_data = $CI->main_model->get_session_data($login);
                if(!$session_data) redirect(base_url());
                $now = time()+10800;
                $last = strtotime($session_data['last_activity']);
                $timeout = $now-$last;
                
                if($timeout > 2400 or !$login)
                {
                    redirect('authorize/index');   
                }
                else 
                {
                    $now = date("Y-m-d H:i:s",time()+10800);
                    $time = array('last_activity'=>$now);
                    $CI->main_model->upd_sessions($login,$time);
                }
            
        }
        function check_admin()
        {
            $CI =& get_instance ();
            
            $login = $CI->session->userdata('login');
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
        function check_ip($ip)
        {
            $CI =& get_instance ();
            $CI->load->model('main_model');
            $CI->load->library('session');
            $check_ip = $CI->main_model->check_ip($ip);
            
            if ($check_ip > 0)
            {
                $CI->session->sess_destroy();
                $CI->main_model->clear_db_sessions($ip);
                redirect(base_url().'banned');
            }
            
               
        }               
    
    }


?>
