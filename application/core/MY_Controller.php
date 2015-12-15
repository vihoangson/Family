<?php /**
* 
*/
class MY_Controller extends CI_Controller
{
	
	public function __construct(){
		date_default_timezone_set('asia/ho_chi_minh');
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
	}

	public function my_sent_email($options){
		$this->load->library('email');
		$this->email->initialize(["protocol"=>"sendmail"]);
		$this->email->from('info@vihoangson.com', 'Family');
		$this->email->to('vihoangson@gmail.com');
		$this->email->cc('4t.nhauyen@gmail.com');
		$this->email->subject($options["subject"]);
		$this->email->message($options["content"]);
		$this->email->attach(APPPATH."models/db/family");
		if($this->email->send()){
			echo "<h1>Send mail</h1>";
		}else{
			echo "<h1>Can't sent mail</h1>";
		}
	}

	public function backup_db_family($options=null){
		$this->load->library('email');
		$this->email->initialize(["protocol"=>"sendmail"]);
		$this->email->from('info@vihoangson.com', 'Family');
		$this->email->to('vihoangson@gmail.com');
		$this->email->cc('4t.nhauyen@gmail.com');
		$this->email->subject("Backup db ".date("Y-m-d h:i:s"));
		$this->email->message(date("Y-m-d h:i:s"));
		$this->email->attach(DB_FILE_FAMILY);
		if($this->email->send()){
			echo "<h1>Send mail</h1>";
		}else{
			echo "<h1>Can't sent mail</h1>";
		}
	}

	public function backup_file_images_family($options=null){
		$this->load->library('HZip');
		$file_name = "BK_image_".date("Ymd_his").".zip";
		HZip::zipDir(FCPATH."asset/images",FCPATH."asset/tmp/".$file_name);
		if(file_exists(FCPATH."asset/tmp/".$file_name)){
			$this->load->library('email');
			$this->email->initialize(["protocol"=>"sendmail"]);
			$this->email->from('info@vihoangson.com', 'Family');
			$this->email->to('vihoangson@gmail.com');
			$this->email->cc('4t.nhauyen@gmail.com');
			$this->email->subject("Backup file images ".date("Y-m-d h:i:s"));
			$this->email->message(date("Y-m-d h:i:s")."Link:".base_url()."/asset/tmp/".$file_name);
			if($this->email->send()){
				echo "<h1>Send mail</h1>";
			}else{
				echo "<h1>Can't sent mail</h1>";
			}
		}else{
			echo "<h1>Don't have file</h1>";
		}
	}
}
?>
