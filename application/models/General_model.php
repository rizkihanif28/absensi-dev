<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Author       : Ilham Muhammad
 * Email        : ilhamhmmd@outlook.com
 * 2020
 */

class General_model extends CI_Model {
    // protected $table;
    // function __construct()
    // {
    //     parent::__construct();
    //     $this->table = '';
    // }

    function fetch($table, $where = NULL, $sort=NULL, $join = NULL, $cond = NULL){
        if($join !== NULL && $cond !== NULL){
            $this->db->join($join,$cond);
        }

        if($where !== NULL){
            $this->db->where($where);
        }

        if($sort !== NULL){
            $this->db->order_by($sort);
        }

        return $this->db->get($table);
    }

    function delete($table, $where) {        
        $query = $this->db->delete($table, $where);
        return $query;
    }
    
    function update_where($table, $where, $set) {
        $this->db->set($set);
        $this->db->where($where);
        $this->db->update($table);
    }
    
    function get_all($table) {
        $query = $this->db->get($table);
        return $query;
    }

    function get_distinct($data, $table) {
        $this->db->distinct($data);
        $query = $this->db->get($table);
        return $query;
    }
    
    function get_orderlimit($data, $sort, $limit, $table) {        
        $query = $this->db->order_by($data, $sort)
        ->limit($limit)
        ->get($table);        
        return $query;
    }
    
    function store($table, $data) {
        $this->db->insert($table, $data);
    }

    function get_whereLike($table, $cond, $like) {
        $this->db->like($like);
        $query = $this->db->get_where($table, $cond);
        return $query;
    }
    
    function get_like($table, $like) {
        $this->db->like($like);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where($table, $cond) {
        $query = $this->db->get_where($table, $cond);
        return $query;
    }
    
    function get_where_sort($table, $cond, $sort_by, $order) {
        $this->db->order_by($sort_by, $order);
        $query = $this->db->get_where($table, $cond);
        return $query;
    }

}