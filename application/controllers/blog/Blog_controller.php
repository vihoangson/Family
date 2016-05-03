<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->install_db();
	}

	private function install_db(){
		if($this->db->query("SELECT name FROM sqlite_master WHERE name='blog'")->num_rows()==0){
			$sql = "CREATE TABLE 'blog' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'blog_title' TEXT NOT NULL,'blog_content' TEXT,'blog_extra' TEXT,'blog_image' TEXT, 'create_at' TEXT)";
			$this->db->query($sql);
		}
	}

	public function index()
	{
		$rs = $this->db->order_by("id","desc")->get('blog')->result();
		$this->load->view('blog/index',compact("rs"));
	}

	public function detail($id=null)
	{
		$id = (int)$id;
		$rs = $this->db->where("id",$id)->get('blog')->row();
		$this->load->view('blog/detail',compact("rs"));
	}

	public function create()
	{
		if($this->input->post()){
			$blog_title = $this->input->post("title");
			$blog_content = $this->input->post("content");
			$object = [
				"blog_title" => $blog_title,
				"blog_content" => $blog_content,
			];
			if($this->db->insert('blog', $object)){
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