<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Kyniem extends REST_Controller {

	/**
	 * Get all record of kyniem
	 * order by $get["order_by"]
	 * @return json
	 * 
	 * API:GET
	 * /api/kyniem/index
	 */
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

	/**
	 * [search_post]
	 * @param  $post["keyword"]
	 * @return json
	 *
	 * API:post
	 * param:
	 * 		keyword: [keyword]
	 * /api/kyniem/search
	 */
	public function search_post(){
		$rs=[];
		$this->load->model('MY_Kyniem');
		if($this->input->post()){
			$rs = $this->MY_Kyniem->search_kyniem($this->input->post("keyword"));
		}
		$this->response($rs);
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */