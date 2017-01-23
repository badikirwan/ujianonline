<?php

/**
* 
*/
class Ujian_model extends CI_Model {
	
	// public function get_ujian($where="") {
	// 	$data = $this->db->query('select * from jenis_ujian '.$where);
	// 	return $data->result_array();
	// }

	public function get_ujian($where="") {
		$data = $this->db->query("SELECT jenis_ujian.*, mapel.nama AS mapel FROM jenis_ujian INNER JOIN mapel ON jenis_ujian.id_mapel = mapel.nama ". $where);
		return $data->result_array();
	}

	public function get_ujian2($where="") {
			$data = $this->db->query('select * from jenis_ujian'.$where);
			return $data->result_array();
		}

	public function get_by_id($id) {
		$this->db->from('jenis_ujian');
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function ujian_add($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function ujian_update($table, $data, $where) {
		return $this->db->update($table, $data, $where);
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('jenis_ujian');
	}


}