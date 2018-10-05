<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simulasi_listening extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user') == Null) {
			redirect ('user/logout');
		}
		$this->load->model('simulasi_listening_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$level = $this->session->userdata('level_user');
		if ($level == 'dosen') {
			$data ['riwayat'] = $this->simulasi_listening_model->riwayat_audio();
			$data ['tipe'] = $this->simulasi_listening_model->getKategori();
			$this->load->view('soal_simulasi/simulasi_listening', $data);
		}
	}

	public function data() {
		$data					= $this->simulasi_listening_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->id_audio,
					'audio'			=> $data->audio,
					'gambar'		=> $data->gambar,
					'pertanyaan' 	=> $data->pertanyaan,
					'pil_a'			=> $data->pil_a,
					'pil_b'			=> $data->pil_b,
					'pil_c'			=> $data->pil_c,
					'pil_d'			=> $data->pil_d,
					'jawaban' 		=> $data->kunci_jawab,
					'tipe' 	 		=> $data->nama_tipe,
					'action' 		=> '<div class="btn-group">
										<button id="btn-ubah" type="button" class="btn btn-warning btn-sm" 
														data-id="' 			. $data->id_soal 	. '"
														data-kode="' 		. $data->id_audio 	. '"
														data-audio="' 		. $data->audio 		. '"
														data-gambar="' 		. $data->gambar 	. '" 
														data-pertanyaan="' 	. $data->pertanyaan . '"
														data-pil_a="' 		. $data->pil_a 		. '"
														data-pil_b="' 		. $data->pil_b 		. '"
														data-pil_c="' 		. $data->pil_c 		. '"
														data-pil_d="' 		. $data->pil_d 		. '"
														data-jawaban="' 	. $data->kunci_jawab. '"
														data-tipe="' 		. $data->nama_tipe 	. '"
														data-id_kategori="' . $data->id_kategori. '"
														><i class="fa fa-edit"></i></button></br>' .
								  		' <button id="btn-hapus" type="button" class="btn btn-danger btn-sm"
								  						data-id="' 			. $data->id_soal 	. '" 
														data-kode="' 		. $data->id_audio 	. '"
														data-audio="' 		. $data->audio 		. '"
														data-gambar="' 		. $data->gambar 	. '" 
														data-pertanyaan="' 	. $data->pertanyaan . '"
														data-pil_a="' 		. $data->pil_a 		. '"
														data-pil_b="' 		. $data->pil_b 		. '"
														data-pil_c="' 		. $data->pil_c 		. '"
														data-pil_d="' 		. $data->pil_d 		. '"
														data-jawaban="' 	. $data->kunci_jawab. '"
														data-tipe="' 		. $data->nama_tipe 	. '"
														><i class="fa fa-trash-o"></i></button>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 		=> $hasil
			);
		echo json_encode($result);
	}

	public function tambah()
	{

		//inisialisasi variabel
		$status = false;
		$image  = '';
		$audio  = '';
		$status_image = false;
		$status_audio = false;
		$file_name = '';
		$file_name_audio = '';
		$riwayat_audio = false;

		//kondisi untuk validasi form
		if ($_POST['pil_a'] <> '') {

			//config untuk upload audio
			$config2['upload_path']          = './assets/soal_assets/audio/';
			$config2['allowed_types']        = 'mp3|wma|wav';
			$config2['max_size']             = 100000;
			//rename nama file
			$config2['file_name']             = $this->simulasi_listening_model->buat_kd_audio();
			$this->load->library('upload', $config2);

			//kondisi jika aku memilih combo box variabel audio statusnya true untuk dipakai kondisi bawahnya
			if (isset($_POST['list_audio'])) {
				if ($_POST['list_audio'] <> 'xxx') {
				$riwayat_audio = true;
				
				}
			}
			
			//kondisi ketika tidak upload audio dan memilih combo box, karena audio wajib
			if ( ! $this->upload->do_upload('audio') && $riwayat_audio == false){
				//menampilkan pesan error audio
				$audio = $this->upload->display_errors();
				//kondisi jika memilih combo box
			}elseif($riwayat_audio == true){
				//status akan menjadi true dan set nama audio berdasarkan combo box yang dipilih
				$status_audio = true;
				$file_name_audio = $_POST['list_audio'];
			
				//config untuk image
				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']             = $this->simulasi_listening_model->buat_id();

				$this->upload->initialize($config);

				//kondisi jika tidak meng upload image tapi memilih audio jadi status true, karena image tidak wajib
				if ( ! $this->upload->do_upload('pic')){
					$status_image = true;

				//kondisi jika upload image
				}else{
					$image = $this->upload->data();
					$status_image = true;
					$file_name = base_url().'assets/soal_assets/image/'.$image['file_name'];
				}

			//kondisi ketika upload audio
			} else {
				$audio = $this->upload->data();
				$status_audio = true;
				$file_name_audio = base_url().'assets/soal_assets/audio/'.$audio['file_name'];
			

				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']             = $this->simulasi_listening_model->buat_id();

				$this->upload->initialize($config);


				//ketika tidak upload gambar status true
				if ( ! $this->upload->do_upload('pic')){
					$status_image = true;
				}else{
					$image = $this->upload->data();
					$status_image = true;
					$file_name = base_url().'assets/soal_assets/image/'.$image['file_name'];
				}
			}

			//jika form tidak kosong, maka mengubah status
			$status 	= true;

			//depan nama field database, belakang nama value pada form
			$data 		= array(

				'id_soal' => $this->simulasi_listening_model->buat_id(),
				'id_audio'=> $this->simulasi_listening_model->buat_kd_audio(),
				'gambar'=>$file_name,

				//mengambil post request dari form, tanpa true juga bisa
				'pertanyaan'=>$this->input->post('pertanyaan', TRUE),
				'pil_a'=>$this->input->post('pil_a', TRUE),
				'pil_b'=>$this->input->post('pil_b', TRUE),
				'pil_c'=>$this->input->post('pil_c', TRUE),
				'pil_d'=>$this->input->post('pil_d', TRUE),
				'kunci_jawab'=>$this->input->post('jawaban', TRUE),
				'tipe_soal'=>$this->input->post('tipe', TRUE),
				'kategori'=>'simulasi',
				'status'=>'A'

			);

			$data_audio 		= array(

				'id_audio'	=> $this->simulasi_listening_model->buat_kd_audio(),
				'audio'		=> $file_name_audio,
			);



			//query memanggil fungsi tambah di model
			$query=$this->simulasi_listening_model->tambah('tabel_soal_listening', $data);
			$query=$this->simulasi_listening_model->tambah('tabel_audio', $data_audio);
		} else{
			$status = false;
		}
			//mengubah respon menjadi json agar bisa dibaca ajax
			echo json_encode(array('status'=>$status, 'image'=>$image, 'audio'=>$audio, 'status_image'=>$status_image, 'status_audio'=>$status_audio));
	}
	
	public function edit() {
		{
		//config upload file
		
		$status = false;
		$image  = '';
		$audio  = '';
		$status_image = false;
		$status_audio = false;
		$file_name = '';
		$file_name_audio = '';
		$riwayat_audio = false;
		$nama_gambar = '';
		$nama_audio = '';

		//cek form kosong atau tidak, lebih baik komplit
		if ($_POST['pil_a'] <> '') {

			$config2['upload_path']          = './assets/soal_assets/audio/';
			$config2['allowed_types']        = 'mp3|wma|wav';
			$config2['max_size']             = 100000;
			//rename nama file
			$config2['file_name']             = $this->simulasi_listening_model->buat_kd_audio();
			$this->load->library('upload', $config2);


			if (isset($_POST['list_audio'])) {
				if ($_POST['list_audio'] <> 'xxx') {
				$riwayat_audio = true;
				
				}
			}
			
			//ketika user melakukan upload 'tombol upload file'
			if ( ! $this->upload->do_upload('audio') && $riwayat_audio == false){
				$status_audio = true;
				$status_image = true;
				$nama_gambar = $this->input->post('nama_gambar', TRUE);
				$nama_audio = $this->input->post('nama_audio', TRUE);
			}elseif($riwayat_audio == true){
				$status_audio = true;
				$file_name_audio = $_POST['list_audio'];
			

				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']             = $this->simulasi_listening_model->buat_id();

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('pic')){
					$status_image = true;
					$nama_gambar = $this->input->post('nama_gambar', TRUE);
				}else{
					$image = $this->upload->data();
					$status_image = true;
					$file_name = base_url().'assets/soal_assets/image/'.$image['file_name'];
				}

			/*}elseif ( ! $this->upload->do_upload('audio') && $riwayat_audio == false && $this->input->post('pic', TRUE) <> '') {
				$status_image = true;
				$status_audio = true;
				$nama_audio = $this->input->post('nama_audio', TRUE);

				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']             = $this->simulasi_listening_model->buat_id();

				$this->upload->initialize($config);

					$image = $this->upload->data();
					$file_name = $image['file_name'];*/

			} else {
				$audio = $this->upload->data();
				$status_audio = true;

				$file_name_audio = base_url().'assets/soal_assets/audio/'.$audio['file_name'];
			

				$config['upload_path']          = './assets/soal_assets/image/';
				$config['allowed_types']        = 'jpg|png';
				$config['max_size']             = 5000;
				//rename nama file
				$config['file_name']             = $this->simulasi_listening_model->buat_id();

				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('pic')){
					$status_image = true;
					$nama_gambar = $this->input->post('nama_gambar', TRUE);
				}else{
					$image = $this->upload->data();
					$status_image = true;
					$file_name = base_url().'assets/soal_assets/image/'.$image['file_name'];
				}
			}

			//jika form tidak kosong, maka mengubah status
			$status 	= true;

			if ($nama_gambar <> '') {
				$file_name = $nama_gambar;
			}
			if ($nama_audio <> '') {
				$file_name_audio = $nama_audio;
			}

			//depan nama field database, belakang nama value pada form
			$data 		= array(

				//'id_soal' => $this->simulasi_listening_model->buat_id(),
				//'id_audio'=> $this->simulasi_listening_model->buat_kd_audio(),
				'gambar'=>$file_name,

				//mengambil post request dari form, tanpa true juga bisa
				'pertanyaan'=>$this->input->post('pertanyaan', TRUE),
				'pil_a'=>$this->input->post('pil_a', TRUE),
				'pil_b'=>$this->input->post('pil_b', TRUE),
				'pil_c'=>$this->input->post('pil_c', TRUE),
				'pil_d'=>$this->input->post('pil_d', TRUE),
				'kunci_jawab'=>$this->input->post('jawaban', TRUE),
				'tipe_soal'=>$this->input->post('tipe', TRUE),
				'kategori'=>'simulasi',
				'status'=>'A'

			);

			$data_audio 		= array(

				//'id_audio'	=> $this->simulasi_listening_model->buat_kd_audio(),
				'audio'		=> $file_name_audio,
			);



			//query memanggil fungsi tambah di model
			$query=$this->simulasi_listening_model->edit('tabel_soal_listening', $data, $this->input->post('id_soal', TRUE));
			$query=$this->simulasi_listening_model->edit_audio('tabel_audio', $data_audio, $this->input->post('id_audio', TRUE));
		} else{
			$status = false;
		}
			//mengubah respon menjadi json agar bisa dibaca ajax
			echo json_encode(array('status'=>$status, 'image'=>$image, 'audio'=>$audio, 'status_image'=>$status_image, 'status_audio'=>$status_audio));
	}
	}
	
	public function hapus($id) {
		$hapus 				= $this->simulasi_listening_model->hapus($id);
		$msg 				= false;
		if ($hapus) {
			$msg 			= true;
		}
		echo json_encode($msg);
	}

}
?>