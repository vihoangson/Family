<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Options_control extends REST_Controller {
    public function get_img_slide(){
        $this->load->library('Slide_timeline');
        $rs = $this->Slide_timeline->get_timeline();
        $this->response($rs);
    }
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

	public function changeuser_post(){
		if($this->input->post('name')){
			$array = array(
				'user' => $this->input->post('name'),
				'user_id' => 0,
			);
			try {
				$this->session->set_userdata( $array );
				echo $this->session->userdata( "user" );
			} catch (Exception $e) {
				echo "error";
			}
			
		}
	}


}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
