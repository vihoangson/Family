<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Facebook/autoload.php");

class Face_book extends Facebook\Facebook
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();



	}

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
