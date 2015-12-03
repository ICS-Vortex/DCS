<?php
if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Register_model extends Model{
    function find_nickname($nickname){
        $query = $this->db->query("SELECT * FROM pilots WHERE nickname='{$nickname}'");
        return $query->row_array();
    }

    function check_pilot_id($id){
        $query = $this->db->query("SELECT * FROM pilots WHERE id={$id}");
        return $query->row_array();
    }

    function make_ticket($ticket){
        $this->db->insert('dcs_registration_tickets',$ticket);
    }

    function update_pilots_email($id,$email){
        $this->db->query("UPDATE pilots SET email='{$email}' WHERE id={$id}");
    }
}
