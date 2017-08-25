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


}

/* End of file files_ajax.php */
/* Location: ./application/controllers/files_ajax.php */