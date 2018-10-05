<?php
class kategori_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_kategori) AS id_max 
						  FROM tabel_kategori;"
						);
		$id				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $id){
				$id 	= str_pad((((int)$id->id_max)+1), 6, "0", STR_PAD_LEFT);
			}
		} else {
			$id 		= "00001";
		}
		return $id;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_kategori ORDER BY id_kategori;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_kategori 
						  WHERE id_kategori='$id'"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nama, $jenis) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tabel_kategori (id_kategori, kode_kategori, nama_kategori, jenis_soal) 
						  VALUES ('$id', '$kode', '$nama', '$jenis');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $nama, $jenis) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_kategori
						  SET kode_kategori='$kode', nama_kategori='$nama', jenis_soal='$jenis'
						  WHERE id_kategori='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tabel_kategori WHERE id_kategori='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
