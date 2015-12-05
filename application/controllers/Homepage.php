<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {

	public function index()
	{
		$this->load->view('homepage');
	}

	public function login(){
		$this->load->view('login');	
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */