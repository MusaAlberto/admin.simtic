<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_reading extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('ujian_reading_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'dosen') {
			$data ['tipe'] = $this->ujian_reading_model->getKategori();
			$this->load->view('soal_ujian/ujian_reading', $data);
		}
	}

	public function data() {
		$data					= $this->ujian_reading_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_soal,
					'gambar'		=> $data->gambar,
					'pertanyaan' 	=> $data->pertanyaan,
					'pil_a'			=> $data->pil_a,
					'pil_b'			=> $data->pil_b,
					'pil_c'			=> $data->pil_c,
					'pil_d'			=> $data->pil_d,
					'jawaban' 		=> $data->kunci_jawab,
					'tipe' 	 		=> $data->nama_kategori,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-xs"
														data-id="' 			. $data->id_soal 		. '" 
														data-kode="' 		. $data->kode_soal 		. '"
														data-gambar="' 		. $data->gambar 		. '"
														data-pertanyaan="' 	. $data->pertanyaan 	. '"
														data-pil_a="' 		. $data->pil_a 			. '"
														data-pil_b="' 		. $data->pil_b 			. '"
														data-pil_c="' 		. $data->pil_c 			. '"
														data-pil_d="' 		. $data->pil_d 			. '"
														data-jawaban="' 	. $data->kunci_jawab	. '"
														data-tipe="' 		. $data->nama_kategori 	. '"
														data-id_kategori="' . $data->kd_kategori	. '"
														><i class="fa fa-edit"></i></button>' 		.
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-xs"
								  						data-id="' 			. $data->id_soal 		. '" 
														data-kode="' 		. $data->kode_soal 		. '"
														data-gambar="' 		. $data->gambar 		. '"
														data-pertanyaan="' 	. $data->pertanyaan 	. '"
														data-pil_a="' 		. $data->pil_a 			. '"
														data-pil_b="' 		. $data->pil_b 			. '"
														data-pil_c="' 		. $data->pil_c 			. '"
														data-pil_d="' 		. $data->pil_d 			. '"
														data-jawaban="' 	. $data->kunci_jawab	. '"
														data-tipe="' 		. $data->tipe_soal 		. '"
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
		if (isset($_POST['pil_a'])) {
			$pertanyaan 	= $_POST['pertanyaan'];
			$pil_a 			= $_POST['pil_a'];
			$pil_b 			= $_POST['pil_b'];
			$pil_c 			= $_POST['pil_c'];
			$pil_d 			= $_POST['pil_d'];
			$jawaban 		= $_POST['jawaban'];
			$tipe 			= $_POST['tipe'];

			$msg 			 	= false;
			$image 				= '';

			$id_soal			= $this->ujian_reading_model->buat_id();

			//config untuk image
				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $id_soal;
				$this->load->library('upload', $config);

				//kondisi jika tidak meng upload image
				if ($this->upload->do_upload('foto')){
					$image = $this->upload->data();
				}

				if (empty($image)) {
					$file_name = '';
				}else{
					$file_name = base_url().'assets/soal_assets/image/'.$image['file_name'];
				}

				$id					= $id_soal;
				$kode				= $this->ujian_reading_model->buat_kd();		
				$simpan 			= $this->ujian_reading_model->tambah(
										$id,
										$kode,
										$file_name,
										$_POST['pertanyaan'],
										$_POST['pil_a'],
										$_POST['pil_b'],
										$_POST['pil_c'],
										$_POST['pil_d'],
										$_POST['jawaban'],
										$_POST['tipe']
									);
				
				if ($simpan) {
					$msg 		= true;
			}			
			echo json_encode($msg);
		}
	}
	
	public function edit() {
		if (isset($_POST['pil_a'])) {
			$image 	= 	'';
			$msg 	= false;

			if (isset($_FILES['foto']['name'])) {

				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']            = $this->ujian_reading_model->buat_id();
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('foto')){
					$image_status = $this->upload->data();
					$image = base_url().'assets/soal_assets/image/'.$image_status['file_name'];
				}else{
					$error=$this->upload->display_errors();
					$image = $_POST['nama_gambar'];
				}

			}else{
				$image = $_POST['nama_gambar'];
			}

			$edit 				= $this->ujian_reading_model->edit(
									$_POST['id'],
									$image,
									$_POST['pertanyaan'],
									$_POST['pil_a'],
									$_POST['pil_b'],
									$_POST['pil_c'],
									$_POST['pil_d'],
									$_POST['jawaban'],
									$_POST['tipe']
								);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}
	
	public function hapus($id) {
		$hapus 				= $this->ujian_reading_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}

}
?>