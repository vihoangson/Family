<?php

/**
* 
*/
class MY_Controller extends CI_Controller
{

	public function __construct(){

		parent::__construct();

		$this->error_status = [];

		// Check các trường hợp ảnh hưởng tới hoạt động của site
		$this->check_define_config();

		$this->doctrine->em->getRepository("Item");

		// Check validate
		if($GLOBALS["phpunit"] != true){
			if($this->router->fetch_method() != "login") {
				if($this->router->fetch_method()=="cron" || $this->router->fetch_method()=="fb_callback"){
					return;
				}
				if(!$this->session->userdata('user')){
					redirect('homepage/login','refresh');
				}
			}else{
				if($this->session->userdata('user')){
					redirect('/',' ');
				}
			}
		}

		// Set thông số gửi mail của google
		$this->config_email_custom = Array(
			'protocol'  => 'sendmail',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_port' => 587,
			'smtp_user' => FROM_EMAIL,
			'smtp_pass' => FROM_EMAIL_PASS,
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
			);

		//============  ============ 
		// Set navbar custom
		// 
		$navbars =[
			"navbar_custom"=> [ 
				["link"=>"/admin/admin_page/session_login" , "text"=> "Session login"],
				["link"=>"/admin/admin_page/controll_list_login_facebook" , "text"=> "List login Facebook"],
				["link"=>"/admin/blank_page" , "text"=> "Blank"],
				["link"=>"/admin/files_controller/show" , "text"=> "Manager Images"],
				["link"=>"/admin/control_popup" , "text"=> "Control popup"],
				["link"=>"/phpliteadmin.php" , "text"=> "PHP Sqlite"],
			]
		];
		$this->load->vars($navbars);
		//
		//============  ============
	}

	/**
	 * 
	 * [check_status_system]
	 * Kiểm tra các trường hợp ảnh hưởng tới vận hành bình thường của website
	 *
	 * @since  20160623101733 
	 * @return [array] $this->error_status
	 * 
	 */
	public function check_status_system(){
		// [START] 20160623102429 Kiểm tra ghi file vào folder root/backup_file

		$links_asset = [
			FCPATH."backup_file",
			FCPATH."asset/images",
			FCPATH."asset/js",
			FCPATH."asset/tmp",
			FCPATH."asset/template",
			FCPATH."asset/uploads",
			FCPATH."asset/file_upload",
		];

		foreach ($links_asset as $key => $value) {
			if(!is_writable($value)){
				mkdir($value);
				throw new Exception("Không ghi được file vào folder ".$value."[Vui lòng tạo mới hoặc chỉnh lại permission cho folder nha]", 1);
			}
		}

		// [END] 20160623102433 Kiểm tra ghi file vào folder root/backup_file
	}

