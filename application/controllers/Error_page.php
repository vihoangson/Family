<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_page extends CI_Controller {

	public function __construct(){
		parent::__construct();

	}
	public function no_allow(){
		$this->load->view('errors/no_allow');
	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */