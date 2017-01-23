<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ujian extends CI_Controller {
    
    function __construct() {
    	parent::__construct();
    	$this->load->model('jawaban_model');
        $this->load->model('siswa_model');
        $this->load->model('ujian_model');
        $this->load->model('soal_model');
        $this->load->model('user_model');
        $this->load->model('jurusan_model');      
    }

    public function index() {
        $user       = $this->session->userdata('username');
        $user_id    = $this->user_model->get_userid($user); 
        $level      = $this->session->userdata('level');

        if(empty($user)) {
            redirect('login');
        } else {
            if($level == 'admin') {
                $data = $this->db->query("SELECT jenis_ujian.*, mapel.nama AS mapel, guru.nama AS nama_guru, jurusan.nama_jurusan AS jurusan FROM jenis_ujian INNER JOIN mapel ON jenis_ujian.id_mapel = mapel.nama INNER JOIN guru ON jenis_ujian.id_guru = guru.nik INNER JOIN jurusan ON jenis_ujian.id_jurusan = jurusan.nama_jurusan")->result_array();
                $this->template->load('admin', 'admin/ujian', array('data'=>$data));

            } elseif ($level == 'guru') {
                $user_id    = $this->user_model->get_userid($user); 
                $mapel      = $this->user_model->get_mapel($user_id); 
                $jurusan    = $this->jurusan_model->get_all_jurusan(); 
                $data       = $this->ujian_model->get_ujian("WHERE jenis_ujian.id_guru = '$user_id'");
                $this->template->load('guru', 'guru/ujian', array('data'=>$data, 'mapel'=>$mapel, 'jurusan'=>$jurusan)); 
            } else {
                $user       = $this->session->userdata('username');
                $nim        = $this->siswa_model->get_nis($user);
                $jurusan    = $this->siswa_model->get_jurusan($nim);
                $data       = $this->ujian_model->get_ujian("where id_jurusan = '$jurusan'");
                $data       = $this->db->query("SELECT jenis_ujian.*, mapel.nama AS mapel, (SELECT COUNT(id) FROM ikut_ujian WHERE ikut_ujian.id_siswa = '$nim' AND ikut_ujian.tes = jenis_ujian.id) AS sudah_ikut, (SELECT total_nilai FROM ikut_ujian WHERE ikut_ujian.id_siswa = '$nim' AND ikut_ujian.tes = jenis_ujian.id) AS nilai FROM jenis_ujian INNER JOIN mapel ON jenis_ujian.id_mapel = mapel.nama WHERE id_jurusan='$jurusan' ORDER BY jenis_ujian.id ASC")->result_array();
                $this->template->load('siswa', 'siswa/ujian', array('data'=>$data));
            }
        }
    }

    public function ujian_add() {
        $user       = $this->session->userdata('username');
        $user_id    = $this->user_model->get_userid($user); 
        $data_add   = array(
                        'id_guru'       => $user_id,
                        'id_mapel'      => $this->input->post('nama_mapel'),
                        'id_jurusan'    => $this->input->post('jurusan_ujian'),
                        'nama_ujian'    => $this->input->post('nama_ujian'),
                        'jumlah_soal'   => $this->input->post('jumlah_soal'),
                        'waktu'         => $this->input->post('waktu_ujian'),
                        'jenis_soal'    => 'acak',
                    );
        $this->ujian_model->ujian_add('jenis_ujian', $data_add);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id) {
        $data = $this->ujian_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ujian_update() {
        $user           = $this->session->userdata('username');
        $user_id        = $this->user_model->get_userid($user); 
        $data_update    = array(
                            'id_mapel'      => $this->input->post('nama_mapel'),
                            'id_jurusan'    => $this->input->post('jurusan_ujian'),
                            'nama_ujian'    => $this->input->post('nama_ujian'),
                            'jumlah_soal'   => $this->input->post('jumlah_soal'),
                            'waktu'         => $this->input->post('waktu_ujian'),
                            'jenis_soal'    => 'acak',
                        );
        $where = array('id' => $this->input->post('id'));
        $this->ujian_model->ujian_update('jenis_ujian', $data_update, $where);
        echo json_encode(array("status" => TRUE));
    }

    public function ujian_delete($id) {
        $this->ujian_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    
    public function hasil($id) {
        $data = $this->db->query("SELECT siswa.nama, ikut_ujian.total_nilai, ikut_ujian.benar, ikut_ujian.salah, ikut_ujian.tes FROM ikut_ujian INNER JOIN siswa ON ikut_ujian.id_siswa = siswa.nim WHERE ikut_ujian.tes = '$id'")->result_array();
        if($this->session->userdata('level') == 'admin') {
            $this->template->load('admin', 'admin/hasil', array('data'=>$data));
        } else {
            $this->template->load('guru', 'admin/hasil', array('data'=>$data));
        }
        
    }

    public function dnilai2($kode = 0){
        $data = array(
            'nilai'=>$this->jawaban_model->AmbilDetailNilai($kode)->result_array(),                
            'kode'=>$kode,              
        );
        $this->template->load('siswa', 'jawaban/dnilai2',$data);
        
    }

    public function ikut($id) {
        $user 		= $this->session->userdata('username');
        $nim  		= $this->siswa_model->get_nis($user);
        $id_siswa   = $this->siswa_model->GetIdSiswa($nim);
        
        $data = array(
        	'id_siswa' => $id_siswa,
        	'tgl_tes'  => date("Y-m-d"),
            'tes'      => $id       	
            );

        $this->jawaban_model->Simpan('ikut_ujian', $data);
        $id = $this->siswa_model->GetIdSiswa($nim);
        redirect('ujian/soal/'.$id);
    }

    public function soal($id) {
    	$soal = $this->soal_model->GetSoal("where soal.status = 'tampil' order by RAND()");
    	$data = array(
    		'soal' 		 => $soal->result_array(),
    		'total_soal' => $soal->num_rows(),
    		'id_jawaban' => $id,
    		);
    	$this->load->view('ujian/soal', $data);
    }

    public function jawab() {
        $this->load->model('siswa_model');
        $this->load->model('user_model');
        $this->load->model('soal_model');
        $this->load->model('jawaban_detail_model');

        $id_jawaban = $this->input->post('id_jawaban');
        $jawaban=$_POST["jawaban"];
        $id_soal=$_POST["soal"];
        $jumlah=$_POST['jumlah_soal'];

        for ($i=0;$i<$jumlah;$i++){         

            $nomor=$id_soal[$i];
            $jawaban[$nomor];           

            $data = array(
                'id_ikut_ujian' => $id_jawaban,                        
                'id_soal'       => $nomor,                        
                'id_mapel'      => $this->soal_model->get_id_mapel($nomor),                       
                'jawaban'       => $jawaban[$nomor],                      
                'kunci'         => $this->soal_model->get_jawaban($nomor),                      
            );
            $this->soal_model->Simpan('hasil_ujian', $data);
        }

        $sql        = $this->jawaban_detail_model->AmbilHasilTes("where id_ikut_ujian = $id_jawaban ");           
        $jumlah     = $sql->num_rows();

        foreach($sql->result_array() as $data) {
                $id_jawaban_detail = $data['id'];
                if($data['jawaban']==$data['kunci']){
                    $data = array(
                        'nilai' => 5,                       
                    );
                    $this->jawaban_detail_model->UpdateNilai($id_jawaban_detail, $data);
                } else {
                    $data = array(
                        'nilai' => 1,                       
                    );
                    $this->jawaban_detail_model->UpdateNilai($id_jawaban_detail, $data);
                }
            }

        $benar = 0;
        $salah = 0;
        $total_nilai = 0;
    
        $sql = $this->jawaban_detail_model->AmbilHasilTes("where id_ikut_ujian = $id_jawaban");           
        $jumlah= $sql->num_rows();

        foreach($sql->result_array() as $data) {
            if($data['jawaban']==$data['kunci']){
                $benar++;
            } else {
                $salah++;
            }
            $total_nilai += $data['nilai'];
        }       

        $data = array(
            'benar' => $benar,
            'salah' => $salah,
            'total_nilai' => $total_nilai,
            'status' => 'ya',
        );      
    
        $this->jawaban_model->UpdateTotalNilai($id_jawaban, $data);
        redirect('ujian/dnilai2/'.$id_jawaban);
    }


}