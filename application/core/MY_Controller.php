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

}
?>
