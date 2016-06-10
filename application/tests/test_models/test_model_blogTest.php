<?php
require_once(__DIR__.'/../CITestCase.php');
class test_model_blogTest extends CITestCase {
	public function test_check_table_exists(){
		if($this->CI->db->query("SELECT name FROM sqlite_master WHERE name='blog'")->num_rows()==0){
			$return = false;
		}else{
			$return = true;
		}
		$this->assertTrue($return);
	}

	public function test_check_ele(){
		$this->assertNotNull($this->CI->load->model('blog'));
	}
}