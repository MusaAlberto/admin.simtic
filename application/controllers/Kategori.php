<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/*if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}*/
		$this->load->model('kategori_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'dosen') {
			$this->load->view('master/kategori');
		}
	}

	public function data() {
		$data					= $this->kategori_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_kategori,
					'nama' 			=> $data->nama_kategori,
					'jenis' 		=> $data->jenis_soal,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-s"
														data-id="' 			. $data->id_kategori 	. '" 
														data-kode="' 		. $data->kode_kategori 	. '" 
														data-nama="' 		. $data->nama_kategori 	. '"
														data-jenis="' 		. $data->jenis_soal 	. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-s"
								  						data-id="' 			. $data->id_kategori 	. '" 
														data-kode="' 		. $data->kode_kategori 	. '" 
														data-nama="' 		. $data->nama_kategori 	. '"
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
		if (isset($_POST['kode']) || isset($_POST['nama'])) {
			$kode 				= $_POST['kode'];
			$nama 				= $_POST['nama'];
			$jenis 				= $_POST['jenis'];
			$check				= $this->db->query(
											"SELECT * FROM tabel_kategori 
											WHERE nama_kategori ='$nama';"
											);
			$msg 			 	= false;
			if ($check->num_rows()==0){
				$id					= '';		
				$simpan 			= $this->kategori_model->tambah(
										$id,
										$_POST['kode'],
										$_POST['nama'],
										$_POST['jenis']
									);
				
				if ($simpan) {
					$msg 		= true;
				}
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['kode']) || isset($_POST['nama'])) {
			$edit 				= $this->kategori_model->edit(
									$_POST['id'],
									$_POST['kode'],
									$_POST['nama'],
									$_POST['jenis']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->kategori_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>