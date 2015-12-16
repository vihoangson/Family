<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Timeline_model');
	}

	public function index()
	{
		$condition = [];
		$tl = $this->Timeline_model->getAll($condition);
		$data = [
			"tl" => $tl
		];
		$this->load->view('timeline/show_list', $data);
	}

	public function edit($id = null){
		if($id){
			$rs = $this->Timeline_model->getById($id);
		}
		if($this->input->post()){
			$upload = $this->do_upload();
			if($id){
				$data["id"] = $id;
			}
			$data["timeline_image"] = $upload["file_name"];
			$data["timeline_title"] = set_value("timeline_title");
			$data["timeline_date"] = set_value("timeline_date");
			$data["timeline_tag"] = set_value("timeline_tag");
			$data["timeline_note"] = set_value("timeline_note");
			$this->Timeline_model->save($data);
		}
		$this->load->view('timeline/timeline_edit',["rs"=>$rs]);
	}

	private function do_upload()
	{
		$this->load->library('upload');
		$files                          = $_FILES;
		$_FILES['userfile']['name']     = $files['timeline_image']['name'];
		$_FILES['userfile']['type']     = $files['timeline_image']['type'];
		$_FILES['userfile']['tmp_name'] = $files['timeline_image']['tmp_name'];
		$_FILES['userfile']['error']    = $files['timeline_image']['error'];
		$_FILES['userfile']['size']     = $files['timeline_image']['size'];

		$this->upload->initialize($this->set_upload_options());
		if($this->upload->do_upload()){
			$return = $this->upload->data();
			$this->session->set_flashdata('item',["success"=>"Đã upload thành công"]);
		}else{
			$this->session->set_flashdata('item',["danger"=>$this->upload->display_errors()]);
		}
		return $return;
	}
	private function set_upload_options()
	{
		$config = array();
		$config['upload_path'] = 'asset/images/timeline/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '102400';
		$config['max_height']  = '76800';
		$config['overwrite']     = FALSE;
		return $config;
	}

	public function add_picture(){
		$this->load->view('timeline/add_picture');
	}

}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */