<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_User extends MY_Model {

    public $table       = 'user'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key

    public function __construct() {
        parent::__construct();
    }
}

/* End of file User.php */
/* Location: ./application/models/User.php */