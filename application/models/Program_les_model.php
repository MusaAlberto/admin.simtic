<?php
class Program_les_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_program_les ORDER BY id_program_les"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_program_les 
						  WHERE id_program_les='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($kode, $program_les) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_program_les
						  (kode_program, program_les)
						  VALUES 
						  ('$kode', '$program_les');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $kode, $program_les) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_program_les
						  SET kode_program='$kode', program_les='$program_les' 
						  WHERE id_program_les='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_program_les
						  WHERE id_program_les='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
