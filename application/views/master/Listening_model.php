<?php
class Listening_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function getKategori(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_kategori WHERE jenis_soal = 'Listening' ORDER BY id_kategori"
						); 
		return $QuerySaya->result();
	}

	public function ins_ans_list($id_soal,$id_user,$pilihan){
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO temp_ans_list
						  (id_soal, id_user, ans_list) 
						  VALUES 
						  ('$id_soal','$id_user','$pilihan');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function part_one(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE kategori = 'ujian' AND status <>'D' AND tipe_soal = 1 ORDER BY id_soal"
						); 
		return $QuerySaya->result();
	}

	public function part_two(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE kategori = 'ujian' AND status <>'D' AND tipe_soal = 2 ORDER BY id_soal"
						); 
		return $QuerySaya->result();
	}

	public function part_three(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE kategori = 'ujian' AND status <>'D' AND tipe_soal = 3 ORDER BY id_soal"
						); 
		return $QuerySaya->result();
	}

	public function part_four(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE kategori = 'ujian' AND status <>'D' AND tipe_soal = 4 ORDER BY id_soal"
						); 
		return $QuerySaya->result();
	}

	public function cekJawaban($id_soal, $jawaban){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening WHERE id_soal = '$id_soal' AND kunci_jawab == '$jawaban' ORDER BY id_soal"
						); 
		return $QuerySaya->result();
	}
}
