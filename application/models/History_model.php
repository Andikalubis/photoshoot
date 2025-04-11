<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_data() {
        $db2 = $this->load->database('db2', TRUE);
        $db2->limit(200);
        $query = $db2->get('m_pasien');

        return $query->result();
    }
}
