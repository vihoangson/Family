<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Kyniem extends MY_Model {

    public $table       = 'kyniem'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key

    public function __construct() {
        $this->soft_deletes        = false;
        $this->timestamps_format   = 'Y-m-d H:i:s';
        $this->return_as           = 'object';
        $this->has_many['comment'] = [
            'foreign_model' => 'MY_Comment',
            'foreign_table' => 'comment',
            'foreign_key'   => 'kyniem_id',
            'local_key'     => 'id'
        ];
        parent::__construct();
    }

    public function search_kyniem($keyword) {
        if ($keyword) {
            $this->db->or_like('kyniem_title', $keyword);
            $this->db->or_like('kyniem_content', $keyword);
            $rs = $this->db->get('kyniem')
                           ->result();

            return $rs;
        }

        return [];
    }

    public function get_data_in_date() {
        dd($this->group_by("date(kyniem_create)"));

        return $this->group_by("date(kyniem_create)")
                    ->get();
    }

    /**
     *
     * @return DateTime
     */
    public function get_date_closest($case, $date) {
        $obj_date = null;

        switch ($case) {
            case 'left':
                $this->db->where('date(kyniem_create) <', $date)
                         ->order_by('kyniem_create', 'desc');
            break;
            case 'right':
                $this->db->where('date(kyniem_create) >', $date)
                         ->order_by('kyniem_create');
            break;
        }
        $return = $this->db->limit(1)
                           ->get('kyniem')
                           ->result()[0]->kyniem_create;
        $this->log->write_log('debug', $this->db->last_query());
        $obj_date = date_create_from_format('Y-m-d h:i:s', $return);

        return $obj_date;
    }
}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */