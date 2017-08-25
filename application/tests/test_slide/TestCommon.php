<?php
require_once(__DIR__ . '/../CITestCase.php');

class TestCommon extends CITestCase {

    /**
     * Kiểm tra tồn tại folder
     *
     * @return void
     * @author Hoang Son
     * @create 20160610155500
     **/
    public function test_check_table_exists() {
        $this->assertTrue(is_dir(FCPATH), "Không có folder:" . FCPATH);
    }


}
