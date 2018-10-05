<?php
class Dosen_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_dosen) AS id_max 
						  FROM tabel_dosen;"
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
						  "SELECT MAX(kode_dosen) AS kd_max 
						  FROM tabel_dosen;"
						);
		$kd				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $kd){
				$kode   = substr($kd->kd_max, -4);
				$kd 	= "D".str_pad((($kode)+1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kd 		= "NULL";
		}
		return $kd;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_dosen WHERE level_user = 'dosen' AND status_dosen <>'D' ORDER BY kode_dosen"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_dosen 
						  WHERE id_dosen='$id' AND status_dosen<>'D';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah( $id, $kode, $nip, $nama, $alamat, $no_hp, $email, $password) {
		//$kode_toko		= $this->session->userdata('id_toko_modern');
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tabel_dosen
						  (id_dosen, kode_dosen, nip, nama_dosen, alamat, no_hp, email, password, status_dosen, level_user) 
						  VALUES 
						  ('$id', '$kode', '$nip', '$nama', '$alamat', '$no_hp', '$email', '$password', 'A', 'dosen');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nip, $nama, $alamat, $no_hp, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_dosen
						  SET nip='$nip', nama_dosen='$nama', alamat='$alamat', no_hp='$no_hp', email='$email', password='$password' 
						  WHERE id_dosen='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_dosen
						  SET status_dosen='D'
						  WHERE id_dosen='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
