<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends MY_Controller {

	public function index()
	{
		redirect('timeline/add_picture','refresh');
	}

	public function add_picture(){
		$this->load->view('timeline/add_picture');
	}

}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */