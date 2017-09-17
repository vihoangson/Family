<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_background extends MY_Controller {

    public function __construct() {
        parent::__construct();

        // Set menu left admin
        $this->set_variable_view_for_menu_left_admin();
    }

    /**
     * Quản lý background
     *
     * @link /admin/manage_background/index
     * @author hoang_son
     * @since 2017-09-12
     */
    public function index() {
        $this->load->view('admin/manage_background/index');
    }

}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */