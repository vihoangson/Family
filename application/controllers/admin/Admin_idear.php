<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_idear extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('admin/admin_idear', $data, FALSE);
	}
	
}

/* End of file Daily_controller.php */
/* Location: ./application/controllers/admin/Daily_controller.php */