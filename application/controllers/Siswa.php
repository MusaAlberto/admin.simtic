<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('siswa_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_siswa');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_siswa');
		}else if($level == 'siswa'){
			$this->load->view('master/siswa_data_siswa');
		}
	}

	public function data() {
		$data					= $this->siswa_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama_siswa' 	=> $data->nama_siswa,
					'nama_ortu' 	=> $data->nama_ortu,
					'alamat'		=> $data->alamat,
					'no_telp'		=> $data->no_telp,
					'sekolah'		=> $data->sekolah,
					'kelas'			=> $data->kelas,
					'program_les'	=> $data->program_les,
					'jenis_les'		=> $data->jenis_les,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 			. $data->id_siswa 	. '"
														data-nama_siswa="' 	. $data->nama_siswa . '"
														data-nama_ortu="' 	. $data->nama_ortu  . '"
														data-alamat="'	 	. $data->alamat		. '"
														data-no_telp="' 	. $data->no_telp 	. '"
														data-sekolah="' 	. $data->sekolah 	. '"
														data-kelas="' 		. $data->kelas 		. '"
														data-program_les="' . $data->program_les. '"
														data-jenis_les="' 	. $data->jenis_les	. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 			. $data->id_siswa 	. '"
														data-nama_siswa="' 	. $data->nama_siswa . '"
														data-nama_ortu="' 	. $data->nama_ortu . '"
														data-alamat="'	 	. $data->alamat		. '"
														data-no_telp="' 	. $data->no_telp 	. '"
														data-sekolah="' 	. $data->sekolah 	. '"
														data-kelas="' 		. $data->kelas 		. '"
														data-program_les="' . $data->program_les. '"
														data-jenis_les="' 	. $data->jenis_les	. '"
														><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}
	
	public function tambah() {
		if (isset($_POST['nama_siswa']) || isset($_POST['nama_ortu'])) {
			$nama_siswa			= $_POST['nama_siswa'];
			$nama_ortu 			= $_POST['nama_ortu'];
			$alamat 			= $_POST['alamat'];
			$no_telp			= $_POST['no_telp'];
			$sekolah 			= $_POST['sekolah'];
			$kelas 				= $_POST['kelas'];
			$program_les		= $_POST['program_les'];
			$jenis_les 			= $_POST['jenis_les'];
			$check				= $this->db->query(
									"SELECT * FROM tbl_siswa 
									WHERE nama_siswa='$nama_siswa';"
									);
			$msg 			 	= false;
			if ($check->num_rows()==0){	
				$simpan 			= $this->siswa_model->tambah(
										$_POST['nama_siswa'],
										$_POST['nama_ortu'],
										$_POST['alamat'],
										$_POST['no_telp'],
										$_POST['sekolah'],
										$_POST['kelas'],
										$_POST['program_les'],
										$_POST['jenis_les']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['nama_siswa']) || isset($_POST['nama_ortu'])) {
			$edit 				= $this->siswa_model->edit(
									$_POST['id'],
									$_POST['nama_siswa'],
									$_POST['nama_ortu'],
									$_POST['alamat'],
									$_POST['no_telp'],
									$_POST['sekolah'],
									$_POST['kelas'],
									$_POST['program_les'],
									$_POST['jenis_les']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->siswa_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>