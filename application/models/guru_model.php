<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guru_model extends CI_Model {

	public function cek_user() {
		$data = $this->db->query("SELECT guru.*,(SELECT COUNT(id) FROM users WHERE level = 'guru' AND user_id = guru.nik) AS ada FROM guru");
		return $data->result_array();
	}

    public function get_all_guru($where="") {
		$data = $this->db->query('select * from guru'.$where);
		return $data->result_array();
	}

  	public function guru_add($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function get_by_id($id) {
		$this->db->from('guru');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function guru_update($table, $data, $where) {
		return $this->db->update($table, $data, $where);
	}

	public function delete_by_id($id) {
		$this->db->where('id', $id);
		$this->db->delete('guru');
	}

}
