<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Kyniem extends REST_Controller {

	public function index_get()
	{
		if($this->input->get('order_by')){
			$this->db->order_by($this->input->get('order_by'), 'desc');
		}else{
			$this->db->order_by('id', 'desc');
		}
		$data = $this->db->get('kyniem')->result();
		$this->response($data);
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */