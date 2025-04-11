<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management_model extends CI_Model {

    protected $table_def = "auth_user";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function cek_management_exists($uid_management) {
        $this->db->where('uid', $uid_management);
        $query = $this->db->get($this->table_def);
        return $query->num_rows() > 0;
    }
    
    public function update_management($uid_management, $data) {
        $this->db->where('uid', $uid_management);
        return $this->db->update($this->table_def, $data);
    }
    
    public function insert_management($data) {
        return $this->db->insert($this->table_def, $data);
    }    
    
    public function getData($limit, $start, $search_value = null, $order_column = 'id', $order_dir = 'ASC') 
    {
        $this->db->select("
            {$this->table_def}.id, 
            {$this->table_def}.uid, 
            {$this->table_def}.nip, 
            {$this->table_def}.nama, 
            {$this->table_def}.no_tlp, 
            {$this->table_def}.username, 
        ");
        $this->db->from($this->table_def);
    
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like("{$this->table_def}.nip", $search_value);
            $this->db->or_like("{$this->table_def}.nama", $search_value);
            $this->db->group_end();
        }
    
        $this->db->order_by($order_column, $order_dir);

        if ($limit != -1) {
            $this->db->limit($limit, $start);
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function count_all()
    {
        $this->db->from($this->table_def);
        return $this->db->count_all_results();
    }
    
    public function count_filtered($search_value = null)
    {
        $this->db->from($this->table_def);
    
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like("{$this->table_def}.nip", $search_value);
            $this->db->or_like("{$this->table_def}.nama", $search_value);
            $this->db->group_end();
        }
    
        return $this->db->count_all_results();
    }

    public function fetch_management_by_uid($uid) {
        $this->db->select('*');
        $this->db->from($this->table_def); 
        $this->db->where('uid', $uid); 
        $query = $this->db->get();
        return $query->row_array();
    }
}
