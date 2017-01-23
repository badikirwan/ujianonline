<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	public function index() {
		$cek = $this->session->userdata('username');
		if(empty($cek)) {
			redirect(base_url());
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}

	function pdf(){
    // load dompdf
    $this->load->helper('dompdf');
    $this->load->model('siswa_model');
    $data = array(
			'siswa'=>$this->siswa_model->get_all_siswa(),			
		);		
    //load content html
    $html = $this->load->view('dashboard', $data, true);
    // create pdf using dompdf
    $filename = 'Message';
    $paper = 'A4';
    $orientation = 'potrait';
    generate($html, $filename);
}

/**
 * INSERT DATA GURU
 */
	public function insert() {
			$nama = $_POST['nama'];
			$nik = $_POST['nik'];
            $mapel = $_POST['mengajar'];
			$data_insert = array(
					'nama' => $nama,
					'nik' => $nik,
                    'mengajar'=> $mapel,
				);
			$res = $this->model_user->InsertData('guru',$data_insert);
			if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/dataguru");
			} else {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
	}	

/**
 * EDIT DATA GURU
 */
	public function update() {
		$nama = $_POST['nama'];
		$nik = $_POST['nik'];
        $mapel = $_POST['mengajar'];
			$data_update = array(
					'nama' => $nama,
					'nik' => $nik,
                    'mengajar'=> $mapel,
				);
			$where = array('nik' => $nik);
			$res = $this->model_user->UpdateData('guru',$data_update, $where);
			if($res>=1) {
				 $this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/dataguru");
			} else {
				echo "<h2> Insert data gagal</h2>";
            }
		
	}

/**
 * HAPUS DATA GURU
 */
	public function delete($nik) {
		$where = array('nik' => $nik);
		$res = $this->model_user->DeleteData('guru',$where);
		if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b>  Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/dataguru");
		} else {
			$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data gagal dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
	}

	public function insertsiswa() {
		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$jurusan = $_POST['jurusan'];
		$data_insert = array(
					'nama' => $nama,
					'nim' => $nim,
					'jurusan' => $jurusan,
				);
			$res = $this->model_user->InsertData('siswa',$data_insert);
			if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/datasiswa");
			} else {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
	}

	public function updatesiswa() {
		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$jurusan = $_POST['jurusan'];
			$data_update = array(
					'nama' => $nama,
					'nim' => $nim,
					'jurusan' => $jurusan,
				);
			$where = array('nim' => $nim);
			$res = $this->model_user->UpdateData('siswa',$data_update, $where);
			if($res>=1) {
				 $this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b> Data Berhasil diedit <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/datasiswa");
			} else {
				echo "<h2> Insert data gagal</h2>";
		}
		
	}

	public function deletesiswa($nim) {
		$where = array('nim' => $nim);
		$res = $this->model_user->DeleteData('siswa',$where);
		if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b>  Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/datasiswa");
		} else {
			$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data gagal dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
	}

	public function insertsoal() {
		$guru = $_POST['guru'];
		$mapel = $_POST['mapel'];
		$bobot = $_POST['bobot'];
		$soal = $_POST['soal'];
		$opsi_a = $_POST['opsi_a'];
		$opsi_b = $_POST['opsi_b'];
		$opsi_c = $_POST['opsi_c'];
		$opsi_d = $_POST['opsi_d'];
		$jawaban = $_POST['jawaban'];
		$data_insert = array(
					'id_guru' => $guru,
					'id_mapel' => $mapel,
					'bobot' => $bobot,
					'soal' => $soal,
					'opsi_A' => $opsi_a,
					'opsi_B' => $opsi_b,
					'opsi_C' => $opsi_c,
					'opsi_D' => $opsi_d,
					'jawaban' => $jawaban,
				);
			$res = $this->model_user->InsertData('soal',$data_insert);
			if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."soal");
			} else {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
	}

	public function deletesoal($id) {
		$where = array('id_soal' => $id);
		$res = $this->model_user->DeleteData('soal',$where);
		if($res>=1) {
				$this->session->set_flashdata('notif','<br</br><div class="alert alert-success" role="alert"><b>Well done!</b>  Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				redirect(base_url()."dashboard/datasoal");
		} else {
			$this->session->set_flashdata('notif','<br</br><div class="alert alert-danger" role="alert"><b>Well done!</b> Data gagal dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
	}
}