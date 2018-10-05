<?php
class Profile_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function update( $id, $nip, $nama, $alamat, $no_hp, $email, $password) {
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

	public function getData($id) {
		$QuerySaya 		= $this->db->query(
						  "SELECT * FROM tabel_dosen WHERE id_dosen = '$id';"
						);
		return $QuerySaya->row();
	}



}

?>