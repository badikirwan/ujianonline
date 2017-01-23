<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index() {
        $user = $this->session->userdata('username');
       if(empty($user)){
            $this->load->view('p_login');
        } else {
            $status = $this->session->userdata('level');
            if($status =='admin'){
                $this->template->load('admin', 'dashboard');
            } elseif ($status =='guru') {
                $this->template->load('guru', 'dashboard');
            } else {
                $this->template->load('siswa', 'dashboard_siswa');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
