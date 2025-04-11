<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    protected $nama;

    public function __construct() {
        parent::__construct(); 
        if (!$this->session->userdata('logged_in')) {
            redirect('auth'); 
        }
        $this->nama = $this->session->userdata('nama'); 
    }

    public function index()
    {
        $data = Array(
            'nama'  => $this->nama,
        );
        $data['contents'] = $this->load->view('dashboard/pages/home', $data, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }    
}
