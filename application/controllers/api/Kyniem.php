<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . "core/REST_Controller.php";

class Kyniem extends REST_Controller {

    /**
     * Kyniem constructor.
     *
     * @param string $config
     */
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->helper("common");

    }

    /**
     * Lấy các ky niem theo ngày
     *
     */
    public function get_in_date_get() {

        $d = $this->get("d");

        $result = $this->_get_kyniem_by_date($d);

        $this->response($result);
    }


    /**
     *
     *
     * @url /api/kyniem/handle_change_date
     */
    public function handle_change_date_post() {

        // Chuyển date thành object date
        $obj_date = date_create_from_format('Y-m-d', $this->post('date_current'));

        // Xử lý option ngày lui hoặc tới
        switch ($this->post('option')) {
            case 'prev':
                $modify = '+1 day';
            break;
            case 'next':
                $modify = '-1 day';
            break;
        }
        // Modify ngày
        date_modify($obj_date, $modify);

        //Chuyển object date thành string
        $str_date = $obj_date->format('Y-m-d');

        // Lấy dữ liệu
        $return = $this->_get_kyniem_by_date($str_date);

        // Xuất ra
        $this->response($return);
    }

    /**
     * Get all record of kyniem
     * order by $get["order_by"]
     *
     * @return json
     *
     * API:GET
     * /api/kyniem/index
     */
    public function index_get() {
        if ($this->input->get('order_by')) {
            $this->db->order_by($this->input->get('order_by'), 'desc');
        } else {
            $this->db->order_by('id', 'desc');
        }
        $data = $this->db->get('kyniem')
                         ->result();
        $this->response($data);
    }

    /**
     * [search_post]
     *
     * @param  $post ["keyword"]
     *
     * @return json
     *
     * API:post
     * param:
     *        keyword: [keyword]
     * /api/kyniem/search
     */
    public function search_post() {
        $rs = [];
        $this->load->model('MY_Kyniem');
        if ($this->input->post()) {
            $rs = $this->MY_Kyniem->search_kyniem($this->input->post("keyword"));
        }
        $this->response($rs);
    }
    /**
     * @param $d
     *
     * @return mixed
     */
    private function _get_kyniem_by_date($d) {
        $sql    = "select * from kyniem where date(kyniem_create) = '" . $d . "' and delete_flg = 0  ";
        $result = $this->db->query($sql)
                           ->result();
        foreach ($result as &$item) {
            $item->kyniem_content = h($item->kyniem_content);
        }
        return $result;
    }
}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */