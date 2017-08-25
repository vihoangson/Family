<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("Facebook/autoload.php");

class Facebook extends Facebook\Facebook {

    public function __construct() {
        $config = [
            'app_id'     => APP_ID,
            'app_secret' => APP_SECRET,
        ];
        parent::__construct($config);
    }

    public function getbuttonlogin() {
        $helper      = $this->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl    = $helper->getLoginUrl('http://' . $_SERVER["HTTP_HOST"] . '/homepage/fb_callback', $permissions);
        $url_fb      = htmlspecialchars($loginUrl);

        return $url_fb;
    }

    public function post_group() {
        $linkData     = [
            'link'    => 'http://www.example.com',
            'message' => 'User provided message',
        ];
        $token_access = $_SESSION["fb_access_token"];
        $response     = $this->post('/me/feed', $linkData, $token_access);
    }

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
