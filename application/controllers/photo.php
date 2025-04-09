<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends CI_Controller {

    public function index()
    {
        $this->load->view('photo.php');
    }

    public function capture()
    {
        $nama = $this->input->post('nama');
        $no_rm = $this->input->post('no_rm');
        $image = $this->input->post('image');
    
        if (!$nama || !$no_rm || !$image) {
            echo 'Invalid input!';
            return;
        }
    
        $tanggal = date('Y-m-d');
        $baseDir = FCPATH . "assets/photo/$tanggal/$no_rm/";
    
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }
    
        $fileName = $nama . '.' . $no_rm . '.' . time() . '.jpg';
        $imagePath = $baseDir . $fileName;
    
        $imgData = str_replace('data:image/jpeg;base64,', '', $image);
        $imgData = str_replace(' ', '+', $imgData);
        $data = base64_decode($imgData);
    
        file_put_contents($imagePath, $data);
    
        echo 'Photo saved to: assets/photo/' . $tanggal . '/' . $no_rm . '/' . $fileName;
    }
    
}
