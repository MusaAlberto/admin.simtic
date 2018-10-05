<?php
class Staff_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_admin ORDER BY id_admin"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_admin 
						  WHERE id_admin='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($nama, $alamat, $no_telp, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_admin
						  (nama_staff, alamat, no_telp, email, password, level_user)
						  VALUES 
						  ('$nama', '$alamat', '$no_telp', '$email', '$password', 'admin');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit($id, $nama, $alamat, $no_telp, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_admin
						  SET nama_staff='$nama', alamat='$alamat', no_telp='$no_telp', email='$email', password='$password' 
						  WHERE id_admin='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus($id) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_admin
						  WHERE id_admin='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
