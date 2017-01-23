<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Soal extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->model('guru_model');
				$this->load->model('soal_model');
	}

	public function index() {
    $soal 	= $this->user_model->GetSoal();
    $mapel 	= $this->user_model->GetMapel();
    $guru 	= $this->user_model->GetGuru();
    $opsi 	= $this->user_model->GetOpsi();
    $this->template->load('admin', 'admin/t_soal', array('data'=>$soal, 'mapel'=>$mapel,
            'guru'=>$guru, 'opsi'=>$opsi));
	}

	public function soal_add() {
		$data_insert	= array(
					'id_guru' 	=> $this->input->post('guru'),
					'id_mapel' 	=> $this->input->post('mapel'),
					'bobot' 	=> $this->input->post('bobot'),
					'soal' 		=> $this->input->post('soal'),
					'opsi_A' 	=> $this->input->post('opsi_a'),
					'opsi_B' 	=> $this->input->post('opsi_b'),
					'opsi_C' 	=> $this->input->post('opsi_c'),
					'opsi_D' 	=> $this->input->post('opsi_d'),
					'jawaban' 	=> $this->input->post('jawaban'),
					);

		$res = $this->soal_model->soal_add('soal', $data_insert);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id) {
		$data = $this->soal_model->get_by_id($id);
		echo json_encode($data);
	}

	public function soal_update() {
		$data_update = array(
					'id_guru' 	=> $this->input->post('guru'),
					'id_mapel' 	=> $this->input->post('mapel'),
					'bobot' 	=> $this->input->post('bobot'),
					'soal' 		=> $this->input->post('soal'),
					'opsi_A' 	=> $this->input->post('opsi_a'),
					'opsi_B' 	=> $this->input->post('opsi_b'),
					'opsi_C' 	=> $this->input->post('opsi_c'),
					'opsi_D' 	=> $this->input->post('opsi_d'),
					'jawaban' 	=> $this->input->post('jawaban'),
					);
		$where = array('id_soal' => $this->input->post('id'));
		$this->soal_model->soal_update('soal', $data_update, $where);
		echo json_encode(array("status" => TRUE));
	}

	public function soal_delete($id) {
		$this->soal_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function update() {
		$guru 		= $_POST['guru'];
		$mapel 		= $_POST['mapel'];
		$bobot 		= $_POST['bobot'];
		$soal 		= $_POST['soal'];
		$opsi_a 	= $_POST['opsi_a'];
		$opsi_b 	= $_POST['opsi_b'];
		$opsi_c 	= $_POST['opsi_c'];
		$opsi_d 	= $_POST['opsi_d'];
		$jawaban 	= $_POST['jawaban'];
		$data_update	= array(
					'id_guru' 	=> $guru,
					'id_mapel' 	=> $mapel,
					'bobot' 		=> $bobot,
					'soal' 			=> $soal,
					'opsi_A' 		=> $opsi_a,
					'opsi_B' 		=> $opsi_b,
					'opsi_C' 		=> $opsi_c,
					'opsi_D' 		=> $opsi_d,
					'jawaban' 	=> $jawaban,);

				$where 	= array('soal' => $soal);
				$res 		=	$this->soal_model->Update('soal', $data_update, $where);
				if ($res >= 1) {
					redirect('saol');
				} else {
					# code...
				}
	}

	public function delete($id) {
		$where = array('id_soal' => $id);
		$res 	 = $this->soal_model->Delete('soal', $where);
		if ($res >= 1) {
			$this->session->set_flashdata('notif', '<br</br><div class="alert alert-success" role="alert"><b>Well done!</b>  Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>' );
			redirect('soal');
		} else {
			$this->session->set_flashdata('notif', '<br</br><div class="alert alert-success" role="alert"><b>Well done!</b>  Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('soal');
		}
	}
}
