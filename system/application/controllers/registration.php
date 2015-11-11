<?php
if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
class Registration extends Controller {

	function __constructor()
	{
		parent::Controller();
        	
	}
    public function index()
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $this->session->sess_destroy();
        $this->main_model->clear_db_sessions($ip);
        $this->sessions_lib->check_ip($ip);
		$this->load->view('register');    
    }
    function register()
    {
            $login = trim(strip_tags($this->input->post('username')));
            $email = trim(strip_tags($this->input->post('email')));
            $clear_password = $this->input->post('password');
            $password = sha1(md5($_POST['password']));
            $fullname = trim(strip_tags($this->input->post('name')));
            //$ip = $_SERVER["REMOTE_ADDR"];
            
            $check_user = $this->main_model->check_for_user($login);
            $check_email = $this->main_model->check_for_email($email);
            if($check_user > 0)
            {
                echo "error_user";
            }
            else if($check_email > 0 )
            {
                echo "error_user";    
            }
            else
            {
                $user=array();
                $user['login'] = $login;
                $user['email'] = $email;
                $user['clear_password'] = $clear_password;
                $user['password'] = $password;
                $user['full_name'] = $fullname;
                //print_r($user);exit();
                $register = $this->main_model->user_register($user);
                if($register)
                {
                    echo "registered";
                }
                else
                {
                    echo 'not_registered';
                }
            }
    }
        
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */