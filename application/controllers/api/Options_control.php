<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Options_control extends REST_Controller {
	/**
	 * [getAllOption_get description]
	 * 
	 * [GET]
	 * /api/options_control/getalloption
	 * 
	 * @return json
	 */
	public function getAllOption_get()
	{
		$this->load->model('Options_model');
		$rs = $this->Options_model->get_all_option();
		$this->response($rs);
	}



}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
