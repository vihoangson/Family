<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idear extends MY_Controller {
	private $max_size_upload_timeline = 800;
	public function __construct(){
		parent::__construct();
		$this->load->library('image_lib');
		if(!$this->db->table_exists("idear")){
			$this->db->query("CREATE TABLE 'idear' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'idear_title' TEXT, 'idear_content' TEXT, 'idear_img' TEXT, 'idear_create' TEXT);");
		}
	}
	public function index(){
		$rs = $this->db->get('idear')->result();
		$this->load->view('idear/index', compact("rs"));
	}

	public function edit(){
		if($this->input->post()){
			$ul = $this->do_upload();
			foreach ($ul["success"] as $key => $value) {
				$img[] = $value["file_name"];
			}
			$json_img = json_encode($img);
			$object=[
				"idear_title"   => $this->input->post("txt_title"),
				"idear_content" => $this->input->post("txt_content"),
				"idear_img"     => $json_img,
				"idear_create"  => date("Y-m-d h:i:s",time()),
			];
			if($this->db->insert('idear', $object)){
				$this->session->set_flashdata('alert', 'Đã lưu idear');
				redirect('/idear','refresh');
			}else{

			}
		}
		$this->load->view('idear/edit');
	}

	private function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = 'asset/images/idear/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '102400';
		$config['max_height']  = '76800';
		$config['overwrite']     = FALSE;
		return $config;
	}

	private function do_upload()
	{
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$error = [];
		$success = [];
		for($i=0; $i<$cpt; $i++){
			preg_match("/\.(\w+)$/", $files['userfile']['name'][$i],$match);
			$_FILES['userfile']['name']     = time().".".$match[1];
			$_FILES['userfile']['type']     = $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']    = $files['userfile']['error'][$i];
			$_FILES['userfile']['size']     = $files['userfile']['size'][$i];    
			$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload()){
				$img_info = $this->upload->data();
				$success[] = $this->upload->data();
				$this->resize_img(FCPATH."asset/images/idear/".$img_info['file_name'],100,100);
			}else{
				$error[] = $this->upload->display_errors();
			}
		}
		return ["error" => $error, "success" => $success];
	}

	private function resize_img($path,$width,$height){
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['new_image'] = FCPATH."asset/images/idear/thumb/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$config['height']       = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();	
	}
}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */