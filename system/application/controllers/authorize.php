<?php

class Authorize extends Controller {

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
		$this->load->view('authorize');        
	}
    function login()
        {
            $email = trim($this->input->post('email'));
            //echo $email;exit();
            $password = sha1(md5($_POST['password']));
            //$password = $_POST['password'];
            //echo $password;exit();
            $ip = $_SERVER["REMOTE_ADDR"];
            //echo $ip;exit();
            
            //ОЧИСТКА ПАРОЛЮ
            /*$clear_password = $_POST['password'];
            $pass = array();          
            $pass['clear_password'] = $clear_password;
            $pass['password'] = $password;            
            $this->main_model->add_password($pass);
            exit();*/
            
            $ban = $this->main_model->check_ip($ip);
            //echo $ban;exit(90);
            if ($ban > 0) 
            {
                echo "banned";exit();  
            }     
            $check = $this->main_model->check_user($email,$password);
            //echo $check;exit();
            if($check == 1) 
            {
                $now = date("Y-m-d H:i:s",time()+10800);
                //echo $now;exit();
                $this->main_model->delete_sessions($email);
                $user = array();
                $user = $this->main_model->get_login($email);
                $data = array(
                     'session_id'=> $email, 
                     'ip_address'=> $_SERVER["REMOTE_ADDR"],
                     'user_agent'=> $_SERVER['HTTP_USER_AGENT'],
                     'last_activity'=> $now,
                     'user_data'=> $user['login'],           
                );
                //print_r($data);exit();
                $this->main_model->session_record($data);               
                $ses_data = array('email' => $user['email'],
                                  'login' => $user['login'],
                                  'rights' =>$user['rights'],
                                  'admin' =>$user['admin'],
                );
                //print_r($ses_data);exit();                
                $this->session->set_userdata($ses_data);
                $this->main_model->clear_fails($email);
                
                //$this->main_model->clear_db_sessions($ip);
                //print_r($ses_data);exit();                
                echo 'accepted';
            } 
            else 
            {
                $fails = $this->main_model->count_fail_auth($email);
                //echo $fails;exit();
                //echo $fails;exit();
                if ($fails < 3 )
                {   
                    $fail = array();
                    $fail['email'] = $email;
                    $fail['date'] = date("Y-m-d H:i:s",time()+10800);
                    $fail['ip_adress'] = $_SERVER["REMOTE_ADDR"];
                    $this->main_model->add_fail_auth($fail);
                    echo 'denied';
                }
                else
                {
                    $this->main_model->clear_fails($email);
                    $ban = array();
                    $ban['email'] = $email;
                    $ban['ip_adress'] = strval($_SERVER["REMOTE_ADDR"]);
                    $ban['banned_to'] = date("Y-m-d H:i:s",time()+(10800*5));
                    $this->main_model->add_to_banlist($ban);
                    echo 'banned';                                    
                }
                                
                
            }
        }
        
        function register()
        {
            $email = trim(strip_tags($this->input->post('email')));
            $clear_password = $this->input->post('email');
            $password = sha1(md5($_POST['password']));
            $ip = $_SERVER["REMOTE_ADDR"];
            
             
        }
        
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */