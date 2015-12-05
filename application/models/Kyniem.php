<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyniem extends CI_Model {

	public function getAll(){
		$this->db->order_by('id', 'desc');
		return $this->db->get('Kyniem')->result();
	}	

}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */