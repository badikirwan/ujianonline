<?php
/**
* 
*/
class Jurusan extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('jurusan_model');
	}

	public function index() {
		$status = $this->session->userdata('level');
		if($status == 'admin') {
			$jurusan = $this->jurusan_model->get_all_jurusan();
			$this->template->load('admin', 'admin/t_jurusan', array('jurusan' => $jurusan));
		} else {
			redirect('login');
		}
	}

	public function ajax_edit($id) {
		$data = $this->jurusan_model->get_by_id($id);
		echo json_encode($data);
	}

	public function jurusan_add() {
		$data_add = array('nama_jurusan' => $this->input->post('jurusan'));
		$this->jurusan_model->jurusan_add('jurusan', $data_add);
		echo json_encode(array("status" => TRUE));
	}

	public function jurusan_update() {
		$data_update = array('nama_jurusan'	=> $this->input->post('jurusan'));
		$where = array('id' => $this->input->post('id'));
		$this->jurusan_model->jurusan_update('jurusan', $data_update, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function jurusan_delete($id) {
		$this->jurusan_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}