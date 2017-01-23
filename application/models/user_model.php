<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function cek_user($data) {
		$query = $this->db->get_where('users', $data);
		return $query;
	}

	public function get_userid($username) {
		$data = $this->db->query("SELECT * FROM users WHERE username = '$username'")->result_array();
    	return $data[0]['user_id'];
	}

	public function get_mapel($username="") {
		$data = $this->db->query("SELECT * FROM guru WHERE nik = '$username'");
    	return $data->result_array();
	}

	public function GetMapel($where="") {
		$data = $this->db->query("SELECT * FROM mapel".$where);
		return $data->result_array();
	}

		public function GetUjian($where="") {
			$data = $this->db->query("SELECT * FROM jenis_ujian".$where);
			return $data->result_array();
		}

		public function GetGuru($where="") {
			$data = $this->db->query("SELECT * FROM guru".$where);
			return $data->result_array();
		}

		public function GetSoal($where="") {
			$soal = $this->db->query("SELECT * FROM soal".$where);
			return $soal->result_array();
		}

		public function GetOpsi($where="") {
			$jurusan = $this->db->query("SELECT * FROM jurusan".$where);
			return $jurusan->result_array();
		}

		public function InsertData($tabelName, $data) {
		$res = $this->db->insert($tabelName, $data);
		return $res;
		}

		public function UpdateData($tabelName, $data, $where) {
		$res = $this->db->update($tabelName, $data, $where);
		return $res;
		}

		public function DeleteData($tabelName, $where) {
		$res = $this->db->delete($tabelName, $where);
		return $res;
		}

		function tambah($data){
   	 		$this->db->insert('guru', $data);
    		return TRUE;
		}

		function ubah($data, $id){
        $this->db->where('no',$id);
        $this->db->update('guru', $data);
        return TRUE;
    }
}
