<?php
class Mahasiswa_model extends CI_Model {

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
						  "SELECT tabel_peserta.*, tabel_jurusan.id_jurusan as id_jur, tabel_prodi.id_prodi as id_prod, tabel_jurusan.nama as nama_jurusan, tabel_prodi.nama as nama_prodi FROM tabel_peserta JOIN tabel_jurusan ON tabel_peserta.jurusan = tabel_jurusan.id_jurusan JOIN tabel_prodi ON tabel_peserta.prodi = tabel_prodi.id_prodi WHERE level_user = 'mahasiswa' AND status_peserta <>'D' ORDER BY kode_peserta"
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
		
	public function tambah( $id, $kode, $nama, $kelas, $nim,  $prodi, $jurusan, $no_telp, $alamat, $foto, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "INSERT INTO tabel_peserta
						  (id_peserta, kode_peserta, nama, kelas, nim, prodi, jurusan, nama_institusi, no_telp, alamat, foto, email, password, level_user, status_peserta) 
						  VALUES 
						  ('$id', '$kode', '$nama', '$kelas', '$nim', '$prodi', '$jurusan', 'Politeknik Negeri Semarang', '$no_telp', '$alamat', '$foto', '$email', '$password', 'mahasiswa', 'A');"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}
		
	public function edit( $id, $nama, $kelas, $nim, $prodi, $jurusan, $no_telp, $alamat, $foto, $email, $password) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_peserta
						  SET nama='$nama', kelas='$kelas', nim='$nim', prodi='$prodi', jurusan='$jurusan', no_telp='$no_telp', alamat='$alamat', foto='$foto', email='$email', password='$password' 
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

	public function getJurusan(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_jurusan ORDER BY id_jurusan;"
						);
		return $QuerySaya->result();
    }

    public function getProdi($id){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_prodi WHERE id_jurusan = '$id';"
						);
		return $QuerySaya->result();
    }
}
