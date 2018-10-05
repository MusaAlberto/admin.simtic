<?php
class Tentor_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_tentor ORDER BY id_tentor"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_tentor 
						  WHERE id_tentor='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($nama, $alamat, $no_telp, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_tentor
						  (nama_tentor, alamat, no_telp, email, password)
						  VALUES 
						  ('$nama', '$alamat', '$no_telp', '$email', '$password');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama, $alamat, $no_telp, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_tentor
						  SET nama_tentor='$nama', alamat='$alamat', no_telp='$no_telp', email='$email', password='$password' 
						  WHERE id_tentor='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_tentor
						  WHERE id_tentor='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
