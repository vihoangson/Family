<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Model {
	public $table = 'blog'; // Set the name of the table for this model.
	public $primary_key = 'id'; // Set the primary key
	public function __construct(){
		$this->install_db();
		$this->soft_deletes      = FALSE;
		$this->timestamps = ["created_at","updated_at","deleted_at"];
		$this->timestamps_format = 'Y-m-d H:i:s';
		$this->return_as         = 'object';
		parent::__construct();
	}

	private function install_db(){
		if($this->db->query("SELECT name FROM sqlite_master WHERE name='blog'")->num_rows()==0){
			$sql = "CREATE TABLE 'blog' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'blog_title' TEXT NOT NULL,'blog_content' TEXT,'blog_extra' TEXT,'blog_image' TEXT,'created_at' TEXT, 'updated_at' TEXT, 'deleted_at' TEXT);";
			if($this->db->query($sql)){
				$this->Log->write_log("info","Create table blog");
			}else{
				$this->Log->write_log("ERROR","ERROR create table blog");
			}
		}
	}
}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */