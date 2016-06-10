<?php
require_once(__DIR__.'/../CITestCase.php');
class FamilyTestGeneralCommon_Helper extends CITestCase
{
	/**
	 * This test will create a controller stub file, and check if requireController loads correctly.
	 * It skips the test if the environment doesn't grant enough permissions
	 * to create folder and file.
	 */
	public function testGeneralCommon_Helper()
	{
		$this->assertTrue((function_exists("FileSizeConvert")), 'message');
		$this->assertTrue((function_exists("check_folder")), 'message');
		$this->assertTrue((function_exists("check_popup")), 'message');
		$this->assertTrue((function_exists("get_thumb_file_name")), 'message');
		$this->assertTrue((function_exists("h")), 'message');
		$this->assertTrue((function_exists("show_social")), 'message');
		$this->assertTrue((function_exists("show_img_countdown")), 'message');
		$this->assertTrue((function_exists("get_var_countdown")), 'message');
		$this->assertTrue((function_exists("get_content_countdown")), 'message');
		$this->assertTrue((function_exists("show_modal_media")), 'message');
		$this->assertTrue((function_exists("createSlug1")), 'message');
		$this->assertTrue((function_exists("createSlug")), 'message');
		$this->assertTrue((function_exists("filter_string")), 'message');
	}

	public function test_FileSizeConvert(){
		$this->assertEquals(FileSizeConvert(1), "1 B");
		$this->assertEquals(FileSizeConvert(1000), "1000 B");
		$this->assertEquals(FileSizeConvert(100000), "97,66 KB");
		$this->assertEquals(FileSizeConvert(100000000), "95,37 MB");
		$this->assertEquals(FileSizeConvert(100000000000), "93,13 GB");
	}

	public function test_check_folder(){
		check_folder("santo/santo2/santo3");
		$this->assertTrue(is_dir(FCPATH."santo/santo2/santo3"));
		rmdir(FCPATH."santo/santo2/santo3");
		rmdir(FCPATH."santo/santo2");
		rmdir(FCPATH."santo");
	}

	public function test_check_popup(){
		$this->assertEquals(check_popup("con gai yeu"), "<div class='style_content_popup'>con gai yeu</div>");
	}

	public function test_get_thumb_file_name(){
		$this->assertEquals(get_thumb_file_name("image.jpg"), "image_thumb.jpg");
	}

	public function test_h(){
		$this->assertEquals(h("##header"), "<h2>header</h2>\n");
		$this->assertEquals(h("![](http://placehold.it/200x200)"), "<p><img src=\"http://placehold.it/200x200\" alt=\"\" /></p>\n");
	}

	public function test_show_social(){
		// Không có test cái này
	}

	public function test_show_img_countdown(){
		show_img_countdown();
	}

	public function test_get_var_countdown(){
		//get_var_countdown()
	}

	public function test_get_content_countdown(){
		//get_content_countdown()
	}

	public function test_show_modal_media(){
		//show_modal_media()
	}

	public function test_createSlug1(){
		$this->assertEquals(createSlug1("Con gái yêu dấu"), "Con gai yeu dau");
	}

	public function test_createSlug(){
		$this->assertEquals(createSlug("Con gái yêu dấu"), "Con-gai-yeu-dau");
	}

	public function test_filter_string(){
		$this->assertEquals(filter_string("<p>Con gái yêu dấu</p>"), "Con gái yêu dấu");
	}

}

?>