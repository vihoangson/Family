<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Console extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		
	}

	//============ ============ ============  ============  ============  ============ 
	// Function resize_imf()
	// Function này dùng để resize tất cả hình ảnh trong folder cả subfolder
	// ! Hình nhỏ hơn ko resize
	// /ajax/console/resize_imf
	//============ ============ ============  ============  ============  ============ 
	public function resize_gif(){
		//============ ============  ============  ============ 
		//  Đường dẫn folder
		$direct_resize_all        = FCPATH."asset/file_upload";
		// Chiều rộng và chiều cao cần resize
		// Lưu ý hình nhỏ hơn số này không được resize
		$thumbWidth               =50;
		$thumbHeight              =50;
		//============ ============  ============  ============ 
		$config['image_library']  = 'gd2';
		$config['create_thumb']   = TRUE;
		$config['thumb_marker']   = "thumb_";
		$config['maintain_ratio'] = TRUE;
		$config['width']          = $thumbWidth;
		$config['height']         = $thumbHeight;
		$this->load->library('image_lib', $config);
		// Đổ tất cả các thư mục con vào mảng
		$directory_list = $this->listdirs($direct_resize_all);
		// Check file tại thư mục chỉ định
		$directory_list[] = $direct_resize_all;

		foreach ($directory_list as $key_direct => $value_direct) {
			$path_resize = $value_direct."/";
			$dir = scandir($path_resize);
			foreach ($dir as $key => $value) {
				if(preg_match("/\.(gif)$/", $value)){
					$path_file_name = $path_resize.$value;
					list($width, $height) = getimagesize($path_file_name);
					if($thumbWidth < $width || $thumbHeight < $height)
					{
						$config['source_image']	= $path_file_name;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);					
						if($this->image_lib->resize()){
							$result[] = ["status"=>"done"];
						}else{
							$result[] = ["status"=>"error","content"=>$this->image_lib->display_errors()];
						}
					}
					else
					{
						$result[] = ["status"=>"Don't resize"];
					}
				}
			}
		}
		// Xuất json kết quả
		echo json_encode($result);
	}

	//============ ============ ============  ============  ============  ============ 
	// Function resize_imf()
	// Function này dùng để resize tất cả hình ảnh trong folder cả subfolder
	// ! Hình nhỏ hơn ko resize
	// /ajax/console/resize_imf
	//============ ============ ============  ============  ============  ============ 
	public function resize_imf(){
		//============ ============  ============  ============ 
		//  Đường dẫn folder
		$direct_resize_all        = FCPATH."asset/file_upload";
		// Chiều rộng và chiều cao cần resize
		// Lưu ý hình nhỏ hơn số này không được resize
		$thumbWidth               =800;
		$thumbHeight              =800;
		//============ ============  ============  ============ 
		$config['image_library']  = 'gd2';
		$config['create_thumb']   = false;
		$config['thumb_marker']   = "thumb_";
		$config['maintain_ratio'] = TRUE;
		$config['width']          = $thumbWidth;
		$config['height']         = $thumbHeight;
		$this->load->library('image_lib', $config);
		// Đổ tất cả các thư mục con vào mảng
		$directory_list = $this->listdirs($direct_resize_all);
		// Check file tại thư mục chỉ định
		$directory_list[] = $direct_resize_all;

		foreach ($directory_list as $key_direct => $value_direct) {
			$path_resize = $value_direct."/";
			$dir = scandir($path_resize);
			foreach ($dir as $key => $value) {
				if(preg_match("/\.(png|jpg|gif)$/", $value)){
					$path_file_name = $path_resize.$value;
					list($width, $height) = getimagesize($path_file_name);
					if($thumbWidth < $width || $thumbHeight < $height)
					{
						$config['source_image']	= $path_file_name;
						$this->image_lib->clear();
						$this->image_lib->initialize($config);					
						if($this->image_lib->resize()){
							$result[] = ["status"=>"done"];
						}else{
							$result[] = ["status"=>"error","content"=>$this->image_lib->display_errors()];
						}
					}
					else
					{
						$result[] = ["status"=>"Don't resize"];
					}
				}
			}
		}
		// Xuất json kết quả
		echo json_encode($result);
	}

	//============ ============  ============  ============ 
	// Function listdirs()
	// Đổ tất cả các thư mục con vào mảng
	//============ ============  ============  ============ 
	private function listdirs($dir) {
		static $alldirs = array();
		$dirs = glob($dir . '/*', GLOB_ONLYDIR);
		if (count($dirs) > 0) {
			foreach ($dirs as $d) $alldirs[] = $d;
		}
		foreach ($dirs as $dir) $this->listdirs($dir);
		return $alldirs;
	}



}

/* End of file Console.php */
/* Location: ./application/controllers/ajax/Console.php */