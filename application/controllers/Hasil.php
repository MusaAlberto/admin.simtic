<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('hasil_model');
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$this->load->view('nilai/hasil');
	}

	public function data() {
		$data					= $this->hasil_model->cari_semua();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama' 			=> $data->nama,
					'nim' 			=> $data->nim,
					'kelas' 		=> $data->kelas,
					'prodi' 		=> $data->nama_prod,
					'jurusan' 		=> $data->nama_jur,
					'institusi' 	=> $data->nama_institusi,
					'kategori' 		=> $data->level_user,
					'tgl_tes'		=> $data->tgl_tes,
					'action' 		=> '<div class="btn-group">
										<a href="'. base_url('hasil/lihat/'). $data->kode_peserta .'"><button type="button" class="btn btn-info btn-xs">Lihat</button>
										</a>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 		=> $hasil
			);
		echo json_encode($result);
	}

	public function lihat($id)
	{
		$data['hasil']			= $this->hasil_model->lihat($id);
		$data['point']			= $this->hasil_model->ujian($id);
		$data['poin']			= $this->hasil_model->simulasi($id);
		$this->load->view('nilai/lihat_nilai', $data);
	}
	
	public function umum() {
		$data					= $this->hasil_model->cari_umum();		
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama' 			=> $data->nama,
					'nim' 			=> $data->nim,
					'kelas' 		=> $data->kelas,
					'prodi' 		=> $data->nama_prod,
					'jurusan' 		=> $data->nama_jur,
					'institusi' 	=> $data->nama_institusi,
					'kategori' 		=> $data->level_user,
					'tgl_tes'		=> $data->tgl_tes,
					'action' 		=> '<div class="btn-group">
										<a href="'. base_url('hasil/lihat/'). $data->kode_peserta .'"><button type="button" class="btn btn-info btn-xs">Lihat</button>
										</a>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 		=> $hasil
			);
		echo json_encode($result);
	}

	public function mahasiswa() {
		$data					= $this->hasil_model->cari_mahasiswa();
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama' 			=> $data->nama,
					'nim' 			=> $data->nim,
					'kelas' 		=> $data->kelas,
					'prodi' 		=> $data->nama_prod,
					'jurusan' 		=> $data->nama_jur,
					'institusi' 	=> $data->nama_institusi,
					'kategori' 		=> $data->level_user,
					'tgl_tes'		=> $data->tgl_tes,
					'action' 		=> '<div class="btn-group">
										<a href="'. base_url('hasil/lihat/'). $data->kode_peserta .'"><button type="button" class="btn btn-info btn-xs">Lihat</button>
										</a>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function cariJurusan($id_jurusan) {
		$data					= $this->hasil_model->cari_jurusan($id_jurusan);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama' 			=> $data->nama,
					'nim' 			=> $data->nim,
					'kelas' 		=> $data->kelas,
					'prodi' 		=> $data->nama_prod,
					'jurusan' 		=> $data->nama_jur,
					'institusi' 	=> $data->nama_institusi,
					'kategori' 		=> $data->level_user,
					'tgl_tes'		=> $data->tgl_tes,
					'action' 		=> '<div class="btn-group">
										<a href="'. base_url('hasil/lihat/'). $data->kode_peserta .'"><button type="button" class="btn btn-info btn-xs">Lihat</button>
										</a>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function cariProdi($id_prodi) {
		$data					= $this->hasil_model->cari_prodi($id_prodi);
		$hasil 					= array();
		$result 				= array();
		$nomor 					= 0;
		foreach ($data as $data) {
			$nomor				= $nomor + 1;
			$hasil[]			= array(
					'no'			=> $nomor,
					'kode' 			=> $data->kode_peserta,
					'nama' 			=> $data->nama,
					'nim' 			=> $data->nim,
					'kelas' 		=> $data->kelas,
					'prodi' 		=> $data->prodi,
					'jurusan' 		=> $data->nama_prod,
					'institusi' 	=> $data->nama_institusi,
					'kategori' 		=> $data->level_user,
					'tgl_tes'		=> $data->tgl_tes,
					'action' 		=> '<div class="btn-group">
										<a href="'. base_url('hasil/lihat/'). $data->kode_peserta .'"><button type="button" class="btn btn-info btn-xs">Lihat</button>
										</a>
										</div>'
				);
		}
		$result 				= array (
				'aaData' 			=> $hasil
			);
		echo json_encode($result);
	}

	public function getJurusan(){
		$data		= $this->hasil_model->getJurusan();
		echo json_encode($data);
	}

	public function getProdi(){
		$data		= $this->hasil_model->getProdi();
		echo json_encode($data);
	}
}
?>