<?php

/**
* 
*/
class Jawaban extends CI_Controller
{
	
	public function jawab() {
		$this->load->model('siswa_model');
    	$this->load->model('model_user');
    	$this->load->model('detail_jawaban_model');
	}
}