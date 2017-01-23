<?php
/**
* 
*/
class Mapel_model extends CI_Model {
	
	function __construct() { 
		
	}

	public function get_all_mapel($where="") {
		$data = $this->db->query("SELECT * FROM mapel".$where);
		return $data->result_array();
	}

	public function mapel_add($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function mapel_update($table, $data, $where) {
		return $this->db->update($table, $data, $where);
	}

	public function get_by_id($id) {
		$this->db->from('mapel');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('mapel');
	}
}