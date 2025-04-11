<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
	protected $table_def = "m_dokter";
	protected $table_def_pegawai = "hrd_karyawan";
	protected $db2;

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('db2', TRUE); 
	}

	private function _get_select($customSelect = "")
	{
		if ($customSelect != "") {
			$select = $customSelect;
		} else {
			$select = array(
				"{$this->table_def}.*",
				"{$this->table_def_pegawai}.id as pegawai_id",
				"{$this->table_def_pegawai}.nik nip",
				"{$this->table_def_pegawai}.uid pegawai_uid",
				"{$this->table_def_pegawai}.bpjs_antrian_kd bpjs_antrian_kd",
			);
		}
		return 'SELECT ' . implode(', ', $select) . ' ';
	}

	private function _get_from()
	{
		$from = "FROM " . $this->table_def;
		return $from;
	}

	private function _get_join()
	{
		$join = array(
			"INNER JOIN {$this->table_def_pegawai} ON {$this->table_def}.pegawai_id = {$this->table_def_pegawai}.id",
		);
		return implode(' ', $join);
	}

	public function get_by($sWhere = "", $customSelect = "")
	{
		$sql = $this->_get_select($customSelect) . " ";
		$sql .= $this->_get_from() . " ";
		$sql .= $this->_get_join();
		if (!empty($sWhere)) {
			$sql .= " " . $sWhere;
		}
		$query = $this->db2->query($sql);
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_all($iLimit = 10, $iOffset = 0, $sWhere = "", $sOrder = "", $customSelect = "")
	{
		$data = array();
		$sql_count = "SELECT COUNT({$this->table_def}.id) AS numrows ";
		$sql_count .= $this->_get_from() . " ";
		$sql_count .= $this->_get_join();
		if (!empty($sWhere)) {
			$sql_count .= " " . $sWhere . " ";
		}
		$query = $this->db2->query($sql_count);
		if ($query->num_rows() == 0) {
			$data['total_rows'] = 0;
		} else {
			$row = $query->row();
			$data['total_rows'] = (int) $row->numrows;
		}

		$select = $this->_get_select($customSelect);
		$from = $this->_get_from();
		$join = $this->_get_join();
		$sql = $select . " " . $from . " " . $join . " ";
		if (!empty($sWhere)) {
			$sql .= $sWhere . " ";
		}
		if (!empty($sOrder)) {
			$sql .= $sOrder . " ";
		}
		if ($iLimit > 0) {
			$sql .= "LIMIT " . $iOffset . ", " . $iLimit;
		}
		$query = $this->db2->query($sql);
		if ($query->num_rows() > 0) {
			$data['data'] = $query->result();
		} else {
			$data['data'] = array();
		}
		$data['sql'] = $sql;
		return $data;
	}
}
