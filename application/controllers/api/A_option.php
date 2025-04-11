<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A_option extends CI_Controller {
	protected $table_def = "m_dokter";
	protected $table_def_pegawai = "hrd_karyawan";

    public function __construct() {
        parent::__construct();
        $this->load->model('Dokter_model', 'main'); 
    }

    public function fetch_all()
	{
		if (!$this->input->is_ajax_request())
			exit();

		$layanan_id = $this->input->get('q') ? checkBase64Value($this->input->get('q')) : "";
		$status_kehadiran = $this->input->get('status_kehadiran') ?: 0;

		$sWhere = "";
		$aWheres = array();
		$aWheres[] = "{$this->table_def}.status = 1";
		$aWheres[] = "{$this->table_def}.deleted_flag = 0";
		if ($layanan_id != "") $aWheres[] = "{$this->table_def}.layanan_id = '{$layanan_id}'";
		if (count($aWheres) > 0)
			$sWhere = implode(' AND ', $aWheres);
		if (!empty($sWhere))
			$sWhere = "WHERE " . $sWhere . " GROUP BY {$this->table_def}.pegawai_id";

		$tanggal = date('Y-m-d');

		$aSelect = array(
			"{$this->table_def}.pegawai_id id",
			"{$this->table_def_pegawai}.uid",
			"{$this->table_def}.nama",
			"{$this->table_def_pegawai}.bpjs_antrian_kd AS kode_dokter_for_bpjs",
			"(SELECT t.status FROM t_dokter_jadwal_kehadiran t INNER JOIN m_dokter_jadwal j ON t.jadwal_id = j.id WHERE j.layanan_id = {$this->table_def}.layanan_id AND j.dokter_id = {$this->table_def}.id AND t.tanggal = '$tanggal' LIMIT 1) as status_kehadiran",
		);
		$result = $this->main->get_all(0, 0, $sWhere, "ORDER BY {$this->table_def}.nama ASC", $aSelect)['data'];

		if ($status_kehadiran == 1) {
			foreach ($result as $row) {
				if ($row->status_kehadiran == 'cuti') {
					$row->nama = $row->nama . ' <span class="text-danger">(Cuti)</span>';
				}
			}
		}
		echo json_encode(['data' => $result]);
	}
}