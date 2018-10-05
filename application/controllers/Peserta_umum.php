<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_umum extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('peserta_umum_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_peserta_umum');
		}else if($level == 'admin'){
			$this->load->view('master/admin_data_peserta_umum');
		}else if($level == 'dosen'){
			$this->load->view('master/dosen_data_peserta_umum');
		}
	}

	public function data() {
		$data					= $this->peserta_umum_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama'			=> $data->nama,
					'no_telp'		=> $data->no_telp,
					'alamat'		=> $data->alamat,
					'institusi'		=> $data->nama_institusi,
					'email'			=> $data->email,
					'foto'			=> $data->foto,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 			. $data->id_peserta 	. '" 
														data-kode="' 		. $data->kode_peserta 	. '" 
														data-nama="' 		. $data->nama 			. '"
														data-no_telp="'		. $data->no_telp		. '"
														data-alamat="' 		. $data->alamat 		. '"
														data-institusi="' 	. $data->nama_institusi . '"
														data-gambar="' 		. $data->foto 			. '"
														data-email="' 		. $data->email 			. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm" 
														data-id="' 			. $data->id_peserta 	. '" 
														data-kode="' 		. $data->kode_peserta 	. '" 
														data-nama="' 		. $data->nama 			. '"
														data-no_telp="'		. $data->no_telp		. '"
														data-alamat="' 		. $data->alamat 		. '"
														data-institusi="' 	. $data->nama_institusi . '"
														data-gambar="' 		. $data->foto 			. '"
														data-email="' 		. $data->email 			. '"
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
		if (isset($_POST['nama']) ||isset($_POST['email'])) {
			$nama 				= $_POST['nama'];
			$institusi 			= $_POST['institusi'];
			$no_telp 			= $_POST['no_telp'];
			$alamat 			= $_POST['alamat'];
			$email 				= $_POST['email'];
			$password 			= $_POST['password'];
			$check				= $this->db->query(
											"SELECT * FROM tabel_peserta
											WHERE email='$email';"
											);
			$msg 			 	= false;
			$image 				= '';

			$id_user			= $this->peserta_umum_model->buat_id();
			//config untuk image
				$config['upload_path']          = './assets/user_image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $id_user;
				$this->load->library('upload', $config);

				//kondisi jika tidak meng upload image
				if ($this->upload->do_upload('foto')){
					$image = $this->upload->data();
				}

				if (empty($image)) {
					$file_name = '';
				}else{
					$file_name = base_url().'assets/user_image/'.$image['file_name'];
				}

			if ($check->num_rows()==0){
				$id					= $id_user;
				$kode				= $this->peserta_umum_model->buat_kd();		
				$simpan 			= $this->peserta_umum_model->tambah(
										$id,
										$kode,
										$_POST['nama'],
										$_POST['institusi'],
										$_POST['no_telp'],
										$_POST['alamat'],
										$file_name,
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
		if (isset($_POST['email']) || isset($_POST['nama'])) {

			$image 	= 	'';
			$msg 				= false;

			if (isset($_FILES['foto']['name'])) {

				$config['upload_path']          = './assets/user_image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $this->peserta_umum_model->buat_id();
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')){
					$image_status = $this->upload->data();
					$image = base_url().'assets/user_image/'.$image_status['file_name'];
				}else{
					$error=$this->upload->display_errors();
					$image = $_POST['nama_gambar'];
				}

			}else{
				$image = $_POST['nama_gambar'];
			}
			$edit 				= $this->peserta_umum_model->edit(
									$_POST['id'],
									$_POST['nama'],
									$_POST['institusi'],
									$_POST['no_telp'],
									$_POST['alamat'],
									$image,
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
		$hapus 				= $this->peserta_umum_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}

}
?>