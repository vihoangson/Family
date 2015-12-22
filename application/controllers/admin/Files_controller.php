<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('files_model');
		$this->path_file_upload = FCPATH."asset/file_upload/";
	}

	public function index()
	{
		dd($this->dirToArray($this->path_file_upload));
	}


	public function do_upload(){
		if($_FILES["userfile"]){
			if(!is_dir($this->path_file_upload.date("Y"))){
				mkdir($this->path_file_upload.date("Y"));
			}
			if(!is_dir($this->path_file_upload.date("Y")."/".date("m"))){
				mkdir($this->path_file_upload.date("Y")."/".date("m"));
			}
			if(!is_dir($this->path_file_upload.date("Y")."/".date("m")."/".date("d"))){
				mkdir($this->path_file_upload.date("Y")."/".date("m")."/".date("d"));
			}
			$path_file = $this->path_file_upload.date("Y")."/".date("m")."/".date("d");
			@chmod($path_file, 0777);
			if($this->files_model->find(["files_name"=>$_FILES["userfile"]])->num_rows()>0){
				echo 123;
			}
			$config['upload_path'] = $path_file;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '10000';
			$config['max_width']  = '20000';
			$config['max_height']  = '20000';

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload()){
				$error = array('error' => $this->upload->display_errors());
				d($error);
				$this->session->set_flashdata('item', ["danger"=>"Upload có lỗi"]);
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				$object = [
					"files_title" => $this->input->post('file_title'),
					"files_name" => $data["upload_data"]['file_name'],
					"files_path" => $data["upload_data"]['file_path'],
					"files_size" => @$data["upload_data"]['image_size_str'],
					"files_type" => $data["upload_data"]['file_type'],
				];
				try {
					$this->files_model->create($object);
				} catch (Exception $e) {
					dd($e);
				}
				$this->session->set_flashdata('item', ["success"=>"Upload thành công"]);
			}
			redirect('admin/files_controller/do_upload','refresh');
		}

		$rs = $this->files_model->find()->result();
		$this->load->view('admin/form_upload',compact("rs"));
	}

	public function delete($id){
		if($this->files_model->detele($id)){
			redirect('/admin/files_controller/do_upload','refresh');
		}else{
			redirect('404','refresh');
		}
	}

	private function array_values_recursive($array)
	{
		$arrayValues = array();

		foreach ($array as $value)
		{
			if (is_scalar($value) OR is_resource($value))
			{
				$arrayValues[] = $value;
			}
			elseif (is_array($value))
			{
				$arrayValues = array_merge($arrayValues, $this->array_values_recursive($value));
			}
		}
		return $arrayValues;
	}

	private function dirToArray($dir) {

		$result = array();

		$cdir = scandir($dir);
		foreach ($cdir as $key => $value)
		{
			if (!in_array($value,array(".","..")))
			{
				if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
				{
					$result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
				}
				else
				{
					$result[] = $value;
				}
			}
		}

		return $result;
	}

}

/* End of file Files_controller.php */
/* Location: ./application/controllers/admin/Files_controller.php */