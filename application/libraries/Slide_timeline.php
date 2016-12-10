<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_timeline {
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }
    public function get_timeline(){
        $this->ci->load->helper("directory");
        $return = directory_map(FCPATH."asset/img_slide");
        return $return;
    }
}