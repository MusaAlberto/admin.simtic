<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		if ($this->session->userdata('id_login')== Null) {
			$this->load->view('login');
		} else {
			$QueryKu		= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
			$QueryKu		= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('0');");
			
			$this->load->view('dashboard');
		}
	}

	public function login() {
		$email 		= $_POST['email'];
		$pass 		= $_POST['pass'];
		$QuerySaya	= $this->db->query(
			"SELECT * FROM tbl_admin 
			WHERE email='$email' AND password='$pass';"		
		);
		if ($QuerySaya->num_rows() == 0) {
			$this->load->view('login');
		} else {
			$data 		= $QuerySaya->row();
			$this->session->set_userdata('id_login', 		$data->id_admin);
			$this->session->set_userdata('email_user', 		$data->email);
			$this->session->set_userdata('level_user', 		$data->level_user);
			redirect(base_url('dashboard'));
		}
		
	}

	public function profile($id){
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='' WHERE status_menu<>'1';");
		$QueryKu			= $this->db->query("UPDATE menu_sidebar SET status_menu='active' WHERE kd_menu IN ('1','208');");
		$data['profile']	= $this->user_model->getData($id);
		$this->load->view('master/profile', $data);
	}

	public function update() {
		if (isset($_POST['email']) || isset($_POST['passsword'])) {
			$edit 				= $this->user_model->update(
				$_POST['id'],
				$_POST['nip'],
				$_POST['nama'],
				$_POST['alamat'],
				$_POST['no_telp'],
				$_POST['email'],
				$_POST['password']
			);
			$msg 				= false;
			if ($edit) {
				$msg 			= true;
			}
			echo json_encode($msg);
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->load->view('login');
	}
}
