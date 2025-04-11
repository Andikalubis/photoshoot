<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelaksanaan extends CI_Controller {

    protected $nama;

    public function __construct() {
        parent::__construct(); 
        if (!$this->session->userdata('logged_in')) {
            redirect('auth'); 
        }
        $this->nama = $this->session->userdata('nama'); 
    }

    public function index() {
        $data = Array(
            'title' => 'History Endoskopi',
            'nama'  => $this->nama
        );
        $data['contents'] = $this->load->view('dashboard/pages/pelaksanaan', $data, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }

    public function pasien_detail($uid = null) {
        $data = Array(
            'title' => 'Detail Pasien',
            'nama'  => $this->nama
        );
            
        $data['pasien'] = $this->db->get_where('t_pelaksana', ['uid' => $uid])->row();
        $data['contents'] = $this->load->view('dashboard/pages/pasien_detail', $data, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }
    

}
