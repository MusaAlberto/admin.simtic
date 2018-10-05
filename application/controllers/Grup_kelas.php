<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grup_kelas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('grup_kelas_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_grup_kelas');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_grup_kelas');
		}else if($level == 'grup_kelas'){
			$this->load->view('master/grup_kelas_data_grup_kelas');
		}
	}

	public function data() {
		$data					= $this->grup_kelas_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama_kelas' 	=> $data->nama_kelas,
					'tentor'		=> $data->id_tentor,
					'jadwal'		=> $data->jadwal,
					'jenis_les'		=> $data->jenis_les,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 			. $data->id_kelas 	. '"
														data-nama_kelas="' 	. $data->nama_kelas . '"
														data-tentor="' 		. $data->id_tentor		. '"
														data-jadwal="' 		. $data->jadwal 	. '"
														data-jenis_les="' 	. $data->jenis_les 	. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 			. $data->id_kelas 	. '"
														data-nama_kelas="' 	. $data->nama_kelas . '"
														data-tentor="' 		. $data->id_tentor		. '"
														data-jadwal="' 		. $data->jadwal 	. '"
														data-jenis_les="' 	. $data->jenis_les 	. '"
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
		if (isset($_POST['nama_kelas']) || isset($_POST['tentor'])) {
			$nama_kelas 		= $_POST['nama_kelas'];
			$tentor 			= $_POST['tentor'];
			$jadwal				= $_POST['jadwal'];
			$jenis_les			= $_POST['jenis_les'];
			$check				= $this->db->query(
									"SELECT * FROM tbl_grup_kelas 
									WHERE nama_kelas='$nama_kelas';"
									);
			$msg 			 	= false;
			if ($check->num_rows()==0){	
				$simpan 			= $this->grup_kelas_model->tambah(
										$_POST['nama_kelas'],
										$_POST['tentor'],
										$_POST['jadwal'],
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
		if (isset($_POST['nama_kelas']) || isset($_POST['tentor'])) {
			$edit 				= $this->grup_kelas_model->edit(
									$_POST['id'],
									$_POST['nama_kelas'],
									$_POST['tentor'],
									$_POST['jadwal'],
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
		$hapus 				= $this->grup_kelas_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>