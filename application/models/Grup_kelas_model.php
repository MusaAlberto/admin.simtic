<?php
class Grup_kelas_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_grup_kelas ORDER BY id_kelas"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_grup_kelas 
						  WHERE id_kelas='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($tentor, $nama_kelas, $jadwal, $jenis_les) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_grup_kelas
						  (id_tentor, nama_kelas, jadwal, id_jenis_les)
						  VALUES 
						  ('$tentor', '$nama_kelas', '$jadwal', '$jenis_les');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $tentor, $nama_kelas, $jadwal, $jenis_les) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_grup_kelas
						  SET id_tentor='$tentor', nama_kelas='$nama_kelas', jadwal='$jadwal', id_jenis_les='$jenis_les' 
						  WHERE id_kelas='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_grup_kelas
						  WHERE id_kelas='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
