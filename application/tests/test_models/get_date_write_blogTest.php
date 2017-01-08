<?php
require_once(__DIR__.'/../CITestCase.php');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 1/8/2017
 * Time: 10:31 AM
 */
class get_date_write_blogTest extends CITestCase
{
    public function test_get_date_write_blog(){
        print_r($this->CI->kyniem->get_date_write_blog());

        $this->assertTrue(true);
    }
}
