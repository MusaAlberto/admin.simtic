<?php
class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_events($start, $end)
	{
	    return $this->db->where("start >=", $start)->where("end <=", $end)->get("tabel_jadwal");
	}

	public function add_event($data)
	{
	    $this->db->insert("tabel_jadwal", $data);
	}

	public function get_event($id)
	{
	    return $this->db->where("id_jadwal", $id)->get("tabel_jadwal");
	}

	public function update_event($id, $data)
	{
	    $this->db->where("id_jadwal", $id)->update("tabel_jadwal", $data);
	}

	public function delete_event($id)
	{
	    $this->db->where("id_jadwal", $id)->delete("tabel_jadwal");
	}

	public function buat_id() {
		$QuerySaya 		= $this->db->query(
						  "SELECT MAX(id_jadwal) AS id_max 
						  FROM tabel_jadwal;"
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
		
	
}
