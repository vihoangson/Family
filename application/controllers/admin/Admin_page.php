<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('files_model');
		$this->path_file_upload = FCPATH."asset/file_upload/";
	}

	public function index()
	{
		$this->load->view('admin/admin_page');
	}

	public function blank_page(){
		echo $this->load->view('_includes/header_admin',null,true);
		echo $this->load->view('_includes/footer_admin',null,true);
	}

	public function upload_file(){
		$rs = $this->files_model->find()->result();
		$this->load->view('admin/file_list',compact("rs"));
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
			if($this->input->post('flag_toggle') == 1){
				$this->Options_model->save_option("popup_flag",1);
			}else{
				$this->Options_model->save_option("popup_flag",0);
			}
			if($this->input->post('popup_session') == 1){
				$this->Options_model->save_option("popup_session",1);
			}else{
				$this->Options_model->save_option("popup_session",0);
			}
			$this->Options_model->save_option("popup",$this->input->post('content'));
		}

		$rs            = $this->Options_model->get_option("popup");
		$flag          = $this->Options_model->get_option("popup_flag");
		$popup_session = $this->Options_model->get_option("popup_session");
		$this->load->view('admin/control_popup' , compact("rs","flag","popup_session"));
	}

}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */