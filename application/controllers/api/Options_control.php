<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Options_control extends REST_Controller {

	private $words;

	/**
	 * Lấy tất cả các file hình trong slide của con
	 *
	 * @return array
	 * @url    /api/options_control/get_all_picture_slide
	 */
	public function get_all_picture_slide_get(){
		$this->load->helper("directory");
		if(!is_dir(FCPATH."asset/img_slide")){
			mkdir(FCPATH."asset/img_slide");
		}
		$img_slides = directory_map(FCPATH."asset/img_slide");
		if(!$img_slides){return;}
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

	/**
	 * @url    /api/options_control/put_toarray
	 */
	public function put_toarray_get(){
		$this->load->config("family/words");
		$this->words = $this->config->config["words"];
		// Get data from web
		$this->getdict_get();
		$words = $this->words;
		foreach ((array)$words as $key=>$value){
			$contents[$value] = file_get_contents(FCPATH."asset/words/".$value.".txt");
		}
		$this->response($contents);
	}

	/**
	 * @url    /api/options_control/getdict?key=[king]
	 */
	public function getdict_get(){
		$this->load->helper("simplehtmldom");
		$keyword = $this->input->get("key");
		$return = $this->words;
		foreach ($return as $key=>$value){
			if(!file_exists(FCPATH."asset/words/".$value.".txt")){
				$html = file_get_html("https://vdict.com/".$value.",1,0,0.html");
				foreach($html->find('.pronounce') as $element){
					$pro = $element->plaintext . '<br>';
				}
				$html->clear();
				// Save to file
				file_put_contents(FCPATH."asset/words/".$value.".txt",$value."___".$pro);
			}
		}
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
