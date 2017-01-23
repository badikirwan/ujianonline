<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		if(empty($this->session->userdata('username'))){
			$this->load->view('p_login');
		} else {
			redirect('dashboard');
		}
	}

	public function ceklogin() {
		$data = array(
				'username' => $this->input->post('usr', TRUE),
				'password' => md5($this->input->post('pwd', TRUE))
			);
		$hasil = $this->user_model->cek_user($data);
		if ($hasil->num_rows() > 0) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] = 'Sudah Loggin';
				$sess_data['id'] 		= $sess->id;
				$sess_data['user_id'] 	= $sess->user_id;
				$sess_data['username'] 	= $sess->username;
				$sess_data['nama'] 		= $sess->nama;
				$sess_data['level'] 	= $sess->level;
				$this->session->set_userdata($sess_data);
			}
				redirect('dashboard');
		}
		else {
			$this->session->set_flashdata('pesan', 'Maaf, username atau password salah!');
			redirect('login');
		}
	}
}
