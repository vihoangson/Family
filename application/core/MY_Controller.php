<?php /**
* 
*/
class MY_Controller extends CI_Controller
{
	
	public function __construct(){
		define("FROM_EMAIL","vihoangson@gmail.com");
		define("FROM_EMAIL_PASS","sonuyen117s");

		parent::__construct();
		if($this->router->fetch_method() != "login") {
			if($this->router->fetch_method()=="cron"){
				return;
			}
			if(!$this->session->userdata('user')){
				redirect('homepage/login','refresh');
			}
		}else{
			if($this->session->userdata('user')){
				redirect('/','refresh');
			}
		}
		$this->config = Array(
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => FROM_EMAIL,
			'smtp_pass' => FROM_EMAIL_PASS,
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
			);
	}

	public function my_sent_email($options){
		if(ALLOW_SENT_MAIL){
			$this->load->library('email', $this->config);
			$this->email->from(FROM_EMAIL, 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->cc('ngotrichi@gmail.com');
			$this->email->subject($options["subject"]);
			$this->email->message($options["content"]);
			if($this->email->send()){
				echo "<h1>Send mail [".__FUNCTION__."]</h1>";
			}else{
				echo "<h1>Can't sent mail [".__FUNCTION__."]</h1>";
			}
		}
	}

	public function backup_db_family($options=null){
		if(ALLOW_SENT_MAIL){
			$this->load->library('email', $this->config);
			$this->email->from(FROM_EMAIL, 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->subject("Backup db ".date("Y-m-d h:i:s"));
			$this->email->message(date("Y-m-d h:i:s"));
			$this->email->attach(DB_FILE_FAMILY);
			if($this->email->send()){
				echo "<h1>Send mail [".__FUNCTION__."]</h1>";
			}else{
				echo "<h1>Can't sent mail [".__FUNCTION__."]</h1>";
			}
		}
	}

	public function backup_file_images_family($options=null){
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
				$this->load->library('email', $this->config);
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
}
?>
