<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');             
        }
        $this->load->model('History_model');
    }

    public function index() {
        $data = Array(
            'title' => 'History Endoskopi'
        );
        $data['contents'] = $this->load->view('dashboard/pages/history', $data, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }

    public function getData() {
        $data = $this->History_model->get_data();
        echo json_encode($data);
    }

}
