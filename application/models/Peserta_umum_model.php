<?php
class Peserta_umum_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_peserta) AS id_max 
						  FROM tabel_peserta;"
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
						  "SELECT MAX(kode_peserta) AS kd_max 
						  FROM tabel_peserta;"
						);
		$kd				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $kd){
				$kode   = substr($kd->kd_max, -4);
				$kd 	= "P".str_pad((($kode)+1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kd 		= "NULL";
		}
		return $kd;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_peserta WHERE level_user = 'umum' AND status_peserta <>'D' ORDER BY kode_peserta"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_peserta 
						  WHERE id_peserta='$id' AND status_peserta<>'D';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nama, $institusi, $no_telp, $alamat, $foto, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tabel_peserta
						  (id_peserta, kode_peserta, nama, nama_institusi, no_telp, alamat, foto, email, password, level_user, status_peserta) 
						  VALUES 
						  ('$id', '$kode', '$nama', '$institusi', '$no_telp', '$alamat', '$foto', '$email', '$password', 'umum', 'A');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama, $institusi, $no_telp, $alamat, $foto, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_peserta
						  SET nama='$nama', nama_institusi='$institusi', no_telp='$no_telp', alamat='$alamat', foto='$foto', email='$email', password='$password' 
						  WHERE id_peserta='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_peserta
						  SET status_peserta='D'
						  WHERE id_peserta='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
