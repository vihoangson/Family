<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote_page extends MY_Controller {

    /**
     * Admin_page constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('MY_Quote', 'quote');
        $this->load->model('files_model');

    }


    /**
     *
     * @url /admin/quote_page/index
     */
    public function index() {


        $this->quote->get();
        $quotes = $this->quote->order_by(' RANDOM() ')
                              ->get_all();

        $this->load->view('admin/quote_page', ['quotes' => $quotes]);
    }


}

/* End of file admin_page.php */
/* Location: ./application/controllers/admin_page.php */