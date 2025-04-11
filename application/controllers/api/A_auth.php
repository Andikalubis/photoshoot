<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['security', 'session']);
        $this->load->model('Auth_model');
    }

    public function login() {
        header('Content-Type: application/json');

        $username = $this->security->xss_clean($this->input->post('username', true));
        $password = $this->security->xss_clean($this->input->post('password', true));

        if (empty($username) || empty($password)) {
            echo json_encode([
                'status' => false,
                'message' => 'Username dan password wajib diisi'
            ]);
            return;
        }

        $user = $this->Auth_model->getUser($username);

        if ($user && password_verify($password, $user->password)) {
            // Buat data session
            $session_data = [
                'user_id'   => $user->id,
                'username'  => $user->username,
                'name'      => $user->name,
                'logged_in' => true
            ];
            $this->session->set_userdata($session_data);

            echo json_encode([
                'status' => true,
                'message' => 'Login berhasil'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Username atau password salah'
            ]);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
