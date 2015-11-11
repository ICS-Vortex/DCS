<?php
	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
    class Admin_model extends Model
    {
        public function __constructor()
        {
            parent::Model();
        }
        /******************************/
        function lockscreen_check($email,$password)
        {
            $this->db->where('email',$email);
            $this->db->where('password',$password);
            $query = $this->db->get('users');
            return $query->num_rows();
        }
        function add_fails($data)
        {
            $query = $this->db->insert('fail_logins',$data); 
            return $query;   
        }
        function clear_fails($email)
        {
            $this->db->where('email',$email);
            $query = $this->db->delete('fail_logins');
            return $query;
        }
        function update_sessions($email,$now)
        {
            $query = $this->db->query("UPDATE sessions SET last_activity='$now' WHERE session_id='$email'");
            return $query;
        }
        /********************************/
        function get_new_users()
        {
            $query = $this->db->query("SELECT * FROM users WHERE admin=0 && rights=0");
            return $query->num_rows();
        }

        /************* Користувачі **********/
        function get_all_users()
        {
            $query = $this->db->query("SELECT * FROM users ORDER BY login ASC");
            return $query->result_array();
        }
        function delete_user($user_id)
        {
            $this->db->where('user_id',$user_id);
            $query = $this->db->delete('users');
            return $query;
        }
        /************ Чат **********/
        function get_all_chat()
        {
            $query = $this->db->query("SELECT 
            chat.message_id AS message_id,
            chat.login AS login,
            chat.text AS text,
            chat.date AS date, 
            users.photo AS photo
            FROM chat 
            LEFT JOIN users ON users.login=chat.login
            ORDER BY chat.message_id DESC");
            return $query->result_array();
        }
        function get_last_messages($message_id)
        {
            $query = $this->db->query("SELECT 
                chat.message_id AS message_id, 
                chat.login AS login, 
                chat.text AS TEXT, 
                chat.date AS DATE, users.photo AS photo
            FROM chat
                LEFT JOIN users ON users.login = chat.login
            WHERE chat.message_id >$message_id
            ORDER BY chat.message_id DESC 
            ");
            return $query->result_array();   
        }
        function get_user_info($login)
        {
            $this->db->where("login","$login");
            $query = $this->db->get('users');
            return $query->row_array();
        }
        
        /********DCS*********/
        function get_all_units()
        {
            $query = $this->db->query("SELECT * FROM dcs_units GROUP BY name ORDER BY name ASC");
            return $query->result_array();
        }
        function update_dcs_units($unit,$category)
        {
            $this->db->query("UPDATE dcs_units SET category=$category WHERE name='{$unit}'");
        }
                    
    }


/* INSERT ... ON DUPLICATE KEY UPDATE Syntax*/
?>