	/**
	 * [my_sent_email]
	 * Function gửi email cho địa chỉ xác định
	 * 
	 * @param  [type] $options [description]
	 *      $options["subject"] // Tiêu đè email
	 *      $options["content"] // Nội dung email
	 * @return [type]          [description]
	 */
	public function my_sent_email($options){
		if(ALLOW_SENT_MAIL){
			$this->load->library('email', $this->config_email_custom);
			$this->email->from(FROM_EMAIL, 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->cc('ngotrichi@gmail.com');
			$this->email->subject($options["subject"]);
			$this->email->message($options["content"]);
			if($this->email->send()){
				//echo "<h1>Send mail [".__FUNCTION__."]</h1>";
			}else{
				throw new Exception("Can't sent email", 1);
			}
		}
	}

	/**
	 * [backup_db_family]
	 * Backup database family
	 * 
	 * @return void
	 * @throws Exception
	 */
	public function backup_db_family(){
		if(ALLOW_SENT_MAIL){
			$this->load->library('email', $this->config_email_custom);
			$this->email->from(FROM_EMAIL, 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->subject("Backup db ".date("Y-m-d h:i:s"));
			$this->email->message(date("Y-m-d h:i:s"));
			$this->email->attach(DB_FILE_FAMILY);
			if($this->email->send()){
				echo "<h1>Send mail [".__FUNCTION__."]</h1>";
			}else{
				throw new Exception("Can't backup db", 1);
				echo "<h1>Can't sent mail [".__FUNCTION__."]</h1>";
			}
		}
	}

	public function sent_log(){
		if(ALLOW_SENT_MAIL){
			$this->load->library('HZip');
			$file_name = "BK_log_".date("Ymd_his").".zip";
			$config['upload_path'] = check_folder(FCPATH.'asset/file_upload/custom_banner_'.$position.'/');
			HZip::zipDir(FCPATH."application/logs",FCPATH."asset/tmp/".$file_name);
			$this->load->library('email', $this->config_email_custom);
			$this->email->from(FROM_EMAIL, 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->subject("Backup log ".date("Y-m-d h:i:s"));
			$this->email->message(date("Y-m-d h:i:s"));
			$this->email->attach(FCPATH."asset/tmp/".$file_name);
			if($this->email->send()){
				echo "<h1>Send mail [".__FUNCTION__."]</h1>";
			}else{
				throw new Exception("Can't backup db", 1);
				echo "<h1>Can't sent mail [".__FUNCTION__."]</h1>";
			}
		}
	}

	/**
	 * [backup_file_images_family]
	 * Không dùng hàm này nữa
	 */
	public function backup_file_images_family($options=null){
		return;
		$this->load->library('HZip');
		$file_name = "BK_image_".date("Ymd_his").".zip";
		HZip::zipDir(FCPATH."asset/images",FCPATH."asset/tmp/".$file_name);
		$files = scandir(FCPATH."asset/tmp");
		if(count($files)>7){
			$l_file =[];
			foreach ($files as $key => $value) {
				if(!is_dir(FCPATH."asset/tmp/".$value)){
					echo "<p>".$value."</p>";
					preg_match("/(\d+)_(\d+)/", $value,$match);
					if($match[1]){
						$l_file[] = $value;
					}
				}
			}
			if(!empty($l_file)){
				sort($l_file);
				unlink(FCPATH."asset/tmp/".$l_file[0]);
			}
		}

		if(ALLOW_SENT_MAIL){
			if(file_exists(FCPATH."asset/tmp/".$file_name)){
				$this->load->library('email', $this->config_email_custom);
				$this->email->from(FROM_EMAIL, 'Family');
				$this->email->to('vihoangson@gmail.com');
				$this->email->cc('4t.nhauyen@gmail.com');
				$this->email->subject("Backup file images ".date("Y-m-d h:i:s"));
				$this->email->message("<h2>Backup file images ".date("Y-m-d h:i:s")."</h2> <p>Link:".base_url()."asset/tmp/".$file_name."</p>");
				if($this->email->send()){
					echo "<h1>Send mail [".__FUNCTION__."]</h1>";
				}else{
					echo "<h1>Can't sent mail [".__FUNCTION__."]</h1>";
				}
			}else{
				echo "<h1>Don't have file [".__FUNCTION__."]</h1>";
			}
		}
	}

	public function do_upload_many_core()
	{       
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$error = [];
		$success = [];
		for($i=0; $i<$cpt; $i++)
		{
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

			$this->upload->initialize($this->set_upload_options_core());
			if($this->upload->do_upload()){
				$img_info = $this->upload->data();
				$success[] = $img_info;
				$this->resize_img(FCPATH."asset/images/".$img_info['file_name'],100,100);
			}else{
				$error[] = $this->upload->display_errors();
			}
		}
		return ["error" => $error, "success" => $success];
	}

	public function do_upload_single_core()
	{
		$this->load->library('upload');
		$this->upload->initialize($this->set_upload_options_core());
		if($this->upload->do_upload()){
			$img_info = $this->upload->data();
			$success = $img_info;
			$this->resize_img_core(FCPATH."asset/images/".$img_info['file_name'],100,100);
		}else{
			$error = $this->upload->display_errors();
		}
		return ["error" => $error, "success" => $success];
	}

	private function set_upload_options_core()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = 'asset/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '102400';
		$config['max_height']  = '76800';
		$config['overwrite']     = FALSE;
		return $config;
	}

	private function resize_img_core($path,$width,$height){
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['new_image'] = FCPATH."asset/images/thumb/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$config['height']       = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();	
	}

	private function check_define_config(){
		$path_file_config = file_get_contents(FCPATH."application/config/family/config.php");
		$a1= $this->getDefineInFile($path_file_config);

		$path_file_config = file_get_contents(FCPATH."application/config/family/config.sample.php");
		$a2= $this->getDefineInFile($path_file_config);

		if(!($a1 === array_intersect($a1, $a2) && $a2 === array_intersect($a2, $a1))) {
			$html  = '';
			$html .= '<p>application/config/family/config.php</p>';
			$html .= '<p>application/config/family/config.sample.php</p>';
			$html .= '<p>Không đồng nhất với nhau, mời kiểm tra lại</p>';
			$this->log->write_log("ERROR",$html);
		}
	}

	//============ ============  ============  ============ 
	// getDefineInFile()
	// Lấy tất cả tên các define đổ vào mảng
	//============ ============  ============  ============ 
	private function getDefineInFile($path_file_config){
		$array_str = array_unique(explode("\n", $path_file_config));
		$return = [];
		foreach ($array_str as $key => $value) {
			preg_match("/define\(\"(.+?)\"/", $value,$match);
			if($match[1]){
				$return[] = ($match[1])."\n";
			}
		}
		return $return;
	}

}
?>
