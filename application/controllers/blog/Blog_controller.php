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
		$this->load->view('blog/index');
	}

	public function create_blog()
	{
		$this->load->view('blog/index');
	}
}

/* End of file Blog_controller.php */
/* Location: ./application/controllers/blog/Blog_controller.php */