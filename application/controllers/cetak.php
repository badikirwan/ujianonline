<?php

/**
* 
*/
class Cetak extends CI_Controller {
	
	public function pdf($id) {
    // load dompdf
    	$this->load->helper('dompdf');
    	$this->load->model('siswa_model');
  //   	$data['users']=array(
		// 	array('firstname'=>'Agung','lastname'=>'Setiawan','email'=>'ag@setiawan.com'),
		// 	array('firstname'=>'Hauril','lastname'=>'Maulida Nisfar','email'=>'hm@setiawan.com'),
		// 	array('firstname'=>'Akhtar','lastname'=>'Setiawan','email'=>'akh@setiawan.com'),
		// 	array('firstname'=>'Gitarja','lastname'=>'Setiawan','email'=>'git@setiawan.com')
		// );
		 $data['users'] = $this->db->query("SELECT siswa.nama, ikut_ujian.total_nilai, ikut_ujian.benar, ikut_ujian.salah FROM ikut_ujian INNER JOIN siswa ON ikut_ujian.id_siswa = siswa.nim WHERE ikut_ujian.tes = '$id'")->result_array();
		//$data['users']		= $this->siswa_model->get_all_siswa();		
    //load content html
    	$html = $this->load->view('admin/report', $data, true);
    // create pdf using dompdf
    	$filename = 'Message';
    	$paper = 'A4';
    	$orientation = 'potrait';
    	generate($html, $filename);
	}
}