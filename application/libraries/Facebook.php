<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Facebook/autoload.php");
class Facebook extends Facebook\Facebook
{
	public function __construct()
	{
		$config = array(
			'app_id' => '990882487654318', // Replace 990882487654318 with your app id
			'app_secret' => '3bcd21ad4d38fd842fc205a875fd85c5',
		);
		parent::__construct($config);
	}

	public function getbuttonlogin(){
		$helper = $this->getRedirectLoginHelper();
		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://'.$_SERVER["HTTP_HOST"].'/homepage/fb_callback', $permissions);
		$url_fb = htmlspecialchars($loginUrl);
		return $url_fb;
	}
}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
