<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	protected $table = 'user';
	
	function get_where($where) {
        return $this->db->get_where($this->table, $where)->row_array();
    }

	 function update_where($where, $set) {
        $this->db->set($set);
        $this->db->where($where);
        $this->db->update($this->table);
    }
	function cek_user($uid){
        $this->db->select('id, email, password, name, role_id, username')
        	->where('username', $uid)
        	->or_where('email', $uid);
            
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();

        return $result;
    }
	
	function cek_login($uid){
        $this->db->select('user_id, email, password, name, role_id, username')
        	->where('username', $uid)
        	->or_where('email', $uid);

            
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0)
            $result = $query->row_array();
        else
            $result = array();

        return $result;
    }
	
	function cek_login2($table,$where){		
		return $this->db->get_where($table,$where);
	}	
	
}
