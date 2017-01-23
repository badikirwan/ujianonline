<?php
/**
* 
*/
class Mapel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('mapel_model');
	}

	public function index() {
		$status = $this->session->userdata('level');
        if($status =='admin') {
            $mapel	= $this->mapel_model->get_all_mapel();
            $this->template->load('admin', 'admin/t_mapel', array('mapel'=>$mapel));
        } else {
            redirect('login');
        }
	}

	public function mapel_add() {
		$data_add = array('nama'	=> $this->input->post('nama_mapel'));
		$this->mapel_model->mapel_add('mapel', $data_add);
		echo json_encode(array("status"=> TRUE));
	}

	public function ajax_edit($id) {
		$data = $this->mapel_model->get_by_id($id);
		echo json_encode($data);
	}

	public function mapel_update() {
		$data_update = array(
				'nama' 		=> $this->input->post('nama_mapel'),
				);
		$where = array('id' => $this->input->post('id'));
		$this->mapel_model->mapel_update('mapel', $data_update, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function mapel_delete($id) {
		$this->mapel_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}