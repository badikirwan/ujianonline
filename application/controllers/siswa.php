<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('ujian_model');
		$this->load->model('siswa_model');
		$this->load->helper('url');
	}

	public function index() {
		$status = $this->session->userdata('level');
        if($status =='admin') {
            $data 		= $this->siswa_model->get_all_siswa();
            $jurusan 	= $this->siswa_model->get_all_jurusan();
            $data  		= $this->siswa_model->cek_user();
            $this->template->load('admin', 'admin/t_siswa', array('data'=>$data, 'jurusan'=>$jurusan));
        } else {
            redirect('login');
        }
	}

	public function ujian() {
		$user       = $this->session->userdata('username');
        $nim        = $this->siswa_model->get_nis($user);
        $jurusan    = $this->siswa_model->get_jurusan($nim);
        $data       = $this->ujian_model->get_ujian("where id_jurusan = '$jurusan'");
        $data 		= $this->db->query("SELECT jenis_ujian.*, mapel.nama AS mapel, (SELECT COUNT(id) FROM ikut_ujian WHERE ikut_ujian.id_siswa = '$nim' AND ikut_ujian.tes = jenis_ujian.id) AS sudah_ikut, (SELECT total_nilai FROM ikut_ujian WHERE ikut_ujian.id_siswa = '$nim' AND ikut_ujian.tes = jenis_ujian.id) AS nilai FROM jenis_ujian INNER JOIN mapel ON jenis_ujian.id_mapel = mapel.nama WHERE id_jurusan='$jurusan' ORDER BY jenis_ujian.id ASC")->result_array();
        $this->template->load('siswa', 'siswa/ujian', array('data'=>$data));
	}

	public function active_user() {
		$data_add = array(
					'user_id' 	=> $this->input->post('nis_siswa'),
					'nama' 		=> $this->input->post('nama_siswa'),
					'username' 	=> $this->input->post('nis_siswa'),
					'password' 	=> md5($this->input->post('nis_siswa')),
					'level'		=> 'siswa'
				);
		$this->siswa_model->siswa_add('users', $data_add);
		echo json_encode(array("status" => TRUE));
	}

	public function siswa_add() {
		$data_add = array(
					'nama' 		=> $this->input->post('nama_siswa'),
					'nim' 		=> $this->input->post('nis_siswa'),
					'jurusan' 	=> $this->input->post('jurusan_siswa'),
				);
		$this->siswa_model->siswa_add('siswa', $data_add);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id) {
		$data = $this->siswa_model->get_by_id($id);
		echo json_encode($data);
	}

	public function siswa_update() {
		$data_update = array(
				'nama' 		=> $this->input->post('nama_siswa'),
				'nim' 		=> $this->input->post('nis_siswa'),
				'jurusan' 	=> $this->input->post('jurusan_siswa'),
				);
		$where = array('id' => $this->input->post('id'));
		$this->siswa_model->siswa_update('siswa', $data_update, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function siswa_delete($id) {
		$this->siswa_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
