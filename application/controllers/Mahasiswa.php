<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user') == Null) {
			redirect ('user/logout');
		}
		$this->load->model('mahasiswa_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$this->load->view('master/superadmin_data_mahasiswa');
		}else if($level == 'admin'){
			$data ['jurusan'] = $this->mahasiswa_model->getJurusan();
			$this->load->view('master/admin_data_mahasiswa', $data);
		}else if($level == 'dosen'){
			$this->load->view('master/dosen_data_mahasiswa');
		}
	}

	public function data() {
		$data					= $this->mahasiswa_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama'			=> $data->nama,
					'kelas'			=> $data->kelas,
					'nim'			=> $data->nim,
					'prodi'			=> $data->nama_prodi,
					'jurusan'		=> $data->nama_jurusan,
					'no_telp'		=> $data->no_telp,
					'alamat'		=> $data->alamat,
					'foto'			=> $data->foto,
					'email'			=> $data->email,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs" 
														data-id="' 			. $data->id_peserta 	. '" 
														data-kode="' 		. $data->kode_peserta 	. '" 
														data-nama="' 		. $data->nama 			. '"
														data-kelas="' 		. $data->kelas 			. '"
														data-nim="' 		. $data->nim 			. '"
														data-prodi="' 		. $data->nama_prodi 	. '"
														data-id_prodi="'	. $data->id_prod 		. '"
														data-jurusan="' 	. $data->nama_jurusan 	. '"
														data-id_jurusan="'	. $data->id_jur 		. '"
														data-no_telp="'	 	. $data->no_telp 		. '"
														data-alamat="'  	. $data->alamat 		. '"
														data-gambar="' 		. $data->foto 			. '"
														data-email="' 		. $data->email 			. '"
														><i class="fa fa-edit"></i></button>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs" 
														data-id="' 			. $data->id_peserta 	. '" 
														data-kode="' 		. $data->kode_peserta 	. '" 
														data-nama="' 		. $data->nama 			. '"
														data-kelas="' 		. $data->kelas 			. '"
														data-nim="' 		. $data->nim 			. '"
														data-prodi="' 		. $data->nama_prodi 	. '"
														data-jurusan="' 	. $data->nama_jurusan 	. '"
														data-no_telp="' 	. $data->no_telp 		. '"
														data-alamat="'  	. $data->alamat 		. '"
														data-gambar="' 		. $data->foto 			. '"
														data-email="' 		. $data->email 			. '"
														><i class="fa fa-trash-o"></i></button> 
										</div>'
				);
		}
		$result 				= array (
				'aaData' 		=> $hasil
			);
		echo json_encode($result);
	}
	
	public function tambah() {
		if (isset($_POST['nama']) || isset($_POST['email'])) {
			$nama 				= $_POST['nama'];
			$kelas 				= $_POST['kelas'];
			$nim 				= $_POST['nim'];
			$prodi 				= $_POST['prodi'];
			$jurusan 			= $_POST['jurusan'];
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

			$id_user			= $this->mahasiswa_model->buat_id();
			//config untuk image
				$config['upload_path']          = './assets/user_image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $id_user;
				$this->load->library('upload', $config);

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
				$kode				= $this->mahasiswa_model->buat_kd();		
				$simpan 			= $this->mahasiswa_model->tambah(
										$id,
										$kode,
										$_POST['nama'],
										$_POST['kelas'],
										$_POST['nim'],
										$_POST['prodi'],
										$_POST['jurusan'],
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
		if (isset($_POST['email']) || isset($_POST['passsword'])) {

			$image 	= 	'';
			$msg 	= false;

			if (isset($_FILES['foto']['name'])) {

				$config['upload_path']          = './assets/user_image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $this->mahasiswa_model->buat_id();
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

			$edit 				= $this->mahasiswa_model->edit(
									$_POST['id'],
									$_POST['nama'],
									$_POST['kelas'],
									$_POST['nim'],
									$_POST['prodi'],
									$_POST['jurusan'],
									$_POST['no_telp'],
									$_POST['alamat'],
									$image,
									$_POST['email'],
									$_POST['password']
								);
				
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->mahasiswa_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}

	public function getProdi($id){
		$data		= $this->mahasiswa_model->getProdi($id);
		echo json_encode($data);
	}


	/*public function getData(){
		$data = $this->mahasiswa_model->cari_semua();
		$response = array("error"=>false);
		if($data){
			$response["error"] = false;
			foreach ($data as $mhs) {
				$response["id"] = $mhs->id_peserta;
				$response["mhs"]["kode_peserta"] = $mhs->kode_peserta;
				$response["mhs"]["nama"] = $mhs->nama;
				echo json_encode($response);
			}
		}else{
			$response["error"] = true;
			$response["msg"] = "not found";
			echo json_encode($response);
		}
	}*/

	

}
?>