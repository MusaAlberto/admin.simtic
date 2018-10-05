<?php
class Hasil_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, c.nama as nama_jur, d.nama as nama_prod FROM tabel_peserta as a INNER JOIN tabel_hasil as b ON a.kode_peserta = b.kode_auth LEFT JOIN tabel_jurusan as c ON a.jurusan = c.id_jurusan LEFT JOIN tabel_prodi as d ON a.prodi = d.id_prodi ORDER BY tgl_tes DESC;"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM 
						  tabel_peserta 
						  WHERE id_peserta='$id' AND status_peserta<>'D';"
						);
		return $QuerySaya->result();
	}

	public function lihat($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT *, tabel_peserta.nama as nama_peserta, tabel_jurusan.nama as nama_jurusan, tabel_prodi.nama as nama_prodi FROM tabel_peserta JOIN tabel_hasil ON tabel_peserta.kode_peserta = tabel_hasil.kode_auth LEFT JOIN tabel_jurusan ON tabel_peserta.jurusan = tabel_jurusan.id_jurusan LEFT JOIN tabel_prodi ON tabel_peserta.prodi = tabel_prodi.id_prodi WHERE kode_peserta = '$id';"
						);

		return $QuerySaya->row();
	}

	public function ujian($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_hasil WHERE kode_auth = '$id' AND jenis_tes = 'ujian';"
						);

		return $QuerySaya->row();
	}

	public function simulasi($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_hasil WHERE kode_auth = '$id' AND jenis_tes = 'simulasi';"
						);

		return $QuerySaya->row();
	}

	public function cari_umum() {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, c.nama as nama_jur, d.nama as nama_prod FROM tabel_peserta as a INNER JOIN tabel_hasil as b ON a.kode_peserta = b.kode_auth LEFT JOIN tabel_jurusan as c ON a.jurusan = c.id_jurusan LEFT JOIN tabel_prodi as d ON a.prodi = d.id_prodi WHERE a.level_user = 'umum' ORDER BY tgl_tes DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_mahasiswa() {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, c.nama as nama_jur, d.nama as nama_prod FROM tabel_peserta as a INNER JOIN tabel_hasil as b ON a.kode_peserta = b.kode_auth LEFT JOIN tabel_jurusan as c ON a.jurusan = c.id_jurusan LEFT JOIN tabel_prodi as d ON a.prodi = d.id_prodi WHERE a.level_user = 'mahasiswa' ORDER BY tgl_tes DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_jurusan($id_jurusan) {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, c.nama as nama_jur, d.nama as nama_prod FROM tabel_peserta as a INNER JOIN tabel_hasil as b ON a.kode_peserta = b.kode_auth LEFT JOIN tabel_jurusan as c ON a.jurusan = c.id_jurusan LEFT JOIN tabel_prodi as d ON a.prodi = d.id_prodi WHERE a.level_user = 'mahasiswa' AND a.jurusan = '$id_jurusan' ORDER BY tgl_tes DESC;"
						);
		return $QuerySaya->result();
	}

	public function cari_prodi($id_prodi) {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, c.nama as nama_jur, d.nama as nama_prod FROM tabel_peserta as a INNER JOIN tabel_hasil as b ON a.kode_peserta = b.kode_auth LEFT JOIN tabel_jurusan as c ON a.jurusan = c.id_jurusan LEFT JOIN tabel_prodi as d ON a.prodi = d.id_prodi WHERE a.level_user = 'mahasiswa' AND a.prodi = '$id_prodi' ORDER BY tgl_tes DESC;"
						);
		return $QuerySaya->result();
	}

	public function getJurusan(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_jurusan;"
						);
		return $QuerySaya->result();
	}

	public function getProdi(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_prodi;"
						);
		return $QuerySaya->result();
	}

	/*SELECT tabel_peserta.*, tabel_jurusan.nama as nama_jurusan, tabel_prodi.nama as nama_prodi FROM tabel_peserta JOIN tabel_hasil ON tabel_peserta.kode_peserta = tabel_hasil.kode_auth JOIN tabel_jurusan ON tabel_peserta.jurusan = tabel_jurusan.id_jurusan JOIN tabel_prodi ON tabel_peserta.prodi = tabel_prodi.id_prodi;*/
		
}
?>