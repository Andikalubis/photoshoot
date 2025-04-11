<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $db2 = $this->load->database('db2', TRUE);
        $db2->limit(200);
        $query = $db2->get('m_pasien');

        return $query->result();
    }

    public function search_by_rm_or_nama($keyword) {
        $db2 = $this->load->database('db2', TRUE);

        $this->db->like('no_rm', $keyword);
        $this->db->or_like('nama', $keyword);
        $query = $db2->get('pasien');
        return $query->row_array();
    }
    
    public function get_by_no_rm($no_rm) {
        return $this->db->get_where('pasien', ['no_rm' => $no_rm])->row_array();
    }
}

