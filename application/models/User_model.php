<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	protected $table = 'user';

	function simpan($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id(); 
	}

	function perbaharui($data, $key){
		$this->db->update($this->table, $data, $key);
	}

	function hapus($key){
		$this->db->delete($this->table, $key);
	}

	public function getUser($id){
		$query = $this->db->get_where('user',array('user_id'=>$id));
		return $query->row_array();
	}
	
	function get_user_by_id($id){
		$this->db->select('user_id, nama, email, username, role_id');
		return $this->db->get_where($this->table, array('user_id' => $id));
	}
	
	function get_user_by_email($email){
		$this->db->select('user_id, nama, email, username, role_id');
		return $this->db->get_where($this->table, array('email' => $email));
	}

	function cek_email($user_id, $email){
		$this->db->where('email', $email);
        
        if($user_id) :
            $this->db->where_not_in('user_id', $user_id);
        endif;

        return $this->db->get($this->table)->num_rows();
	}

	function cek_username($user_id, $username){
		$this->db->where('username', $username);
        
        if($user_id) :
            $this->db->where_not_in('user_id', $user_id);
        endif;

        return $this->db->get($this->table)->num_rows();
	}
	
	
	function get_nik($email){
		return $this->db->get_where('user', array('email' => $email));
	}

	function activate($data, $id){
		$this->db->where('user_id', $id);
		return $this->db->update('user', $data);
	}

}
