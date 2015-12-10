<?php /**
* 
*/
class MY_Controller extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		if($this->router->fetch_method() != "login") {
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
		$this->email->subject($options["subject"]);
		$this->email->message($options["content"]);	
		return $this->email->send();
	}

}
?>
