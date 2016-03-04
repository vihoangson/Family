<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Facebook/autoload.php");
class Facebook extends Facebook\Facebook
{
	public function __construct()
	{
		$config = array(
			'app_id'     => APP_ID,
			'app_secret' => APP_SECRET,
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

	public function post_group(){
		$publish = $facebook->api('/246332502186029/feed', 'post',
			array('access_token' => $this->session->userdata('fb_access_token'),'message'=> ' Noi dung demo ',
				'from' => "990882487654318"
				));
	}

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
