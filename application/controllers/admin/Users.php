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

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */