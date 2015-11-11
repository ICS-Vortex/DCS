<?php
if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
class Admin extends Controller {

	function __constructor()
	{
		parent::Controller();
        	
	}

    public function index()
	{
        $ip = $_SERVER["REMOTE_ADDR"];
        $this->sessions_lib->check_ip($ip);
        $this->session->sess_destroy();
        $this->main_model->clear_db_sessions($ip);        
		$this->load->view('administration/login_view');        
	}
    public function lockscreen()
    {        
        $data = array();
        $data['login'] = $this->session->userdata('login');
        if ($data['login'] == '')
        {
            redirect(base_url().'admin');
        }
        $data['result'] = ''; 
        $this->load->view('administration/lockscreen_view',$data);
    }
    function lockscreen_check()
    {
        $email = $this->session->userdata('email');
        $password = sha1(md5($this->input->post('password'))); 
        $check = $this->admin_model->lockscreen_check($email,$password); 
        //echo $check;exit();
        if ($check != 1)
        {
            $data = array();
            $data['date'] = date("Y-m-d H:i:s",time() + 10800);
            $data['email'] = $email;
            $data['ip_adress'] = $_SERVER["REMOTE_ADDR"];
            $add_fail = $this->admin_model->add_fails($data);
            //exit($add_fail);
            $data['login'] = $this->session->userdata('login');
            $data['result'] = 'fail';
            $this->load->view('administration/lockscreen_view',$data);    
        }
        else
        {
            $now = date("Y-m-d H:i:s",time() + 10800);
            $update_sessions = $this->admin_model->update_sessions($email,$now);
            //echo $update_sessions;exit();
            $data = array();            
            $data['email'] = $email;
            $data['ip_adress'] = $_SERVER["REMOTE_ADDR"];
            $data['login'] = $this->session->userdata('login');
            //print_r($data);exit();
            $clear = $this->admin_model->clear_fails($email);  
            //echo $clear;exit(); 
            //exit($update_sessions);
            redirect(base_url().'admin/main');
        }  
    }
    function login()
        {
            $email = trim($this->input->post('email'));
            //echo $email;exit();
            $password = sha1(md5($_POST['password']));
            //$password = $_POST['password'];
            //echo $password;exit();
            $ip = $_SERVER["REMOTE_ADDR"];
            $this->sessions_lib->check_ip($ip);
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
                $this->main_model->clear_fail_logins($email);
                
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
        
       	public function main()
	   {    
	        $this->functions_lib->authorize();
            $data = array();
            $data['new_users'] = $this->admin_model->get_new_users();
            $data['login'] = $this->session->userdata('login'); 
            $data['chat'] = $this->admin_model->get_all_chat();           
            $this->display_lib->main_admin_page($data);           
	   }
       /********************* Чат *************/
       function chat()
       {
            //$this->functions_lib->authorize();
            $message_id = $this->input->post('last_message_id');
            //exit($message_id);
            $new_message = $this->admin_model->get_last_messages($message_id);
            //print_r($new_message);
            if (count($new_message)>0)
            {
                echo 'success';
            }
            else
            {
                echo 'empty';
            }          
       }
       function add_message()
       {
            $message = $this->input->post('message');
            $login = $this->session->userdata('login');
            $user_info = $this->admin_model->get_user_info($login);
            $photo = $user_info['photo'];
       }
       /********************РЕМ**********************/ 

         
         /******************************* DCS Units*********************/
         public function units()
         {
            $this->functions_lib->authorize();
            $data = array();            
            $data['result'] = '';
            $data['login'] = $this->session->userdata('login');
            $data['units'] = $this->admin_model->get_all_units();
            $this->display_lib->edit_category_units($data);                      
         }
         
         function edit_units()
         {
            //echo 'good';
            header('Content-Type: text/html; charset=utf-8');  
            $unit_name = $this->input->post('unit_name');
            //print_r($unit_name);exit();
            $unit_category = $this->input->post('unit_category');
            //print_r($unit_category);exit();
            $count = count($unit_name);
            for ($i=0;$i<$count;$i++)
            {
                $unit = $unit_name[$i];
                $category = $unit_category[$i];
                //echo "Юнит <b>$unit</b>, Категория <b>$category</b><br />";
                $update = $this->admin_model->update_dcs_units($unit,$category);
            }
            redirect(base_url().'admin/units');
         }
         
         /*********************************************************/
         function delete_user()
         {
            $this->functions_lib->authorize();
            $user_id = $this->input->post('user_id');
            //exit($user_id);
            $delete = $this->admin_model->delete_user($user_id);
            //$delete=TRUE;
            if ($delete==TRUE)
            {
                echo 'success';
            }
            else 
            {
                echo $delete;
            }            
         }
         public function edit_users()
         {
            header('Content-Type: text/html; charset=utf-8');
            $this->functions_lib->authorize();
            $names = $this->input->post('names');  /*найменування юзерів*/
            $user_id = $this->input->post('user_id');
            $clear_password = $this->input->post('new_pass');
            $email = $this->input->post('email');
            $full_name = $this->input->post('full_name');
            $checked = $this->input->post('checked');	/*відмічені Перевірені */
	        $old_checked = $this->input->post('old_checked'); /*старі перевірені*/
	        $rule = $this->input->post('rule');/*лічильник відмічені адміни*/
            $old_rule = $this->input->post('old_rule');/*старі адміни*/
            $count=count($names);/* лічильник юзерів*/
            $count_old = count($old_checked);/*лічильник старих прав*/
            $count_checked = count($checked);/*лічильник прав*/
            $count_rule = count($rule);/*лічильник адмінів*/
            $count_old_rule = count($old_rule);/*лычильник старих прав адмінів*/
            $rights = array();
            $admins = array();
            $password = array();
            //echo $count;exit();
            $values = '';
        	for ($i=0;$i < $count;$i++)
            {

                    $password[$i] = sha1(md5($clear_password[$i]));                   
                    /**************Для перевірених юзерів*************/
                    
                    $right=0;
            		for ($j = 0;$j < $count_checked;$j++)
                    {
            			if($checked[$j] == $names[$i])
            				{$right = 1;break;}
            		}
            		$old_right = 0;
            		for ($k = 0;$k < $count_old;$k++)
                    {
            			if ($names[$i] == $old_checked[$k])
            				{$old_right = 1;}		
                    }
            		if ($right != $old_right)     # Права изменились, делаем апдейт			 
           			{
               			if ($right == 1)
         				{         				    
         				    $rights[$i] = 1;   
                            $trig = 1;
                        }
                        else
                        {
     			            $rights[$i] = 0;
                            $trig = 1;
                        }                       
                    }
                    else 
                    {
                        $rights[$i]=0;
                    }
                    /*************Перевірка адміна***********/
                    
                    $admin=0;
            		for ($j = 0;$j < $count_rule;$j++)
                    {
            			if($rule[$j] == $names[$i])
            				{$admin = 1;break;}
            		}
            		$old_admin = 0;
            		for ($k = 0;$k < $count_old_rule;$k++)
                    {
            			if ($names[$i] == $old_admin[$k])
            				{$old_admin = 1;}		
                    }
                    
            		if ($admin != $old_admin)								# Права изменились, делаем апдейт			 
           			{
               			if ($admin == 1)
         				{         				    
         				    $admins[$i] = 1;   
                            $trig = 1;
                        }
                        else
                        {
     			            $admins[$i] = 0;
                            $trig = 1;
                        }                       
                    }
                    else 
                    {
                        $admins[$i]=0;
                    }
                    $value = "($user_id[$i],'$names[$i]','$password[$i]','$clear_password[$i]','$email[$i]','$full_name[$i]',$rights[$i],$admins[$i]),";
                    $values = $values.$value;                                                                
            }
            $values = substr($values, 0, -1);
            //exit($values);
            $update_users = $this->admin_model->edit_users($values);
            if ($update_users==TRUE)
            {
                $result = 1;
            }
            else 
            {
                $result= 0;
            }           
            $data = array();
            $data['users'] = $this->admin_model->get_users();
            $data['login'] = $this->session->userdata('login');
            $data['result'] = $result;
            $this->display_lib->user_access($data);  
         }
         
       
}

