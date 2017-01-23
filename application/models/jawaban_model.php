<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jawaban_model extends Ci_Model {

  public function Ambil() {
    $data = $this->db->query('select * from jawaban, mahasiswa where jawaban.id_mhs=mahasiswa.id_mhs');
    return $data;
  }

  public function AmbilNilai2($idmhs) {
    $data = $this->db->query("select * from ikut_ujian, siswa where ikut_ujian.id_siswa=siswa.id AND ikut_ujian.id_siswa='$idmhs'");
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

  public function Hapus($table,$where){
    return $this->db->delete($table,$where);
  }

  public function UpdateTotalNilai($id_jawaban,$data)
  {
    $this->db->where('id_siswa',$id_jawaban);
    $this->db->update('ikut_ujian',$data);

  }

  public function UpdateStatusUser($username,$data)
  {
    $this->db->where('username',$username);
    $this->db->update('users',$data);

  } 

  public function AmbilDetailNilai($idjawaban) {
    $data = $this->db->query("select * from hasil_ujian a, soal b where a.id_soal=b.id_soal AND a.id_ikut_ujian='$idjawaban'");
    return $data;
  }
}