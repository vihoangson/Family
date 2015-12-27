<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	private function init_mardown(){
		$this->path_file = FCPATH."asset/data_note/";
		$this->file_name = $this->path_file."file.markdown.php";
		$this->prepear_file();
	}

	private function prepear_file(){
		if(!is_dir($this->path_file)){
			if(mkdir($this->path_file)){
				$this->session->set_flashdata('item', ["danger"=>"Không set được"]);
				redirect('/','refresh');
			}
		}
		$mod = substr(sprintf('%o', fileperms($this->path_file)), -4);
		if($mod!="0777"){
			if(!chmod($this->path_file, "0777")){
				$this->session->set_flashdata('item', ["danger"=>"Không set được file"]);
				redirect('/','refresh');
			}
		}
		if(!file_exists($this->file_name)){
			file_put_contents($this->file_name,"");
		}
	}

	public function index()
	{
		redirect('/admin/daily_controller/show_markdown','refresh');
	}

	public function edit(){
		redirect('/admin/daily_controller/edit_markdown','refresh');
	}

	public function show_markdown()
	{
		$this->init_mardown();
		$this->load->view('admin/daily', ["file"=>$this->file_name,"path_text"=>$this->path_file,"markdown"=>true] );
	}

	public function edit_markdown(){
		$this->init_mardown();
		$html = $this->input->post("html");
		if(!empty($html)){
			$postedHTML = ($html); // You want to make this more secure!
			if(file_put_contents($this->file_name, $postedHTML)){
				redirect('/admin/daily_controller/show_markdown','refresh');
			}
		}
		$this->load->view('admin/daily_edit', ["file"=>$this->file_name,"path_text"=>$this->path_file,"markdown"=>true] );
	}
}

/* End of file Daily_controller.php */
/* Location: ./application/controllers/admin/Daily_controller.php */