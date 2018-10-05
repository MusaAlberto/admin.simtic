<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_les extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('jenis_les_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_jenis_les');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_jenis_les');
		}else if($level == 'jenis_les'){
			$this->load->view('master/jenis_les_data_jenis_les');
		}
	}

	public function data() {
		$data					= $this->jenis_les_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'				=> $nomor,
					'program_les' 		=> $data->program_les,
					'jenis_les'			=> $data->jenis_les,
					'tarif_siswa'		=> $data->tarif_siswa,
					'insentif_tentor'	=> $data->insentif_tentor,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 				. $data->id_jenis_les 	. '"
														data-program_les="' 	. $data->program_les 	. '"
														data-jenis_les="' 		. $data->jenis_les		. '"
														data-tarif_siswa="' 	. $data->tarif_siswa 	. '"
														data-insentif_tentor="' . $data->insentif_tentor. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 				. $data->id_jenis_les 	. '"
														data-program_les="' 	. $data->program_les 	. '"
														data-jenis_les="' 		. $data->jenis_les		. '"
														data-tarif_siswa="' 	. $data->tarif_siswa 	. '"
														data-insentif_tentor="' . $data->insentif_tentor. '"
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
		if (isset($_POST['program_les']) || isset($_POST['jenis_les'])) {
			$program_les 		= $_POST['program_les'];
			$jenis_les 			= $_POST['jenis_les'];
			$tarif_siswa		= $_POST['tarif_siswa'];
			$insentif_tentor 	= $_POST['insentif_tentor'];
			$check				= $this->db->query(
									"SELECT * FROM tbl_jenis_les 
									WHERE program_les='$program_les';"
									);
			$msg 			 	= false;
			if ($check->num_rows()==0){	
				$simpan 			= $this->jenis_les_model->tambah(
										$_POST['program_les'],
										$_POST['jenis_les'],
										$_POST['tarif_siswa'],
										$_POST['insentif_tentor']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['program_les']) || isset($_POST['jenis_les'])) {
			$edit 				= $this->jenis_les_model->edit(
									$_POST['id'],
									$_POST['program_les'],
									$_POST['jenis_les'],
									$_POST['tarif_siswa'],
									$_POST['insentif_tentor']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->jenis_les_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>