<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Action
 * @property Action           $action                 Loads framework components.
 */
class Action
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	/**
	 * [archive_log description]
	 *
	 * @since 20160704132530
	 * @param  [type] $key     [description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 * 
	 *  Using:
	 * $this->action->archive_log("login_facebook","login ".time());
	 */
	public function archive_log($key,$content){
		$object=[
			"archive_key" => $key,
			"archive_content" => $content,
			"archive_create" => date("Y-m-d h:i:s"),
		];
		$this->ci->db->insert('archive', $object);
	}

	/**
	 * [archive_log_read description]
	 * 
	 * @since  20160704132512
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 *
	 *  Using:
	 * dd($this->action->archive_log_read("login_facebook"));
	 * dd($this->action->archive_log_read("login_%"));
	 * ...
	 */
	public function archive_log_read($key){
		$rs = $this->ci->db->where("archive_key like '$key' ")->order_by("id","desc")->get('archive')->result();
		return $rs;
	}

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
