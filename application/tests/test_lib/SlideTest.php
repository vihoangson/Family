<?php
require_once(__DIR__.'/../CITestCase.php');
class Slide_Test extends CITestCase
{

    public function test_slide_img(){


        $this->CI->load->library('Slide_timeline');
        $m = $this->CI->slide_timeline->get_timeline();
        $this->assertTrue(is_array($m));
    }

}