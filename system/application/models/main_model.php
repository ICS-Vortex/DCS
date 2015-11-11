<?php
	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
    class Main_model extends Model
    {
        public function __constructor()
        {
            parent::Model();
        }
        function user_register($data)
        {
            $query = $this->db->insert('users',$data);
            return $query;
        }
        function get_login($email)
        {
            $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
            return $query->row_array();
        }
        function get_admin($login)
        {
            $query = $this->db->query("SELECT admin FROM users WHERE login='$login'");
            return $query->row_array();
            
        }
        /********************************ВАЛІДАЦІЯ*******************************************/
        function check_user($email,$password) 
        {
            $this->db->where("email", $email);
            $this->db->where("password", $password);
            $query = $this->db->get('users');
            $count = $query->num_rows(); 
            return $count;            
        }
        
        function check_for_user($login) 
        {
            $this->db->where("login", $login);
            $query = $this->db->get('users');
            $count = $query->num_rows(); 
            return $count;            
        }
        function check_for_email($email) 
        {
            $this->db->where("email", $email);
            $query = $this->db->get('users');
            $count = $query->num_rows(); 
            return $count;            
        }
        function clear_fail_logins($email)
        {
            $this->db->where('email',$email);
            $this->db->delete('fail_logins');
        }
        /****************************Перевірка IP-адреси************************************/
        
        function check_ip($ip)
        {
            $query = $this->db->query("SELECT * FROM banlist WHERE ip_adress='$ip'");
            $count = $query->num_rows();
            return $count;
                
        }
        function delete_sessions($email)
        {
            $this->db->where('session_id',$email);
            $this->db->delete('sessions');
        }
        /*************************************Час бану**************************************/
        function banned_to($ip)
        {
            $query = $this->db->query("SELECT * FROM banlist WHERE ip_adress='$ip'");
            return $query->row_array();
        }
        function clear_ban($ip)
        {
            $this->db->where('ip_adress',$ip);
            $this->db->delete('banlist');
        }
        
        /****************************Невдалі спроби авторизації та БАН ************************************/
        function count_fail_auth($email)
        {
            $this->db->where('email',$email);
            $query = $this->db->get('fail_logins');
            $count =  $query->num_rows(); 
            return $count;    
        }
        function add_fail_auth($data)
        {
            $this->db->insert('fail_logins',$data);
        }
        function clear_fails($email)
        {
            $this->db->where('email',$email);
            $this->db->delete('fail_logins');
        }
        function add_to_banlist($data)
        {
            $this->db->insert('banlist',$data);    
        }
        
        /*****************************************************************/
        function session_record($data)
        {
            $this->db->insert('sessions',$data);
        }
        function add_password ($pass)
        {
            $this->db->where('login','admin');
            $this->db->update('users',$pass);
        }
       
        function get_session_data($login)
        {
            $this->db->where('user_data',$login);
            $query = $this->db->get('sessions');
            return $query->row_array();
        }
        function clear_sessions($data)
        {
            $this->db->where('session_id',$data);
            $this->db->delete('sessions'); 
        }
        function upd_sessions($data,$now)
        {
            $this->db->where('user_data',$data);
            $this->db->update('sessions',$now);
        }
        
        function clear_db_sessions($ip)
        {
            $this->db->where('ip_address',$ip);
            $this->db->delete('sessions'); 
        }
        
        
        /******************************************************************************************************/
        /******************************************************************************************************/
        /******************************************************************************************************/
        
        /************************************РАЙОН ЕЛЕКТРО МЕРЕЖ***********************************************/
        
        
        function get_rem_stat($from,$to)
        {   
            
            $query = $this->db->query("SELECT SUM(total), addr FROM rem_stata WHERE date BETWEEN '$from' AND '$to' GROUP BY addr ORDER BY addr ASC");
            return $query->result_array();
        }
        function get_adress()
        {
            $query = $this->db->query("SELECT DISTINCT addr FROM rem_zones ORDER BY addr ASC");
            return $query->result_array();
        }
        function get_by_type($from,$to,$type)
        {
            $query = $this->db->query("SELECT SUM(total), addr FROM rem_stata WHERE date BETWEEN '$from' AND '$to' && type='$type' GROUP BY addr ORDER BY addr ASC");
            return $query->result_array();   
        }
        function get_by_adress($from,$to,$adress)
        {
            $query = $this->db->query("SELECT * FROM rem_stata WHERE date BETWEEN '$from' AND '$to' && addr='$adress' ORDER BY date ASC");
            return $query->result_array();   
        }
        function get_objects()
        {
            $query = $this->db->query("SELECT DISTINCT place FROM rem_zones ORDER BY addr ASC");
            return $query->result_array();   
        }
        function get_by_object($from,$to,$object)
        {
            $query = $this->db->query("SELECT * FROM rem_stata WHERE date BETWEEN '$from' AND '$to' && place='$object' ORDER BY date ASC");
            return $query->result_array();   
        }
        function insert_rem($values)
        {
            $this->db->query("INSERT INTO rem_stata(date,addr,counter,zone,type,now,last,result,quotient,total,place) VALUES $values 
            ");
        }
        function get_counters()
        {
            $query = $this->db->query("SELECT DISTINCT counter FROM rem_zones ORDER BY counter ASC");
            return $query->result_array();   
        }
        function search_counter($query)
        {
            $query = $this->db->query("SELECT DISTINCT counter FROM rem_zones WHERE counter LIKE '%$my_data%'");
            return $query->result_array();
        }
        
        /******************************************************************************************************/
        /******************************************************************************************************/
        /******************************************************************************************************/
        
        /**********************************************ВИБОРКИ ГАЗУ********************************************************/


        function gas_adress()
        {
            $query = $this->db->query("SELECT DISTINCT addr FROM gas ORDER BY addr ASC");
            return $query->result_array();
        }
        function gas_by_adress($from,$to,$adress)
        {
            $query = $this->db->query("SELECT * FROM gas WHERE date BETWEEN '$from' AND '$to' && addr='$adress' ORDER BY date ASC");
            return $query->result_array();   
        }
        function get_total($from,$to)
        {
            $query = $this->db->query("SELECT SUM(total), addr FROM gas WHERE date BETWEEN '$from' AND '$to' GROUP BY addr ORDER BY addr ASC");
            return $query->result_array();   
        }
        function insert_gas($values)
        {
            $this->db->query("INSERT INTO gas(date,addr,counter,total) VALUES $values ");    
        }
        
         /******************************************************************************************************/
        /******************************************************************************************************/
        /******************************************************************************************************/
        
        function fuel_stat($from,$to)
        {
            $query = $this->db->query("SELECT SUM(km) as km, SUM(liters) as liters, SUM(price) as price,date FROM fuel WHERE date BETWEEN '$from' AND '$to' GROUP BY date ORDER BY date ASC");
            return $query->result_array();    
        }
        
        function add_fuel($data)
        {
            $this->db->insert('fuel',$data);
        }
        
        /******************************************************************************************************/
        /*******************************************АМОРТИЗАЦІЯ**********************************************/
        /******************************************************************************************************/
        function get_new_asset_id()
        {
            $query = $this->db->query("SELECT asset_id FROM main_assets ORDER BY asset_id DESC LIMIT 1");
            return $query->row_array();
        }
        function get_cities($bookkeeper)
        {
            $query = $this->db->query("SELECT * FROM cities WHERE asset_bookkeeper='$bookkeeper' ORDER BY title ASC");
            return $query->result_array();
        }
        function get_category()
        {
            $query = $this->db->query("SELECT * FROM asset_categories ORDER BY category_id ASC");
            return $query->result_array();
        }
        function get_all_funds()
        {
            $query = $this->db->get('funds_types');
            return $query->result_array();
        }
        function get_sub_number($sub_number)
        {
            $this->db->where('sub_number',$sub_number);
            $query = $this->db->get('asset_categories');
            return $query->result_array();
        }
        function insert_asset($data)
        {
            $query = $this->db->insert('main_assets',$data);
            return $query;
        }
        function insert_amortisation($amortisation)
        {
            $query = $this->db->insert('amortisation',$amortisation);
            return $query;
        }
        function check_category($category)
        {
            $this->db->where('category_title',$category);
            $query = $this->db->get('asset_categories');
            return $query->num_rows();
        }
        function add_category($data)
        {
            $query = $this->db->insert('asset_categories',$data);
            return $query;   
        }
        function update_category($id,$data)
        {
            $this->db->where('category_id',$id);
            $query = $this->db->update('asset_categories',$data);
            return $query;
        }
        function check_city($city)
        {
            $this->db->where('title',$city);
            $query = $this->db->get('cities');
            return $query->num_rows();
        }
        function add_city($data)
        {
            $query = $this->db->insert('cities',$data);
            return $query;     
        }
        function get_bookkeeper_sub_numbers($bookkeeper)
        {
            $query = $this->db->query("SELECT DISTINCT sub_number FROM main_assets WHERE bookkeeper='$bookkeeper'");
            return $query->result_array();
        }
        function get_funds_bookkeeper($bookkeeper,$sub_number)
        {
            $query = $this->db->query("
                SELECT DISTINCT 
                    main_assets.funds_id as funds_id, 
                    funds_types.title AS fund_title
                FROM main_assets
                LEFT JOIN funds_types ON funds_types.id=main_assets.funds_id
                WHERE main_assets.bookkeeper='$bookkeeper' && 
                main_assets.sub_number=$sub_number
            ");
            return $query->result_array();
        }
        
        /*********************Виборка даних для розрахунку амортизації**********************/
        function get_asset_amort($asset_id)
        {
            $query = $this->db->query("SELECT SUM(amortisation) as amortisation FROM amortisation WHERE asset_id=$asset_id");
            return $query->row_array();            
                    
        }
        function get_full_name($bookkeeper)
        {
            
            $query = $this->db->query("SELECT * FROM users WHERE login='$bookkeeper'");
            return $query->row_array();
        }
        function get_sub_numbers()
        {
            $query = $this->db->query("SELECT DISTINCT sub_number FROM asset_categories ORDER BY sub_number ASC ");
            return $query->result_array();
        }       
        function get_calc_info($bookkeeper)
        {
            $query = $this->db->query("
            SELECT 
                cities.title AS city,
                main_assets.asset_title AS title,            
                main_assets.asset_id AS asset_id,                        
                main_assets.category_id AS category_id,
                main_assets.inventory_number AS number,
                main_assets.amort_price AS price,
                total_amort,
                asset_categories.useful_time AS useful_time
                FROM main_assets AS main_assets 
                LEFT JOIN cities ON cities.city_id=main_assets.city_id
                LEFT JOIN asset_categories ON asset_categories.category_id=main_assets.category_id
                LEFT JOIN (SELECT asset_id,SUM(amortisation) AS total_amort FROM amortisation GROUP BY asset_id) as amort_info ON amort_info.asset_id=main_assets.asset_id
            WHERE main_assets.bookkeeper='$bookkeeper' 
            ");
            return $query->result_array();
        }
        function insert_calculating($values)
        {
            $query = $this->db->query("INSERT INTO amortisation(period,category_id,asset_id,amortisation) VALUES $values 
            ON DUPLICATE KEY UPDATE amortisation=VALUES(amortisation)");
            return $query;
        } 
        function get_amort_by_object($sub_number,$object,$period,$bookkeeper,$funds_id)
        {
            $query = $this->db->query("
                SELECT 
                    amortisation.period AS period,
                    amortisation.amortisation AS amortisation,
                    main_assets.asset_title AS title,
                    main_assets.sub_number as sub_number,
                    cities.title as object,            
                    main_assets.asset_id AS asset_id,                        
                    main_assets.inventory_number AS inventory_number,
                    main_assets.first_price AS first_price,
                    main_assets.amort_price AS amort_price,
                    total_amort,
                    asset_categories.useful_time AS useful_time
                FROM main_assets AS main_assets 
                LEFT JOIN cities ON cities.city_id=main_assets.city_id
                LEFT JOIN amortisation on amortisation.asset_id=main_assets.asset_id
                LEFT JOIN asset_categories ON asset_categories.category_id=main_assets.category_id
                LEFT JOIN (SELECT asset_id,SUM(amortisation) AS total_amort FROM amortisation WHERE period < '$period' GROUP BY asset_id) as amort_info ON amort_info.asset_id=main_assets.asset_id
            WHERE main_assets.bookkeeper='$bookkeeper' && 
            amortisation.period='$period' && main_assets.city_id=$object && 
            asset_categories.sub_number=$sub_number && 
            main_assets.funds_id=$funds_id
            ");
            return $query->result_array();
        }
              
    }


/* INSERT ... ON DUPLICATE KEY UPDATE Syntax*/
/*WHERE period between '$period' and  DATE_ADD(DATE_ADD('$period', INTERVAL 4 MONTH), INTERVAL -1 SECOND)*/
?>