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


	private function do_upload()
	{       
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$error = [];
		$success = [];
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

			$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload()){
				$success[] = $this->upload->data();
			}else{
				$error[] = $this->upload->display_errors();
			}
		}
		return ["error" => $error, "success" => $success];
		
	}

	private function set_upload_options()
	{   
	    //upload an image options
		$config = array();
		$config['upload_path'] = 'asset/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '102400';
		$config['max_height']  = '76800';
		$config['overwrite']     = FALSE;
		return $config;
	}

	public function add_new(){
		$ul = $this->do_upload();
		if($ul["error"]){
			$this->session->set_flashdata('error_upload', $error);
		}
		foreach ($ul["success"] as $key => $value) {
			$file[] = $value["file_name"];
		}

		$data = [
			"kyniem_title" => $this->input->post("title"),
			"kyniem_content" => $this->input->post("content"),
			"kyniem_auth" => $this->input->post("kyniem_auth"),
			"kyniem_create" => date("Y-m-d h:i:s",time()),
			"kyniem_modifie" => date("Y-m-d h:i:s",time()),
		];
		if($file){
			$data["kyniem_images"] = json_encode($file);
		}
		if($this->db->insert('kyniem', $data)){
			redirect('/','refresh');
		}else{
			echo 0;
		}
		
	}

	public function delete_kyniem($id){
		$this->kyniem->delete_kyniem($id);
		redirect('/','refresh');
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */