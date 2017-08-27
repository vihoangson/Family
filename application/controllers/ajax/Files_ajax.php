<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_ajax extends CI_Controller {

    public function index() {
        $files = scandir(FCPATH . "asset/uploads/");
        ?>
        <div class="row">
            <?php
            foreach ($files as $key => $value) {
                if (preg_match("/\.(jpg|png|gif)$/", $value)) {
                    echo "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'><p class='thumbnail'><img src='/asset/uploads/" . $value . "'></p></div>";
                }
            }
            ?>
        </div>
        <?php
    }

    /**
     *
     */
    public function upload_file() {
        if(!preg_match('/\.(png|jpg|gif)$/',$_FILES['userfile']['name'][0])){
            return;
        }
        $_FILES['userfile']['name'][0] = preg_replace('/(\!|\s)/','',$_FILES['userfile']['name'][0] );

        if(move_uploaded_file($_FILES['userfile']['tmp_name'][0], FCPATH . 'asset/uploads/' . $_FILES['userfile']['name'][0]))
        {
            $return = [
                    'status' => 'done',
                       'url' => '/asset/uploads/' . $_FILES['userfile']['name'][0].'',
                       'markdown' => '![](/asset/uploads/' . $_FILES['userfile']['name'][0].')'
            ];
            header("application/json");
            echo json_encode($return);
        }else{
            header("application/json");
            echo json_encode(['status' => 'error']);
        }
    }

}

/* End of file files_ajax.php */
/* Location: ./application/controllers/files_ajax.php */