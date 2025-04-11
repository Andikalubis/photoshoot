<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); 
        }

    }

    public function index() {
        $data['contents'] = $this->load->view('dashboard/pages/laporan', null, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }

}
