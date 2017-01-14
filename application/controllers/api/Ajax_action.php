<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Ajax_action extends REST_Controller {

    /**
     * POST
     *
     * @url: /api/ajax_action/sync_db
     */
    public function sync_db_post(){
        if($this->action->sync_db_server()){
           $return = ["status"=>"success"];
        }else{
            $return = ["status"=>"fail"];
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
    public function backup_all_get($case = null){
        $this->action->backup_all_project($case);
    }

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */