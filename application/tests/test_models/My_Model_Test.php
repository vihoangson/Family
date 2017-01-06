<?php
require_once(__DIR__.'/../CITestCase.php');
class My_Model_Test extends CITestCase {

	/**
	 * Kiểm tra tồn tại của bảng blog
	 * 
	 * @return void
	 * @author Hoang Son
	 * @create 20160610155500
	 **/
	public function test_check_table_exists(){
		if($this->CI->db->query("SELECT name FROM sqlite_master WHERE name='blog'")->num_rows()==0){
			$return = false;
		}else{
			$return = true;
		}
		$this->assertTrue($return);
	}

	/**
	 * Chức năng dùng để test my model các function 
	 * $this->blog->get();
	 * $this->blog->get_all();
	 * $this->blog->where();
	 * $this->blog->insert();
	 * $this->blog->update();
	 * $this->blog->delete();
	 * 
	 * @return void
	 * @author Hoang Son
	 * @create 20160610155500
	 **/
	public function test_check_ele_model(){
		$this->CI->load->model('blog');
		$this->assertTrue(is_object($this->CI->blog->get()));
		$this->assertTrue(is_array($this->CI->blog->get_all()));
		$this->assertTrue(is_object($this->CI->blog->where('blog_title')->get()));
		$id = $this->CI->blog->insert(array('blog_title' => 'avenirer'));
		$this->assertGreaterThan(0, $id);
		$this->CI->blog->update(array('blog_title' => 'check'), $id);
		$this->assertFalse(!($this->CI->blog->delete($id)));
	}

	public function test_search_kyniem(){
		$this->markTestSkipped();
		$this->CI->load->model('MY_Kyniem');
		$rs = $this->CI->MY_Kyniem->search_kyniem("Su");
		$this->assertNotNull($rs);
		$this->assertEquals(37,count($rs), 'Không đúng cái này');
	}

}
