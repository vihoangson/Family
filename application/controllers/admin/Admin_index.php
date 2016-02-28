<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_index extends CI_Controller {

	public function index()
	{
		$this->load->view('admin/admin_index');
	}

}

/* End of file Admin_index.php */
/* Location: ./application/controllers/admin/Admin_index.php */