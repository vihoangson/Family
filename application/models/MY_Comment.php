<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Comment extends MY_Model {
	public $table = 'comment'; // Set the name of the table for this model.
	public $primary_key = 'id'; // Set the primary key
	public function __construct(){
		$this->soft_deletes = FALSE;
		$this->timestamps_format = 'Y-m-d H:i:s';
		$this->return_as = 'object';
		parent::__construct();
	}
}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */