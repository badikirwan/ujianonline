<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soal_model extends CI_Model {

  public function GetSoal($where= "") {
    $data = $this->db->query('select * from soal '.$where);
    return $data;
  }

  public function Simpan($tabel, $data){
    $res = $this->db->insert($tabel, $data);
    return $res;
  }

  public function Rubah($soal,$data)
  {
    $this->db->where('id_soal',$soal);
    $this->db->update('soal',$data);

  }

  public function Insert($table,$where) {
    return $this->db->insert($table,$where);
  }

  public function get_by_id($id) {
    $this->db->from('soal');
    $this->db->where('id_soal',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function soal_add($table, $data) {
    return $this->db->insert($table, $data);
  }

  public function soal_update($table, $data, $where) {
    return $this->db->update($table, $data, $where);
  }

  public function delete_by_id($id)
  {
    $this->db->where('id_soal', $id);
    $this->db->delete('soal');
  }

  public function UpdateData($tabel, $data, $where) {
    return $this->db->update($tabel, $data, $where);
  }

  public function Delete($table,$where){
    return $this->db->delete($table,$where);
  }

  public function get_id_mapel($kode = 0) {
    $data = $this->db->query("select * from soal where id_soal = '$kode'")->result_array();
    return $data[0]['id_mapel'];
  }

  public function get_jawaban($kode = 0) {
    $data = $this->db->query("select * from soal where id_soal = '$kode'")->result_array();
    return $data[0]['jawaban'];
  }
}
