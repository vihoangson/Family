<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyniem extends CI_Model {

	public function getAll(){
		$this->db->where('delete_flg', 0);
		$this->db->order_by('id', 'desc');
		return $this->db->get('Kyniem')->result();
	}	

	public function delete_kyniem($id){
		$this->db->where('id', $id);
		$object= [		
		"delete_flg" => 1,
		];
		$this->db->update('kyniem', $object);
	}

}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */