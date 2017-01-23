<?php
/**
* 
*/
class Jurusan_model extends CI_Model {
	
	function __construct() {
		# code...
	}

	public function get_all_jurusan($where="") {
		$data = $this->db->query("SELECT * FROM jurusan".$where);
		return $data->result_array();
	}

	public function get_by_id($id) {
		$this->db->from('jurusan');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function jurusan_add($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function jurusan_update($table, $data, $where) {
		return $this->db->update($table, $data, $where);

	}

	public function delete_by_id($id) {
		$this->db->where('id', $id);
		$this->db->delete('jurusan');
	}
}