<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('dosen_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_dosen');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_dosen');
		}else if($level == 'dosen'){
			$this->load->view('master/dosen_data_dosen');
		}
	}

	public function data() {
		$data					= $this->dosen_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_dosen,
					'nip' 			=> $data->nip,
					'nama'			=> $data->nama_dosen,
					'alamat'		=> $data->alamat,
					'no_hp'			=> $data->no_hp,
					'email'			=> $data->email,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 		. $data->id_dosen 	. '"
														data-kode="' 	. $data->kode_dosen . '"
														data-nip="' 	. $data->nip 		. '"
														data-nama="' 	. $data->nama_dosen	. '"
														data-alamat="' 	. $data->alamat		. '"
														data-no_hp="' 	. $data->no_hp 		. '"
														data-email="' 	. $data->email 		. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 		. $data->id_dosen 	. '"
														data-kode="' 	. $data->kode_dosen . '"
														data-nip="' 	. $data->nip 		. '"
														data-nama="' 	. $data->nama_dosen	. '"
														data-alamat="' 	. $data->alamat		. '"
														data-no_hp="' 	. $data->no_hp 		. '"
														data-email="' 	. $data->email 		. '"
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
		if (isset($_POST['email']) || isset($_POST['password'])) {
			$nip 				= $_POST['nip'];
			$nama 				= $_POST['nama'];
			$nama 				= $_POST['alamat'];
			$no_hp 				= $_POST['no_hp'];
			$email 				= $_POST['email'];
			$password 			= $_POST['password'];
			$check				= $this->db->query(
									"SELECT * FROM tabel_dosen 
									WHERE email='$email';"
									);
			$msg 			 	= false;
			if ($check->num_rows()==0){
				$id					= $this->dosen_model->buat_id();
				$kode				= $this->dosen_model->buat_kd();		
				$simpan 			= $this->dosen_model->tambah(
										$id,
										$kode,
										$_POST['nip'],
										$_POST['nama'],
										$_POST['alamat'],
										$_POST['no_hp'],
										$_POST['email'],
										$_POST['password']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['email']) || isset($_POST['passsword'])) {
			$edit 				= $this->dosen_model->edit(
									$_POST['id'],
									$_POST['nip'],
									$_POST['nama'],
									$_POST['alamat'],
									$_POST['no_hp'],
									$_POST['email'],
									$_POST['password']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->dosen_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>