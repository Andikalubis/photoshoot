<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_pelaksanaan extends CI_Controller {

    protected $user_id;

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $this->user_id = $this->session->userdata('id');

        $this->load->model('Pasien_model');
        $this->load->model('Pelaksana_model');
    }

    public function get_pasien()
    {
        $keyword = $this->input->get('keyword');
        $db2 = $this->load->database('db2', TRUE);
    
        $db2->select('tp.no_register, tp.id AS pelayanan_id, mp.id AS pasien_id, mp.no_rm, mp.nama, jk.nama AS jenis_kelamin, mp.alamat, tp.created_at');
        $db2->from('t_pelayanan tp');
        $db2->join('m_pasien mp', 'tp.pasien_id = mp.id');
        $db2->join('hrd_m_jenis_kelamin jk', 'mp.jenis_kelamin = jk.id');
        $db2->group_start()
            ->like('mp.no_rm', $keyword)
            ->or_like('mp.nama', $keyword)
            ->group_end();
        $db2->order_by('tp.created_at', 'DESC');
        $db2->limit(1);
    
        $query = $db2->get();
        $data = $query->row();
    
        if ($data) {
            $response = [
                'status' => true,
                'data' => $data
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    
    public function getData()
    {
        $limit = $this->input->get('length'); 
        $start = $this->input->get('start');  
        $search_value = $this->input->get('search')['value']; 
        $order_column_index = $this->input->get('order')[0]['column']; 
        $order_dir = $this->input->get('order')[0]['dir']; 

        $columns = ['t_pelaksana.no_rm', 't_pelaksana.nama'];
        $order_column = $columns[$order_column_index];

        $data_pelaksana = $this->Pelaksana_model->getData($limit, $start, $search_value, $order_column, $order_dir);

        $total_data = $this->Pelaksana_model->count_all();
        $total_filtered = $this->Pelaksana_model->count_filtered($search_value);

        $data = $data_pelaksana;

        $output = [
            "draw"              => intval($this->input->get('draw')),
            "recordsTotal"      => $total_data,
            "recordsFiltered"   => $total_filtered,
            "data"              => $data
        ];

        echo json_encode($output);
    }

    public function get_pelaksana() {
        $uid = $this->input->get('uid');
    
        if (empty($uid)) {
            echo json_encode(['success' => false, 'message' => 'UID is required']);
            return;
        }
    
        $pelaksana = $this->Pelaksana_model->fetch_pelaksana_by_uid($uid);
    
        if ($pelaksana) {
            echo json_encode(['success' => true, 'data' => $pelaksana]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data not found']);
        }
    }

    public function capture()
    {
        $nama = $this->input->post('nama');
        $no_rm = $this->input->post('no_rm');
        $image = $this->input->post('image');
        $created_by = $this->user_id;


        if (!$nama || !$no_rm || !$image || !$created_by) {
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

        $this->db->where('no_rm', $no_rm);
        $query = $this->db->get('t_pelaksana');
        $record = $query->row();

        if ($record) {
            $existingPhotos = json_decode($record->data_photo, true) ?? [];
            $existingPhotos[] = $fileName;

            $this->db->where('no_rm', $no_rm);
            $this->db->update('t_pelaksana', [
                'data_photo' => json_encode($existingPhotos)
            ]);
        } else {
            $uuid = generate_uuid();
            $photoData = [$fileName];

            $this->db->insert('t_pelaksana', [
                'uid' => $uuid,
                'no_rm' => $no_rm,
                'nama' => $nama,
                'data_photo' => json_encode($photoData),
                'tanggal_photo' => $tanggal,
                'dokter_id' => $created_by,
                'created_by' => $created_by
            ]);
        }

        echo 'Photo saved to: assets/photo/' . $tanggal . '/' . $no_rm . '/' . $fileName;
    }

}
