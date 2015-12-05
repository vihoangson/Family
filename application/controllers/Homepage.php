<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('kyniem');
	}

	public function index()
	{
		$kn = $this->kyniem->getAll();
		$this->load->view('homepage',["kn" => $kn]);
	}

	public function login(){
		$flag = false;
		if($this->input->post('username') && $this->input->post('password')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($username=="admin" && $password =="admin"){
				$array = array(
					'user' => $username
				);
				$flag = true;
				$this->session->set_userdata( $array );
			}
		}
		if(!$flag){
			$this->load->view('login');	
		}else{
			redirect(base_url(),'refresh');
		}
	}

	public function logout(){
		$this->session->unset_userdata('user');
		redirect('/','refresh');
	}

	public function setting(){
		$this->load->view('setting');
	}

	public function ajax_add_new(){
		$data = [
			"kyniem_title" => $this->input->post("title"),
			"kyniem_content" => $this->input->post("content"),
			"kyniem_create" => date("Y-m-d h:i:s",time()),
			"kyniem_modifie" => date("Y-m-d h:i:s",time()),
		];
		if($this->db->insert('kyniem', $data)){
			echo 1;
		}else{
			echo 0;
		}
		
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */