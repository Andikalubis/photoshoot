<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('Management_model'); 
    }

    public function getData()
    {
        $limit = $this->input->get('length'); 
        $start = $this->input->get('start');  
        $search_value = $this->input->get('search')['value']; 
        $order_column_index = $this->input->get('order')[0]['column']; 
        $order_dir = $this->input->get('order')[0]['dir']; 

        $columns = ['auth_user.nip', 'auth_user.nama'];
        $order_column = $columns[$order_column_index];

        $data_management = $this->Management_model->getData($limit, $start, $search_value, $order_column, $order_dir);

        $total_data = $this->Management_model->count_all();
        $total_filtered = $this->Management_model->count_filtered($search_value);

        $data = [];
        foreach ($data_management as $row) {
            $data[] = [
                'id'            => $row['id'],
                'uid'           => $row['uid'],
                'nip'           => $row['nip'],
                'nama'          => $row['nama'],
                'username'      => $row['username'],
            ];
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),
            "recordsTotal"      => $total_data,
            "recordsFiltered"   => $total_filtered,
            "data"              => $data
        ];

        echo json_encode($output);
    }

    public function get_management() {
        $uid = $this->input->get('uid');
    
        if (empty($uid)) {
            echo json_encode(['success' => false, 'message' => 'UID is required']);
            return;
        }
    
        $management = $this->Management_model->fetch_management_by_uid($uid);
    
        if ($management) {
            echo json_encode(['success' => true, 'data' => $management]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data not found']);
        }
    }   
}
