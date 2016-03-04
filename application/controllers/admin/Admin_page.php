<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends MY_Controller {

	public function index()
	{
		$this->load->view('admin/admin_page');
	}

	public function session_login(){
		$rs = $this->db->where("archive_key like 'login_%' ")->get('archive')->result();
		$this->load->view('admin/session_login' , compact("rs"));
	}

}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */