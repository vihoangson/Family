<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogComment extends MY_Model {
	public $table = 'BlogComment'; // Set the name of the table for this model.
	public $primary_key = 'id'; // Set the primary key
	public function __construct(){
		$this->install_db();
		$this->timestamps        = ["created_at","updated_at","deleted_at"];
		$this->timestamps_format = 'Y-m-d H:i:s';
		$this->return_as         = 'object';
		parent::__construct();
	}

	private function install_db(){
		if($this->db->query("SELECT name FROM sqlite_master WHERE name='blogcomment'")->num_rows()==0){
			$sql = "CREATE TABLE 'blogcomment' ('id' INTEGER PRIMARY KEY NOT NULL, 'blog_id' INTEGER, 'comment_content' TEXT, 'comment_user' TEXT,'created_at' DATETIME,'updated_at' DATETIME);";
			if($this->db->query($sql)){
				$this->Log->write_log("INFO","Create table blogcomment");
			}else{
				$this->Log->write_log("ERROR","ERROR create table blogcomment");
			}
		}
	}
}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */