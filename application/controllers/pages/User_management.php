<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends CI_Controller {

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
            'title' => 'User Management',
            'nama'  => $this->nama,
        );
        $data['contents'] = $this->load->view('dashboard/pages/user_management', $data, true);
        $this->load->view('dashboard/layout/tamplate', $data);
    }

    public function simpan_management() {
        $created_by         = $this->session->userdata('id');
        $current            = $this->session->userdata('uid');
        $uid_management     = $this->input->post('uid_management'); 
        $nip                = $this->input->post('nip');
        $nama               = $this->input->post('nama');
        $unitKerja          = $this->input->post('unitKerja');
        $username           = $this->input->post('username'); 
        $password           = $this->input->post('password');
    
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        if (empty($uid_management)) {
            $uid_management = uniqid($role, true);
        }
    
        $data = array(
            'uid'           => $uid_management,
            'nip'           => $nip,
            'nama'          => $nama,
            'unit_kerja'    => $unitKerja,
            'username'      => $username,
            'password'      => $hashed_password, 
            'created_by'    => $created_by
        );
    
        if ($this->Management_model->cek_management_exists($uid_management)) {
            if ($this->Management_model->update_management($uid_management, $data)) {
                $this->session->set_flashdata('success', 'Data management berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
            }
        } else {
            if ($this->Management_model->insert_management($data)) {
                $this->session->set_flashdata('success', 'Data management berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan, coba lagi.');
            }
        }
        redirect('pages/user_management?anasakinu=role&role=' . $role . '&uid=' . $uid);
    }

}
