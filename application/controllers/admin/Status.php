<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function index()
	{

		echo $this->load->view('_includes/header',null,true);
		?>
			<div class="list-group">
				<a href="/admin/status/list_tmp" class="list-group-item">Danh sách file tmp</a>
			</div>
		<?php
		echo $this->load->view('_includes/footer',null,true);
	}

	public function list_tmp()
	{
		$files = scandir(FCPATH."asset/tmp");
		$this->load->view('admin/status_tmp', ["files"=>$files]);
	}


	public function delete_tmp($confirm=null){
		if($confirm == "ok") {
			$files = scandir(FCPATH."asset/tmp");
			foreach ($files as $key => $value) {
				if(!is_dir(FCPATH."asset/tmp/".$value)){
					unlink(FCPATH."asset/tmp/".$value);
				}
			}
		}
		redirect('/admin/status/','refresh');
	}

}

/* End of file Static.php */
/* Location: ./application/controllers/admin/Static.php */