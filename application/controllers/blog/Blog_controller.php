<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Blog');
		$this->load->model('BlogComment');
		
	}

	public function index(){
		$rs = $this->Blog->with_blogcomment()->get_all();
		$this->load->view('blog/index',compact("rs"));
	}

	public function detail($id=null){
		$id = (int)$id;
		$rs = $this->Blog->with_blogcomment("order_by:id,desc")->get($id);
		$this->load->view('blog/detail',compact("rs"));
	}

	public function create(){
		if($this->input->post()){
			$blog_title   = $this->input->post("title");
			$blog_content = $this->input->post("content");
			$object = [
				"blog_title"   => $blog_title,
				"blog_content" => $blog_content,
			];
			if($this->Blog->insert($object)){
				$this->session->set_flashdata('alert', 'Đã ok');
			}else{
				$this->session->set_flashdata('alert', 'Đã fail');
			}
			redirect('/blog','refresh');
		}
		$this->load->view('blog/input');
	}
}

/* End of file Blog_controller.php */
/* Location: ./application/controllers/blog/Blog_controller.php */