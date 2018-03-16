<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . "core/REST_Controller.php";

class Ajax_action extends REST_Controller {

    /**
     * POST
     *
     * @url: /api/ajax_action/sync_db
     */
    public function sync_db_post() {
        if ($this->action->sync_db_server()) {
            $return = ["status" => "success"];
        } else {
            $return = ["status" => "fail"];
        }
        $this->response($return);
    }

    /**
     * @param string $case
     * $case = "file_upload"
     * $case = "images"
     * $case = "db"
     *
     * @url /api/ajax_action/backup_all/file_upload
     * @url /api/ajax_action/backup_all/images
     * @url /api/ajax_action/backup_all/db
     */
    public function backup_all_get($case = null) {
        $this->action->backup_all_project($case);
    }

    /**
     *
     * @param int $value
     *
     * @url /api/ajax_action/change_max_size_img
     */
    public function change_max_size_img_post() {
        $this->load->model("options_model");

        $size = (int) $this->input->post("value");

        if ($size > 800) {
            $size = 800;
        }

        if ($size) {
            if ($this->options_model->save_option("max_size_img", $size)) {
                $return["status"] = "success";
                $return["value"]  = $size;
                $this->response($return);
            }
        }

        $return["status"] = "error";
        $this->response($return);
    }

    /**
     *
     * @param int $value
     * @param int $key
     *
     * @url /api/ajax_action/change_value_options
     */
    public function change_value_options_post() {
        $this->load->model("options_model");
        $value = $this->input->post("value");
        $key   = $this->input->post("key");

        if ($value && $key) {
            if ($this->options_model->save_option($key, $value)) {
                $return["status"] = "success";
                $return["value"]  = $value;
                $return["key"]    = $key;
                $this->response($return);
            }
        }
        $return["status"] = "error";
        $this->response($return);
    }

    /**
     *
     * @param int $value
     * @param int $key
     *
     * @url /api/ajax_action/get_all_options
     */
    public function get_all_options_get() {
        $this->load->model('Options_model');
        $this->options_model->disable_option_cache();
        $this->response($this->options_model->get_all_option());
    }


}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */