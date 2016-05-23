<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->vars(
			[
				"navbar_custom"=>[
					["link"=>"/admin/admin_page/session_login","text"=>"Session login"],
					["link"=>"/admin/admin_page/controll_list_login_facebook","text"=>"List login Facebook"],
					["link"=>"/admin/blank_page","text"=>"Blank"],
					["link"=>"/admin/files_controller/show","text"=>"Manager Images"],
					["link"=>"/admin/control_popup","text"=>"Control popup"],
					["link"=>"/admin/admin_page/manager_media","text"=>"Quản lý media"],
					["link"=>"/phpliteadmin.php","text"=>"PHP Sqlite"],
				]
			]
		);
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

			if($this->Options_model->save_option("popup",$this->input->post('content'))){
				$this->session->set_flashdata('item', ["success"=>"Đã save thành công"]);
			}
		}
		$rs            = $this->Options_model->get_option("popup");
		$flag          = $this->Options_model->get_option("popup_flag");
		$popup_session = $this->Options_model->get_option("popup_session");

		$this->load->view('admin/control_popup' , compact("rs","flag","popup_session"));
	}

	public function manager_media(){
		if($this->input->post()){
			if($this->input->post("submit")=="delete" && $this->input->post("media_id") ){
				foreach ($this->input->post("media_id") as $key => $value) {
					$rs = $this->db->where("id",$value)->get('media')->row();
					$full_path_img = FCPATH.ltrim($rs->files_path.$rs->files_name,"/");
					if($this->db->where("id",$value)->delete('media')){
						@unlink($full_path_img);
						$this->load->vars('success', 'Đã lưu thành công');
					}else{
						$this->load->vars('error', 'Không lưu đượcs');
					}
				}
			}
		}
		$rs = $this->db->order_by("id","desc")->get("media")->result();
		$this->load->view('admin/manager_media' , compact("rs"));
	}

	public function instant_imgs(){
		$this->load->model('options_model');
		$data = json_decode($this->options_model->get_option("instant_img")->option_content);
		$this->load->view('admin/instant_imgs',compact("data"));
	}

	public function view_logs($case = null){
		if($case == "delete"){
			$files = scandir(APPPATH."logs");
			foreach ($files as $key => $value) {
				if(preg_match("/\.php/", $value)){
					unlink(APPPATH."logs/".$value);
				}
			}
			$this->session->set_flashdata('alert', 'Đã xóa logs');
			redirect('/admin/admin_page/view_logs/','refresh');
		}
		$files = scandir(APPPATH."logs");
		echo $this->load->view('_includes/header_admin', null, true);
		echo "<h1>Log file</h1>";
		echo '<a href="/admin/admin_page/view_logs/delete" class="btn btn-warning"><i class="fa fa-trash"></i> Delete logs</a><hr>';
		if($files){
			echo "<pre>";
			foreach ($files as $key => $value) {
				if(preg_match("/\.php/", $value)){
					include(APPPATH."logs/".$value);
				}
			}
			echo "</pre>";
		}
		echo $this->load->view('_includes/footer_admin', null, true);
	}

	public function cache_input_kyniem(){
		echo $this->load->view('_includes/header_admin', null, true);
			echo "<p><a class='btn btn-danger' href='/ajax/do_ajax/ajax_save_cache/delete'><i class='fa fa-trash'></i> Delete cache</a></p>";
			$this->db->like('option_key', "cache_tmp_input_");
			$rs = $this->db->get('options')->result();
			echo "<pre>";
			foreach ($rs as $key => $value) {
				print_r(json_decode($value->option_content));
				echo "<hr>";
			}
			echo "</pre>";
		echo $this->load->view('_includes/footer_admin', null, true);
	}
}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */