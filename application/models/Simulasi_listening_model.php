<?php
class Simulasi_listening_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_soal) AS id_max 
						  FROM tabel_soal_listening;"
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
						  "SELECT MAX(id_audio) AS kd_max 
						  FROM tabel_soal_listening;"
						);
		$kd				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $kd){
				$kode   = substr($kd->kd_max, - 4);
				$kd 	= "L".str_pad((($kode) + 1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kd 		= "NULL";
		}
		return $kd;
	}

	public function buat_kd_audio() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_audio) AS kd_max 
						  FROM tabel_audio;"
						);
		$kd				= "";
		if ($QuerySaya->num_rows()>0){
			foreach($QuerySaya->result() as $kd){
				$kode   = substr($kd->kd_max, - 4);
				$kd 	= "L".str_pad((($kode)+1), 4, "0", STR_PAD_LEFT);
			}
		} else {
			$kd 		= "NULL";
		}
		return $kd;
	}
		
	public function cari_semua() {
		$QuerySaya 		= $this->db->query(
						  "SELECT a.*, b.*, tabel_kategori.id_kategori as id_kategori, tabel_kategori.nama_kategori as nama_tipe FROM tabel_soal_listening as a 
						  JOIN tabel_audio as b ON a.id_audio = b.id_audio 
						  JOIN tabel_kategori ON tabel_kategori.id_kategori = a.tipe_soal WHERE status<>'D' AND kategori='simulasi';"
						);
		return $QuerySaya->result();
	}
	
	public function cari_kd( $id ) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_soal_listening 
						  WHERE id_soal='$id' AND status<>'D';"
						);
		return $QuerySaya->result();
	}

	public function riwayat_audio() {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_audio ORDER BY id_audio DESC limit 5;"
						);
		return $QuerySaya->result();
	}

	public function tambah($tabel, $data)
	{
		$query 	= $this->db->insert($tabel, $data);
		
		return $this->db->insert_id();
	}

	public function tambah_audio($tabel, $data)
	{
		$query 	= $this->db->insert($tabel, $data);
		
		return $this->db->insert_id();
	}
		
	public function edit($tabel, $data, $id) {
		$this->db->where('id_soal', $id);
		$this->db->update($tabel, $data);
	}

	public function edit_audio($tabel, $data, $id) {

		$this->db->where('id_audio', $id);
		$this->db->update($tabel, $data);
	}
		
	public function hapus( $id ) {
		$QuerySaya 		= $this->db->query(
						  "UPDATE tabel_soal_listening
						  SET status='D'
						  WHERE id_soal='$id';"
						);
		if ($QuerySaya) {
			return TRUE;
		} else {
			return FALSE;
		};
	}

	public function getKategori(){
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_kategori WHERE jenis_soal='Listening' ORDER BY id_kategori;"
						);
		return $QuerySaya->result();
    }

}
