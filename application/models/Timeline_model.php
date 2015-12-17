<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline_model extends CI_Model {
	private $_table = "timeline";

	public function __construct(){
		parent::__construct();
		$this->install_db();
	}

	public function getAll($condition=null){
		if(!empty($condition["year"])){
			$this->db->like("timeline_date",$condition["year"]);
		}
		if(!empty($condition["tag"])){
			$this->db->like("timeline_tag",$condition["tag"]);
		}
		if(!empty($condition["keyword"])){
			$this->db->or_like("timeline_title",$condition["keyword"]);
			$this->db->or_like("timeline_note",$condition["keyword"]);
		}
		$this->db->where('delete_flg', 0);
		$this->db->order_by('id', 'desc');
		return $this->db->get($this->_table)->result();
	}

	public function delete_kyniem($id){
		$this->db->where('id', $id);
		$object= [
		"delete_flg" => 1,
		];
		$this->db->update($this->_table, $object);
	}

	public function save($data){
		$flag = false;
		$data["timeline_create"] = date("Y-m-d H:i:s");
		if($data["timeline_image"]==""){
			unset($data["timeline_image"]);
		}
		if($data["id"]){
			$this->db->where('id', $data['id']);
			$data["timeline_modifie"] = date("Y-m-d H:i:s");
			if($this->db->update($this->_table, $data)){
				$flag=true;
			}else{
			}
		}else{
			if($this->db->insert($this->_table, $data)){
				$flag=true;
			}
		}

		if($flag){
			$this->session->set_flashdata('item', ['success'=>"Đã thêm thành công"]);
		}else{
			$this->session->set_flashdata('item', ['danger'=>"Lỗi hệ thống"]);
		}
		redirect('/timeline','refresh');
	}

	public function deleteById($id){
		$rs = ($this->getById($id));
		@rename(FCPATH."asset/images/timeline/".$rs->timeline_image,FCPATH."asset/images/trash/".$rs->timeline_image);
		$this->db->where('id', $id);
		if($this->db->update("timeline",["delete_flg"=>1])){
			redirect('/timeline','refresh');
		}
	}

	public function getById($id){
		$this->db->where('delete_flg', 0);
		$this->db->where('id', $id);
		return $this->db->get($this->_table,1)->row();
	}

	public function install_db(){
		if($this->db->query("SELECT name FROM sqlite_master WHERE name='timeline'")->num_rows()==0){
			$sql = "CREATE TABLE 'timeline' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'timeline_title' TEXT, 'timeline_date' DATETIME, 'timeline_tag' TEXT, 'timeline_note' TEXT, 'timeline_image' REAL, 'timeline_create' DATETIME, 'timeline_modifie' TEXT, 'delete_flg' INTEGER NOT NULL DEFAULT 0);";
			$this->db->query($sql);
		}
	}

}

/* End of file Timeline_model.php */
/* Location: ./application/models/Timeline_model.php */