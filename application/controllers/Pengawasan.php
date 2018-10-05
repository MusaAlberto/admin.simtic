<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengawasan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('pengawasan_model');
	}

	public function index() {
		$this->load->view('monitoring/pengawasan');
	}

	public function lab1(){
		$this->load->view('monitoring/ruang1');
	}

}

?>