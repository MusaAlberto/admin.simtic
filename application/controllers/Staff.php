<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('staff_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_staff');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_staff');
		}else if($level == 'staff'){
			$this->load->view('master/staff_data_staff');
		}
	}

	public function data() {
		$data					= $this->staff_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'nama' 			=> $data->nama_staff,
					'alamat'		=> $data->alamat,
					'no_telp'		=> $data->no_telp,
					'email'			=> $data->email,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 		. $data->id_admin 	. '"
														data-nama="' 	. $data->nama_staff . '"
														data-alamat="' 	. $data->alamat		. '"
														data-no_telp="' . $data->no_telp 	. '"
														data-email="' 	. $data->email 		. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 		. $data->id_admin 	. '"
														data-nama="' 	. $data->nama_staff . '"
														data-alamat="' 	. $data->alamat		. '"
														data-no_telp="' . $data->no_telp 	. '"
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
			$nama 				= $_POST['nama'];
			$alamat 			= $_POST['alamat'];
			$no_telp			= $_POST['no_telp'];
			$email 				= $_POST['email'];
			$password 			= $_POST['password'];
			$check				= $this->db->query(
									"SELECT * FROM tbl_admin
									WHERE email='$email';"
									);
			$msg 			 	= false;
			if ($check->num_rows()==0){	
				$simpan 			= $this->staff_model->tambah(
										$_POST['nama'],
										$_POST['alamat'],
										$_POST['no_telp'],
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
			$edit 				= $this->staff_model->edit(
									$_POST['id'],
									$_POST['nama'],
									$_POST['alamat'],
									$_POST['no_telp'],
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
		$hapus 				= $this->staff_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}
}
?>