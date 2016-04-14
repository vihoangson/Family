<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Options_model extends CI_Model {

	function __construct(){
		$this->ddl_install();
	}

	function ddl_install(){
		if(!$this->db->table_exists("options")){
			$sql = "CREATE TABLE 'options' ('id' INTEGER PRIMARY KEY NOT NULL, 'option_key' TEXT NOT NULL, 'option_content' TEXT, 'option_create' DATETIME);";
			$this->db->query($sql);
			$this->save_option("popup",1);
			$this->save_option("popup_flag",1);
			$this->save_option("popup_session",1);
		}
	}

	function get_option($key){
		if(!$key) return [];
		$this->db->where('option_key', $key);
		return $this->db->get('Options')->row();
	}

	function save_option($key,$value){
		if(!$key) return false;
		if($this->db->where("option_key",$key)->count_all_results('options') == 0){
			$this->db->insert("options", ["option_key"=>$key,"option_content"=>$value,"option_create"=> date("Y-m-d h:i:s")]);
		}else{
			$this->db->where("option_key",$key)->update("options", [
				"option_create"=> date("Y-m-d h:i:s"),
				"option_content"=>$value
				]
			);
		}
	}
}

/* End of file Options.php */
/* Location: ./application/models/Options.php */