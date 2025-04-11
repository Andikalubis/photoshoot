<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUser($username) {
        return $this->db->get_where('auth_user', ['username' => $username])->row();
    }

    public function get_user_by_user($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('auth_user');

        return $query->row(); 
    }
}

