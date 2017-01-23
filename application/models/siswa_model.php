<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	var $table = 'siswa';

	public function cek_user() {
		$data = $this->db->query("SELECT siswa.*,(SELECT COUNT(id) FROM users WHERE level = 'siswa' AND user_id = siswa.nim) AS ada FROM siswa");
		return $data->result_array();
	}

	public function get_all_siswa($where="") {
		$data = $this->db->query("SELECT * FROM siswa".$where);
		return $data->result_array();
	}

	public function get_all_jurusan($where="") {
		$jurusan = $this->db->query("SELECT * FROM jurusan".$where);
		return $jurusan->result_array();
	}

	public function get_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function get_nis($username = '') {
    	$data = $this->db->query("SELECT * FROM users WHERE username = '$username'")->result_array();
    	return $data[0]['user_id'];
  	}

    public function GetSiswa($where="") {
		$data = $this->db->query("SELECT * FROM siswa".$where);
		return $data->result_array();
	}

	public function get_jurusan($nim= '') {
		$data = $this->db->query("SELECT * FROM siswa WHERE nim = '$nim'")->result_array();
		return $data[0]['jurusan'];
	}

	public function GetIdSiswa($nim= '') {
		$data = $this->db->query("SELECT * FROM siswa WHERE nim = '$nim'")->result_array();
		return $data[0]['nim'];
	}

	public function siswa_add($table, $data) {
		return $this->db->insert($table, $data);
	}

	public function siswa_update($table, $data, $where) {
		return $this->db->update($table, $data, $where);
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}
