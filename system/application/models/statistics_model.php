<?php
	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
    class Statistics_model extends Model
    {
        public function __constructor()
        {
            parent::Model();
        }
        /***********������� ��������*********/
        function main_get_current_flights()
        {
            $query = $this->db->query("
                SELECT flights.pilot_id,
                    pilots.nickname AS nickname
                FROM flights
                LEFT JOIN pilots ON pilots.id=flights.pilot_id
            ");
            return $query->result_array();
        }
        function main_pilots_online()
        {
           $query = $this->db->query("SELECT dcs_online.pilot_id,
                    pilots.nickname AS nickname
                FROM dcs_online
                LEFT JOIN pilots ON pilots.id=dcs_online.pilot_id  
           ");
           return $query->result_array();    
        }
        function main_get_all_flights()
        {
            $query = $this->db->query("
                SELECT pilots.nickname AS nickname,
                  pilots.id AS id,
                  flight_hours.total AS total_flights,
                  total_kills.total_kill AS total_kills,
                  count_death.death AS count_death,
                  fails_flights.fails AS total_fail
                FROM pilots
                LEFT JOIN 
                     (SELECT pilot_id, SUM(total) AS total FROM flight_hours
                        GROUP BY pilot_id
                     )AS flight_hours
                ON flight_hours.pilot_id=pilots.id
                LEFT JOIN 
                     (SELECT pilot_id, COUNT(object) AS total_kill 
                      FROM pilots_kills                
                      GROUP BY pilot_id
                     )
                     AS total_kills
                ON total_kills.pilot_id=pilots.id
                LEFT JOIN 
                       (SELECT pilot_id, COUNT( death ) AS death
                               FROM  `pilots_death` 
                               GROUP BY pilot_id
                       ) AS count_death ON count_death.pilot_id=pilots.id
               LEFT JOIN (SELECT pilot_id, COUNT( data )  AS fails
                                 FROM  `fail_flights` 
                                 GROUP BY pilot_id
                                 ) AS fails_flights ON fails_flights.pilot_id=pilots.id
                ORDER BY pilots.nickname ASC
        
  
            ");
            return $query->result_array();
        }
        /*��������� ������ ��������*/
        function get_spectators()
        {
            $query = $this->db->query("
                SELECT dcs_spectators.pilot_id AS id, 
                        pilots.nickname AS nickname
                FROM dcs_spectators
                JOIN pilots ON pilots.id=dcs_spectators.pilot_id
            
            ");
            return $query->result_array();  
        }
        
        /*��������� ������ ������� �������*/
        function get_redteam()
        {
            $query = $this->db->query("
                SELECT dcs_redteam.pilot_id AS id, 
                        pilots.nickname AS nickname,
                        dcs_redteam.plane AS plane
                FROM dcs_redteam
                JOIN pilots ON pilots.id=dcs_redteam.pilot_id
            
            ");
            return $query->result_array();  
        }
        /*��������� ������ ����� �������*/
        function get_blueteam()
        {
            $query = $this->db->query("
                SELECT dcs_blueteam.pilot_id AS id, 
                        pilots.nickname AS nickname,
                        dcs_blueteam.plane AS plane
                FROM dcs_blueteam
                JOIN pilots ON pilots.id=dcs_blueteam.pilot_id
            
            ");
            return $query->result_array();  
        }
        /*�������� ���� ������ � ����*/
        function check_nick($nickname)
        {
            $query = $this->db->query("SELECT COUNT(nickname) AS pilot_count FROM pilots WHERE nickname='$nickname'");
            return $query->row_array();
        }
        /*add pilot to base*/
        function add_pilot($data)
        {
            $this->db->insert('pilots',$data);
        }
        /*��������� ID ������*/
        function get_pilot_id($nickname)
        {
            $query = $this->db->query("SELECT id FROM pilots WHERE nickname='$nickname'");
            return $query->row_array();
        }
        /*�������� ������ �����*/
        function add_new_flight($id,$time)
        {
            $this->db->query("INSERT INTO flights(pilot_id,flight) VALUES($id,'$time')");
        }
        /*��������� ���� ������ �������� �����*/
        function get_start_flight($id)
        {
            $query = $this->db->query("SELECT flight AS last_flight FROM flights WHERE pilot_id=$id ORDER BY flight DESC LIMIT 1");
            return $query->row_array();
        }
        /*����� ����� - �� ������, �������, ������...*/
        function add_total_flight($data)
        {
            $this->db->insert('flight_hours',$data);
        }
        function clear_flights($id)
        {
            $this->db->query("DELETE FROM flights WHERE pilot_id=$id");
        }
        /*����� ������� ������ � ��*/
        function find_victim($nickname)
        {   
            $query = $this->db->query("SELECT nickname AS victim,id FROM pilots WHERE nickname='$nickname'");
            return $query->row_array();
        }
        /*�������*/
        function get_teamkill($id,$victim_id)
        {
            $query = $this->db->query("SELECT * FROM dcs_redteam WHERE pilot_id='$id' OR pilot_id=$victim_id");
            return $query->num_rows();
        }
        /*���������� ������ �� */        
        function add_fail_crash($id,$time)
        {
            $this->db->query("INSERT INTO fail_flights(pilot_id,data) VALUES($id,'$time')");
        }
        /*���������� ����� ��������*/
        function add_victim($id,$victim,$time,$friendly)
        {
            $this->db->query("INSERT INTO pilots_dogfights(pilot_id,victim,data,friendly) VALUES ($id,'$victim','$time',$friendly)");  
        }
        /*������ �������� ������*/
        function add_new_kill($data)
        {
            $this->db->insert('pilots_kills',$data);
        }
        /* ������� �������� ������ �� �������� �������*/
        function get_all_current_flights()
        {
            $query = $this->db->query("SELECT * FROM flights");
            return $query->result_array();
        }
        /*������� ������ ������ ��� �������� �������*/
        function get_online_all()
        {
            $query = $this->db->query("SELECT * FROM dcs_online");
            return $query->result_array();
        }
        /*���������� ����� ������� ������ ��� �������� �������*/
        function add_not_ended_flights($values)
        {
            $this->db->query("INSERT INTO flight_hours (pilot_id,start_flight,end_flight,total) VALUES $values");
        }
        /*������� ���� ������� ������ ����� �������� �������*/
        function delete_all_flights($id)
        {
            $this->db->query("DELETE FROM flights WHERE pilot_id=$id");
        }
        /*���������� ������ ������ ��� ������������*/
        function add_death($data)
        {
            $this->db->insert('pilots_death',$data);
        }
        /*������� ����� ��� ���������� ������*/
        function add_takeoff($id,$time)
        {
            $this->db->query("INSERT INTO pilots_takeoffs(pilot_id,data) VALUES($id,'$time')");
        }
        /*������� ������� ��� ���������� �������*/
        function add_landing($id,$time)
        {
            $this->db->query("INSERT INTO pilots_lands(pilot_id,data) VALUES ($id,'$time')");
        }
        /*���������� � �������*/
        function add_spectator($id,$time)
        {
            $this->db->query("INSERT INTO dcs_spectators (pilot_id,data) VALUES ($id,'$time')");
        }
        /*�������� ������ � ��������*/
        function check_spectator($id)
        {
            $query = $this->db->query("SELECT * FROM dcs_spectators WHERE pilot_id=$id");
            return $query->result_array();
        }
        /*��������� ������ �������� ��� ��������*/
        function get_all_spectators()
        {
            $query = $this->db->query("SELECT * FROM dcs_spectators");
            return $query->result_array();
        }
        function delete_from_spectators($id)
        {
            $this->db->where('pilot_id',$id);
            $this->db->delete('dcs_spectators');
        }
        /*���� � ������� �������*/
        function join_red($id,$time,$plane)
        {
            $this->db->query("INSERT INTO dcs_redteam(pilot_id,data,plane) VALUES ($id,'$time','$plane')");
        }
        /*���� � ������� ����� */
        function join_blue($id,$time,$plane)
        {
            $this->db->query("INSERT INTO dcs_blueteam(pilot_id,data,plane) VALUES ($id,'$time','$plane')");
        }
        /*������ ������� ������ �������*/
        function update_red_pilot_plane($id,$plane)
        {
            $this->db->query("UPDATE dcs_redteam SET plane='$plane' WHERE pilot_id=$id");
        }
        /*������ ������� ������ �����*/
        function update_blue_pilot_plane($id,$plane)
        {
            $this->db->query("UPDATE dcs_blueteam SET plane='$plane' WHERE pilot_id=$id");
        }
        /*����� �� ������� �������*/
        function left_red($id)
        {
            $this->db->where('pilot_id',$id);
            $this->db->delete('dcs_redteam');
        }
        /*����� �� ������� �����*/
        function left_blue($id)
        {
            $this->db->where('pilot_id',$id);
            $this->db->delete('dcs_blueteam');
        }
        /*�������� ������� � ������� �����*/
        function check_blue($id)
        {
            $this->db->where('pilot_id',$id);
            $query = $this->db->get('dcs_blueteam');
            return $query->num_rows();
        }
        /*�������� ������� � ������� �������*/
        function check_red($id)
        {
            $this->db->where('pilot_id',$id);
            $query = $this->db->get('dcs_redteam');
            return $query->num_rows();
        }
        /*��������� ���� ������� �������*/
        function get_all_red()
        {
            $query = $this->db->query("SELECT * FROM dcs_redteam");
            return $query->result_array();
        }
         /*��������� ���� ����� �������*/
        function get_all_blue()
        {
            $query = $this->db->query("SELECT * FROM dcs_blueteam");
            return $query->result_array();
        }
        /*****************************���������� ������� �������********************************/
        function server_offline()
        {
            $this->db->query("UPDATE server SET status=0 WHERE ip_adress='95.215.156.205'");
        }
        function server_online()
        {
            $this->db->query("UPDATE server SET status=1 WHERE ip_adress='95.215.156.205'");
        }
        /*��������� ������� �������*/
        function get_server_status()
        {
            $query = $this->db->query("SELECT status FROM server WHERE ip_adress='95.215.156.205'");
            return $query->row_array();
        }
        function add_online($id,$time)
        {
            $this->db->query("INSERT INTO dcs_online(pilot_id,data) VALUES ($id,'$time')");
        }
        function delete_online($id)
        {
            $this->db->query("DELETE FROM dcs_online WHERE pilot_id=$id");
        }
        /************************�������� ���������� ������ ������***************************************/
        /*��������� ����� ������*/
        function get_pilot_name($id)
        {
            $this->db->where('id',$id);
            $query = $this->db->get('pilots');
            return $query->row_array();
        }
        /*��������� ������ ������������ ������� �� ID ������*/
        function get_pilot_kills_by_category($id)
        {
            $query = $this->db->query("
                SELECT dcs_categories.title AS title,
                       COUNT(pilots_kills.object) AS count_kills
                FROM pilots_kills
                LEFT JOIN (SELECT DISTINCT name,category FROM dcs_units) AS units ON units.name=pilots_kills.object
                LEFT JOIN dcs_categories ON dcs_categories.id=units.category
                WHERE pilots_kills.pilot_id=$id
                GROUP BY dcs_categories.title    
            ");
            return $query->result_array();
        }  
        /*��������� ���������� ������ ������� �� ID ������*/
        function get_total_count($id)
        {
            $query = $this->db->query("SELECT COUNT(object) as total_count FROM pilots_kills WHERE pilot_id=$id");
            return $query->row_array();
        }   
        /*��������� ����������������� ��� ����������*/
        function add_eject($id,$time)
        {
            $this->db->query("INSERT INTO pilots_ejects(pilot_id,data) VALUES ($id,'$time')");
        } 
         
        function flight_statistic($id)
        {
            $query = $this->db->query("
                SELECT pilots.id, 
               	    pilots.nickname,
                    death.count_death,
                    ejects.count_eject,
                    lands.count_lands,
                    takeoffs.count_takeoffs,
                    crashes.count_crashes
                FROM pilots
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_death FROM pilots_death WHERE pilot_id=$id) AS death 
                	ON death.pilot_id=pilots.id 
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_eject FROM pilots_ejects WHERE pilot_id=$id) AS ejects
                    ON ejects.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_lands FROM pilots_lands WHERE pilot_id=$id) AS lands ON lands.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_takeoffs FROM pilots_takeoffs WHERE pilot_id=$id) AS takeoffs ON takeoffs.pilot_id=pilots.id
                LEFT JOIN (SELECT pilot_id,COUNT(pilot_id) AS count_crashes FROM fail_flights WHERE pilot_id=$id) AS crashes ON crashes.pilot_id=pilots.id
                WHERE pilots.id=$id
            ");
            return $query->result_array();
        }
        /*��������� ���������� ��������� �� ������ ������*/
        function get_dogfights_by_id($id)
        {
            $query = $this->db->query("SELECT 
                pilots.nickname,
                killed.counts_kills,
                dead.counts_death_kills
            FROM pilots
            JOIN (SELECT COUNT(pilot_id) AS counts_kills,pilot_id FROM pilots_dogfights WHERE pilot_id=$id) AS killed ON killed.pilot_id=$id
            LEFT JOIN (SELECT COUNT(victim) AS counts_death_kills,victim FROM pilots_dogfights GROUP BY victim) AS dead ON dead.victim=pilots.nickname
            WHERE pilots.id=$id
            ");
            return $query->row_array();
        }
    }


/* INSERT ... ON DUPLICATE KEY UPDATE Syntax*/
/*WHERE period between '$period' and  DATE_ADD(DATE_ADD('$period', INTERVAL 4 MONTH), INTERVAL -1 SECOND)*/
?>