<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends MY_Controller {

	public function index()
	{
		$this->load->view('admin/admin_page');
	}

	public function session_login(){
		$rs = $this->db->where("archive_key like 'login_%' ")->order_by("id","desc")->get('archive')->result();
		$this->load->view('admin/session_login' , compact("rs"));
	}

	public function controll_list_login_facebook(){
		$rs = $this->db->where("archive_key like 'lg_fb' ")->get('archive')->row();
		if(!$rs){
			$this->action->archive_log("lg_fb",json_encode([]));
		}
		if($this->input->post()){
			$email = explode("\n", $this->input->post("email"));
			$json_email = json_encode($email);
			$this->db->where('archive_key', "lg_fb");
			$this->db->update('archive', ["archive_content"=>$json_email]);
		}
		$rs = $this->db->where("archive_key like 'lg_fb' ")->get('archive')->row();
		$this->load->view('admin/controll_list_login_facebook' , compact("rs"));
	}

	public function control_popup(){

		if($this->input->post('content')){
			$this->Options_model->save_option("popup",$this->input->post('content'));
		}
		$rs = $this->Options_model->get_option("popup");
		$this->load->view('admin/control_popup' , compact("rs"));
	}

}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */