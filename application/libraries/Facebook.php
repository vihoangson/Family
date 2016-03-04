<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Facebook/autoload.php");

class Facebook extends Facebook\Facebook
{

	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->facebook = new Facebook\Facebook([
			'app_id' => '990882487654318', // Replace 990882487654318 with your app id
			'app_secret' => '3bcd21ad4d38fd842fc205a875fd85c5',
			'default_graph_version' => 'v2.2',
		]);
	}

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
