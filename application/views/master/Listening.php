<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listening extends CI_Controller {

	public	$benar 		= 0;
	public	$salah 		= 0;
	public	$kosong 	= 0;
	public	$score 		= 0;

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('id_peserta')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('listening_model');
		$this->load->library('pagination');
		$this->load->helper('url'); 
	}



	public function ans_temp_list(){
		$id_soal		= $_POST['id_soal'];
		$id_user		= $_POST['id_user'];
		$pilihan		= $_POST['pil'];

		for ($i=0; $i < 100; $i++) { 
			$id 	= $id_soal[$i];
			$jawaban= $pilihan[$id];
			$cek			= $this->db->query(
						"SELECT * FROM temp_ans_list 
						WHERE id_soal='$id' AND id_user='$id_user';"		
					);
			if ($cek->num_rows() == 0) {
				$this->listening_model->ins_ans_list(
					$id,
					$id_user,
					$jawaban
				);
			} 
		}

		redirect('http://localhost/simtic.user/reading/tes'); 
		/*foreach ($ids['id_soal'] as $key => $id) {
			$data[] = array('id_soal' => $id);
		}
		$this->db->insert_batch('temp_ans_list', $data);*/
	}

	public function index() {
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','7');");

		$this->load->view('master/view_listening');
	}

	public function tes(){
		$data['audio']							= $this->db->get('tabel_soal_listening');
		$data['part']							= $this->listening_model->getKategori();
		$data['photograph']						= $this->listening_model->part_one();
		$data['questions_response']				= $this->listening_model->part_two();
		$data['conversations']					= $this->listening_model->part_three();
		$data['short_talks']					= $this->listening_model->part_four();
		$this->load->view('master/view_listening', $data);
	}

	public function cekJawaban(){
		$id_soal 	= $_POST['id_soal'];
		$pilihan 	= $_POST['pil'];
		$jumlah  	= $_POST['jumlah'];



		for ($i=0; $i < $jumlah; $i++) { 
			$nomor = $id_soal[$i];

			if (empty($jawaban[$nomor])) {
				$kosong++;
				echo json_encode($kosong);
			}else{
				$pilihan[$nomor];

				$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE id_soal = '$id_soal' AND kunci_jawab == '$pilihan' ORDER BY id_soal"
						); 
				if ($QuerySaya->num_rows() == 0) {
					$salah++;
				}else{
					$benar++;
				}
			}
		}

		$this->set_userdata('benar', $benar);
	}
}
