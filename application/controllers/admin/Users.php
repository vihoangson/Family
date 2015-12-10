<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		if($this->input->post("username") && $this->input->post("password")){
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$type     = $this->input->post("type");
			$object = [
				"username" => $username,
				"password" => md5($password."__".$username),
				"type" => $type,
			];
			$this->db->where('username', $username);
			if($this->db->get('user')->num_rows()>0){
				$this->session->set_flashdata('item', ["danger" => 'Bị trùng username']);
			}else{
				if($this->db->insert('user', $object)){
					$this->session->set_flashdata('item', ["success" => 'Đã thêm']);
				}
			}
		}
		$rs = $this->db->get('user')->result();
		$data=["rs" => $rs];
		$this->load->view('admin/users', $data);
	}

	public function change_password(){
		if(!$this->session->userdata('user_id')){
			redirect('/','refresh');
		}
		if($this->input->post()){
			$old_password   = $this->input->post("old_password") ;
			$new_password   = $this->input->post("new_password") ;
			$renew_password = $this->input->post("renew_password") ;
			if($renew_password == $new_password){
				$this->db->where('id', $this->session->userdata('user_id'));
				$rs_u = $this->db->get('user', 1)->row();
				if($rs_u->password == md5($old_password."__".$rs_u->username)){
					$this->db->where('id', $rs_u->id);
					if($this->db->update('user', ["password" => md5($new_password."__".$rs_u->username)])){
						$this->session->set_flashdata('item',["success"=>"Đã đổi password thành công"]);
					}else{
						$this->session->set_flashdata('item',["error"=>"Không đổi được password"]);
					}
				}
			}
		}
		$this->load->view('admin/change_password');
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */