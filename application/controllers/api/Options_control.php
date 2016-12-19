<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Options_control extends REST_Controller {
	/**
	 * Lấy tất cả các file hình trong slide của con
	 *
	 * @return array
	 * @url    /api/options_control/get_all_picture_slide
	 */
	public function get_all_picture_slide_get(){
		$this->load->helper("directory");
		$img_slides = directory_map(FCPATH."asset/img_slide");
		if(!$img_slides){}
		$this->_create_thumbnail(FCPATH."asset/img_slide");
		foreach ($img_slides as $key => $value) {
			if (preg_match("/_thumb/", $value)) {
				unset($img_slides[$key]);
			}
		}
		$this->response(array_values($img_slides));
	}

	/**
	 *
	 * Refresh lại hình thumbnail
	 *
	 * @url /api/options_control/delete_thumbnail_slide
	 */
	public function delete_thumbnail_slide_get(){
		$this->load->helper("directory");
		$options["delete_all_thumbnail"] = true;
		$this->_create_thumbnail(FCPATH."asset/img_slide",$options);
	}

	/**
	 * Tạo thumbnail cho các hình nằm trong $path
	 *
	 * @param $path Path director
	 * @param $option["delete_all_thumbnail"] boolean
	 */
	private function _create_thumbnail($path,$options = []){
		$img_slides = directory_map($path);
		$this->load->library("Image_lib");
		foreach ($img_slides as $key => $value){
			if(preg_match("/_thumb/",$value)) {
				if($options["delete_all_thumbnail"]){
					unlink($path."/".$value);
				}
				continue;
			}
			if(!file_exists($path."/".$this->image_lib->thumb_marker.$value)){
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path."/".$value;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 500;
				$config['height']   = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
		}
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
