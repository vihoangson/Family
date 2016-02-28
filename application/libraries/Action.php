<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function archive_log($key,$content){
		$object=[
			"archive_key" => $key,
			"archive_content" => $content,
			"archive_create" => date("Y-m-d h:i:s"),
		];
		$this->ci->db->insert('archive', $object);
	}

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
