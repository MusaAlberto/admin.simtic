<?php
class simulasi_reading_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_soal) AS id_max 
						  FROM tabel_soal_reading;"
						);
		$id				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $id){
				$id 	= str_pad((((int)$id->id_max)+1), 5, "0", STR_PAD_LEFT);
			}
		} else {
			$id 		= "00001";
		}
		return $id;
	}

	public function buat_kd() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(kode_soal) AS kd_max 
						  FROM tabel_soal_reading;"
						);
		$kd				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $kd){
				$kode   = substr($kd->kd_max, -4);
				$kd 	= "R".str_pad((($kode)+1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kd 		= "NULL";
		}
		return $kd;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT tabel_soal_reading.*, tabel_kategori.kode_kategori as kd_kategori , tabel_kategori.nama_kategori as nama_kategori FROM tabel_soal_reading JOIN tabel_kategori ON tabel_soal_reading.tipe_soal = tabel_kategori.kode_kategori WHERE status<>'D' AND kategori='simulasi';"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_reading
						  WHERE id_soal='$id' AND status<>'D';"
						);
		return $QuerySaya->result();
	}

	public function tambah( $id, $kode, $gambar, $pertanyaan, $pil_a, $pil_b, $pil_c, $pil_d, $jawaban, $tipe) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tabel_soal_reading
						  (id_soal, kode_soal, gambar, pertanyaan, pil_a, pil_b, pil_c, pil_d, kunci_jawab, tipe_soal, kategori, status) 
						  VALUES 
						  ('$id', '$kode', '$gambar', '$pertanyaan', '$pil_a', '$pil_b', '$pil_c', '$pil_d', '$jawaban', '$tipe', 'simulasi', 'A');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $gambar, $pertanyaan, $pil_a, $pil_b, $pil_c, $pil_d, $jawaban, $tipe) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_soal_reading
						  SET gambar='$gambar', pertanyaan='$pertanyaan', pil_a='$pil_a', pil_b='$pil_b', pil_c='$pil_c', pil_d='$pil_d', kunci_jawab='$jawaban', tipe_soal='$tipe'
						  WHERE id_soal='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_soal_reading
						  SET status='D'
						  WHERE id_soal='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function getKategori(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_kategori WHERE jenis_soal='Reading' ORDER BY id_kategori;"
						);
		return $QuerySaya->result();
    }

}
