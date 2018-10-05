<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('email_user')== Null) {
			redirect ('user/logout');
		}
		$this->load->model('dashboard_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
	}

	public function index() {
		$level = $this->session->userdata('level_user');
		if ($level == 'superadmin') {
			$data['calendar']="calendar1";
		}else if($level == 'admin'){
			$data['calendar']="calendar";
		}else if($level == 'dosen'){
			$data['calendar']="calendar1";
		}
		$this->load->view('dashboard', $data);
	}

	public function get_events()
	{
		 // Our Start and End Dates
		 $start = $this->input->get("start");
		 $end = $this->input->get("end");

		 $startdt = new DateTime('now'); // setup a local datetime
		 $startdt->setTimestamp($start); // Set the date based on timestamp
		 $start_format = $startdt->format('Y-m-d H:i:s');

		 $enddt = new DateTime('now'); // setup a local datetime
		 $enddt->setTimestamp($end); // Set the date based on timestamp
		 $end_format = $enddt->format('Y-m-d H:i:s');

		 $events = $this->dashboard_model->get_events($start_format, $end_format);

		 $data_events = array();

		 foreach($events->result() as $r) {

		     $data_events[] = array(
		         "id" 			=> $r->id_jadwal,
		         "title" 		=> $r->nama_event,
		         "description" 	=> $r->nama_ruang,
		         "kuota" 		=> $r->kuota,
		         "end" 			=> $r->end,
		         "start" 		=> $r->start
		     );
		 }

		 echo json_encode(array("events" => $data_events));
		 exit();
	}

	public function add_event() 
	{
	    /* Our calendar data */
	    $name = $this->input->post("name_add", TRUE);
	    $desc = $this->input->post("description_add", TRUE);
	    $kuota = $this->input->post("kuota_add", TRUE);
	    $start_date = $this->input->post("start_date_add", TRUE);
	    $end_date = $this->input->post("end_date_add", TRUE);
	  

	    if(!empty($start_date)) {
	       $sd = DateTime::createFromFormat("Y/m/d H:i", $start_date);
	       $start_date = $sd->format('Y-m-d H:i:s');
	       $start_date_timestamp = $sd->getTimestamp();
	    } else {
	       $start_date = date("Y-m-d H:i:s", time());
	       $start_date_timestamp = time();
	    }

	    if(!empty($end_date)) {
	       $ed = DateTime::createFromFormat("Y/m/d H:i", $end_date);
	       $end_date = $ed->format('Y-m-d H:i:s');
	       $end_date_timestamp = $ed->getTimestamp();
	    } else {
	       $end_date = date("Y-m-d H:i:s", time());
	       $end_date_timestamp = time();
	    }

	    $this->dashboard_model->add_event(array(
			"id_jadwal" 		=> $this->dashboard_model->buat_id(),
	        "nama_event"		=> $name,
	        "nama_ruang" 		=> $desc,
	        "kuota"		 		=> $kuota,
	        "start" 			=> $start_date,
	        "end" 				=> $end_date
	       )
	    );

	    redirect(base_url("dashboard"));
	}

	public function edit_event()
	{
	  $eventid = intval($this->input->post("eventid"));
	  $event = $this->dashboard_model->get_event($eventid);
	  if($event->num_rows() == 0) {
	       echo"Invalid Event";
	       exit();
	  }

	  $event->row();

	  /* Our calendar data */
	  $name 		= $this->input->post("name_edit");
	  $desc 		= $this->input->post("description_edit");
	  $kuota 		= $this->input->post("kuota_edit");
	  $start_date 	= $this->input->post("start_date_edit");
	  $end_date 	= $this->input->post("end_date_edit");
	  $delete 		= intval($this->input->post("delete"));

	  if(!$delete) {

	       if(!empty($start_date)) {
	            $sd = DateTime::createFromFormat("Y/m/d H:i", $start_date);
	            $start_date = $sd->format('Y-m-d H:i:s');
	            $start_date_timestamp = $sd->getTimestamp();
	       } else {
	            $start_date = date("Y-m-d H:i:s", time());
	            $start_date_timestamp = time();
	       }

	       if(!empty($end_date)) {
	            $ed = DateTime::createFromFormat("Y/m/d H:i", $end_date);
	            $end_date = $ed->format('Y-m-d H:i:s');
	            $end_date_timestamp = $ed->getTimestamp();
	       } else {
	            $end_date = date("Y-m-d H:i:s", time());
	            $end_date_timestamp = time();
	       }

	       $this->dashboard_model->update_event($eventid, array(
	            "nama_event"		 => $name,
	            "nama_ruang"	 => $desc,
	            "kuota" 		 => $kuota,
	            "start" 		 => $start_date,
	            "end" 			 => $end_date,
	            )
	       );

	  } else {
	       $this->dashboard_model->delete_event($eventid);
	  }

	  redirect(base_url("dashboard"));
	}

}

?>