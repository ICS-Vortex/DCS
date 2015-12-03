<?php
if (!defined('BASEPATH')) exit('No direct script allowed! ');

class Register_model extends Model{
    function find_nickname($nickname){
        $query = $this->db->query("SELECT * FROM pilots WHERE nickname='{$nickname}'");
        return $query->row_array();
    }
}
