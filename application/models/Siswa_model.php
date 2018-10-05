<?php
class Siswa_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_siswa ORDER BY id_siswa"
						); 
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tbl_siswa 
						  WHERE id_siswa='$id';"
						);
		return $QuerySaya->result();
	}
		
	public function tambah($nama_siswa, $nama_ortu, $alamat, $no_telp, $sekolah, $kelas, $program_les, $jenis_les) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tbl_siswa
						  (nama_siswa, nama_ortu, alamat, no_telp, sekolah, kelas, program_les, jenis_les)
						  VALUES 
						  ('$nama_siswa', '$nama_ortu', '$alamat', '$no_telp', '$sekolah', '$kelas', '$program_les', '$jenis_les');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama_siswa, $nama_ortu, $alamat, $no_telp, $sekolah, $kelas, $program_les, $jenis_les) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tbl_siswa
						  SET nama_siswa='$nama_siswa', nama_ortu='$nama_ortu', alamat='$alamat', no_telp='$no_telp', sekolah='$sekolah', kelas='$kelas', program_les='$program_les', jenis_les='$jenis_les' 
						  WHERE id_siswa='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "DELETE FROM tbl_siswa
						  WHERE id_siswa='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
}
