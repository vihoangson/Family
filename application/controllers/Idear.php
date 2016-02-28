<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idear extends MY_Controller {
	private $max_size_upload_timeline = 800;

	public function __construct(){
		parent::__construct();

	}
	public function index(){
		$rs = $this->db->get('idear')->result();
		$this->load->view('idear/index', compact("rs"));
	}

}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */