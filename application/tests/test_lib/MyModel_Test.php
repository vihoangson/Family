<?php
require_once(__DIR__ . '/../CITestCase.php');

class MyModel_Test extends CITestCase {

    function test_mymodel() {

        //$this->load->model('my_kyniem');
        //$total = $this->my_kyniem->count_rows();
        //$this->my_kyniem->limit(10);
        //d($this->my_kyniem->get_all());
        //$this->my_kyniem->paginate(10,$total);
        // $this->my_kyniem->all_pages; // will output links to all pages like this model: "< 1 2 3 4 5 >". It will put a link if the page number is not the "current page"
        // $this->my_kyniem->previous_page; // will output link to the previous page like this model: "<". It will only put a link if there is a "previous page"
        // $this->my_kyniem->next_page;
        //$this->assertClassHasAttribute("all_pages", $this->my_kyniem, 'message');
        $this->assertTrue(true, 'message');
    }

}
