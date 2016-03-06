<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyniem extends CI_Model {

	public function getAll($condition=null){
		if($condition["year"]){
			$this->db->like('(kyniem_create)', $condition["year"]);
		}
		if($condition["keyword"]){
			$this->db->like('(kyniem_content)', $condition["keyword"]);
		}
		$this->db->select('kyniem.*, user.user_avatar, user.username');
		$this->db->join("user","user.id=kyniem_auth")->where('delete_flg', 0);
		$this->db->order_by('id', 'desc');
		return $this->db->get('kyniem')->result();
	}

	public function delete_kyniem($id){
		$this->db->where('id', $id);
		$object= [
		"delete_flg" => 1,
		];
		$this->db->update('kyniem', $object);
	}

	public function getById($id){
		$this->db->where('delete_flg', 0);
		$this->db->where('id', $id);
		return $this->db->get('kyniem',1)->row();
	}

	public function list_tag(){
		$rs = $this->db->query('select kyniem_content from kyniem where kyniem_content like "%(#%)%"')->result();
		foreach ($rs as $key => $value) {
			preg_match_all("/\(#(\w+?)\)/", $value->kyniem_content,$match);
			foreach ($match[1] as $key_2 => $value_2) {
				$tags[]=$value_2;
			}
		}
		$tags = array_unique(array_filter($tags));
		return $tags;
	}
}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */