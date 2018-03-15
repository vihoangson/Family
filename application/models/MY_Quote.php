<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Quote extends MY_Model {

    public $table       = 'quotes'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key

    public function __construct() {
        $this->soft_deletes        = false;
        $this->timestamps_format   = 'Y-m-d H:i:s';
        $this->return_as           = 'object';
        parent::__construct();
    }

}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */