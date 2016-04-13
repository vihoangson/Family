<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_view_controller extends CI_Controller {

	public function index()
	{
		$this->load->view('template_view');
	}

}

/* End of file template_view_controller.php */
/* Location: ./application/controllers/template_view_controller.php */