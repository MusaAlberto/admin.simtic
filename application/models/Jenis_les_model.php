<?php
class Jenis_les_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_jenis_les ORDER BY id_jenis_les"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_jenis_les 
						  WHERE id_jenis_les='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($program_les, $jenis_les, $tarif_siswa, $insentif_tentor) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_jenis_les
						  (program_les, jenis_les, tarif_siswa, insentif_tentor)
						  VALUES 
						  ('$program_les', '$jenis_les', '$tarif_siswa', '$insentif_tentor');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $program_les, $jenis_les, $tarif_siswa, $insentif_tentor) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_jenis_les
						  SET program_les='$program_les', jenis_les='$jenis_les', tarif_siswa='$tarif_siswa', insentif_tentor='$insentif_tentor' 
						  WHERE id_jenis_les='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_jenis_les
						  WHERE id_jenis_les='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
