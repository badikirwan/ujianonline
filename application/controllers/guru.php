<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Guru extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('guru_model');
	}

	public function index() {
        $status = $this->session->userdata('level');
        if($status == 'admin') {
            $data 	= $this->guru_model->get_all_guru();
            $mapel 	= $this->user_model->GetMapel();
            $data   = $this->guru_model->cek_user();
            $this->template->load('admin', 'admin/t_guru', array('data'=>$data, 'mapel'=>$mapel));
        } else {
            redirect('login');
        }
	}

	public function active_user() {
		$data_add = array(
					'user_id' 	=> $this->input->post('nik_guru'),
					'nama' 		=> $this->input->post('nama_guru'),
					'username' 	=> $this->input->post('nik_guru'),
					'password' 	=> md5($this->input->post('nik_guru')),
					'level'		=> 'guru'
				);
		$this->guru_model->guru_add('users', $data_add);
		echo json_encode(array("status" => TRUE));
	}

	public function guru_add() {
		$data_add = array(
					'nama' 		=> $this->input->post('nama_guru'),
					'nik' 		=> $this->input->post('nik_guru'),
					'mengajar' 	=> $this->input->post('mengajar_guru'),
				);
		$this->guru_model->guru_add('guru', $data_add);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id) {
		$data = $this->guru_model->get_by_id($id);
		echo json_encode($data);
	}

	public function guru_update() {
		$data_update = array(
						'nama'		=> $this->input->post('nama_guru'),
						'nik'		=> $this->input->post('nik_guru'),
						'mengajar'	=> $this->input->post('mengajar_guru'),
					);
		$where = array('id' => $this->input->post('id'));
		$this->guru_model->guru_update('guru', $data_update, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function guru_delete($id) {
		$this->guru_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
