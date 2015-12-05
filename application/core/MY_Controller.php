<?php /**
* 
*/
class MY_Controller extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		redirect('homepage/login','refresh');
	}

}
?>
