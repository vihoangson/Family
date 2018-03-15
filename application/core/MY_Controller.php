<?php

/**
 * @property Kyniem $kyniem           Kyniem
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library("action");
        $this->load->model(["kyniem", "My_User", "options_model",'my_kyniem']);

        // Rửa tổng cho error status
        $this->error_status = [];

        // Check các trường hợp ảnh hưởng tới hoạt động của site
        // So sánh file config đã được tạo chưa
        $this->check_define_config();

        // Check có cần phải login không
        if ($this->is_check_login()) {
            // Vào 1 trang khác đăng nhập
            if ($this->router->fetch_method() != "login") {
                // Nếu chưa đăng nhập sẽ chuyển đến trang đăng nhập
                if (!$this->session->userdata('user')) {
                    // Chuyển đến trang login
                    redirect('homepage/login', 'refresh');
                }
            } else {
                // Nếu đã login rồi thì cho quay về trang chủ
                if ($this->session->userdata('user')) {
                    redirect('/', ' ');
                }
            }
        } else {
            $default_user = $this->My_User->where("id", 11);
            $this->action->set_authentication($default_user);
        }

        // Set thông số gửi mail của google
        $this->config_email_custom = [
            'protocol'  => 'sendmail',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => FROM_EMAIL,
            'smtp_pass' => FROM_EMAIL_PASS,
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        ];

        // Nếu trong 3 ngày không viết blog thì ô history sẽ bật lên
        $date_dont_write = $this->kyniem->get_count_dont_write();
        if ($date_dont_write > (int) DATE_DONT_WROTE_BLOG) {
            $history_wrote_blog = $this->action->draw_often_wrote_blog_from_now();
            $history_wrote_blog .= "<h1>" . $date_dont_write . " ngày không viết</h1>";
        } else {
            $history_wrote_blog = "";
        }

        // Set dữ liệu cho navbar
        $navbars = [
            "history_wrote_blog" => $history_wrote_blog
        ];

        $this->set_variable_view_for_menu_left_admin();

        $this->load->vars($navbars);

        $options = $this->options_model->get_all_option_by_object();
        $this->load->vars(["options" => $options]);

        /**
         * Size lớn nhất cho hình ảnh
         */
        $option_max_size_img = $this->options_model->get_option("max_size_img");
        if ($option_max_size_img->option_content) {
            $max_size_img = $option_max_size_img->option_content;
        } else {
            $max_size_img = 800;
        }

        $custom_css = $this->options_model->get_option("custom_css");
        $this->load->vars(["custom_css" => $custom_css->option_content]);

        define("MAX_SIZE_IMG", $max_size_img);
    }


    /**
     *
     * [check_status_system]
     * Kiểm tra các trường hợp ảnh hưởng tới vận hành bình thường của website
     *
     * @since  20160623101733
     * @return [array] $this->error_status
     *
     */
    public function check_status_system() {
        // [START] 20160623102429 Kiểm tra ghi file vào folder root/backup_file

        $links_asset = [
            FCPATH . "backup_file",
            FCPATH . "asset/images",
            FCPATH . "asset/js",
            FCPATH . "asset/tmp",
            FCPATH . "asset/template",
            FCPATH . "asset/uploads",
            FCPATH . "asset/file_upload",
        ];

        foreach ($links_asset as $key => $value) {
            if (!is_writable($value)) {
                mkdir($value);
                throw new Exception("Không ghi được file vào folder " . $value . "[Vui lòng tạo mới hoặc chỉnh lại permission cho folder nha]", 1);
            }
        }

        // [END] 20160623102433 Kiểm tra ghi file vào folder root/backup_file
    }

    /**
     * [my_sent_email]
     * Function gửi email cho địa chỉ xác định
     *
     * @param  [type] $options [description]
     *      $options["subject"] // Tiêu đè email
     *      $options["content"] // Nội dung email
     *
     * @return [type]          [description]
     */
    public function my_sent_email($options) {
        if (ALLOW_SENT_MAIL) {
            $this->load->library('email', $this->config_email_custom);
            $this->email->from(FROM_EMAIL, 'Family');
            $this->email->to('vihoangson@gmail.com');
            $this->email->cc('4t.nhauyen@gmail.com');
            $this->email->cc('ngotrichi@gmail.com');
            $this->email->subject($options["subject"]);
            $this->email->message($options["content"]);
            if ($this->email->send()) {
                //echo "<h1>Send mail [".__FUNCTION__."]</h1>";
            } else {
                throw new Exception("Can't sent email", 1);
            }
        }
    }

    /**
     * [backup_db_family]
     * Backup database family
     *
     * @return void
     * @throws Exception
     */
    public function backup_db_family() {
        if (ALLOW_SENT_MAIL) {
            $this->load->library('email', $this->config_email_custom);
            $this->email->from(FROM_EMAIL, 'Family');
            $this->email->to('vihoangson@gmail.com');
            $this->email->cc('4t.nhauyen@gmail.com');
            $this->email->subject("Backup db " . date("Y-m-d h:i:s"));
            $this->email->message(date("Y-m-d h:i:s"));
            $this->email->attach(DB_FILE_FAMILY);
            if ($this->email->send()) {
                echo "<h1>Send mail [" . __FUNCTION__ . "]</h1>";
            } else {
                throw new Exception("Can't backup db", 1);
                echo "<h1>Can't sent mail [" . __FUNCTION__ . "]</h1>";
            }
        }
    }

    public function sent_log() {
        if (ALLOW_SENT_MAIL) {
            $this->load->library('HZip');
            $file_name             = "BK_log_" . date("Ymd_his") . ".zip";
            $config['upload_path'] = check_folder(FCPATH . 'asset/file_upload/custom_banner_' . $position . '/');
            HZip::zipDir(FCPATH . "application/logs", FCPATH . "asset/tmp/" . $file_name);
            $this->load->library('email', $this->config_email_custom);
            $this->email->from(FROM_EMAIL, 'Family');
            $this->email->to('vihoangson@gmail.com');
            $this->email->cc('4t.nhauyen@gmail.com');
            $this->email->subject("Backup log " . date("Y-m-d h:i:s"));
            $this->email->message(date("Y-m-d h:i:s"));
            $this->email->attach(FCPATH . "asset/tmp/" . $file_name);
            if ($this->email->send()) {
                echo "<h1>Send mail [" . __FUNCTION__ . "]</h1>";
            } else {
                throw new Exception("Can't backup db", 1);
                echo "<h1>Can't sent mail [" . __FUNCTION__ . "]</h1>";
            }
        }
    }

    /**
     * [backup_file_images_family]
     * Không dùng hàm này nữa
     */
    public function backup_file_images_family($options = null) {
        return;
        $this->load->library('HZip');
        $file_name = "BK_image_" . date("Ymd_his") . ".zip";
        HZip::zipDir(FCPATH . "asset/images", FCPATH . "asset/tmp/" . $file_name);
        $files = scandir(FCPATH . "asset/tmp");
        if (count($files) > 7) {
            $l_file = [];
            foreach ($files as $key => $value) {
                if (!is_dir(FCPATH . "asset/tmp/" . $value)) {
                    echo "<p>" . $value . "</p>";
                    preg_match("/(\d+)_(\d+)/", $value, $match);
                    if ($match[1]) {
                        $l_file[] = $value;
                    }
                }
            }
            if (!empty($l_file)) {
                sort($l_file);
                unlink(FCPATH . "asset/tmp/" . $l_file[0]);
            }
        }

        if (ALLOW_SENT_MAIL) {
            if (file_exists(FCPATH . "asset/tmp/" . $file_name)) {
                $this->load->library('email', $this->config_email_custom);
                $this->email->from(FROM_EMAIL, 'Family');
                $this->email->to('vihoangson@gmail.com');
                $this->email->cc('4t.nhauyen@gmail.com');
                $this->email->subject("Backup file images " . date("Y-m-d h:i:s"));
                $this->email->message("<h2>Backup file images " . date("Y-m-d h:i:s") . "</h2> <p>Link:" . base_url() . "asset/tmp/" . $file_name . "</p>");
                if ($this->email->send()) {
                    echo "<h1>Send mail [" . __FUNCTION__ . "]</h1>";
                } else {
                    echo "<h1>Can't sent mail [" . __FUNCTION__ . "]</h1>";
                }
            } else {
                echo "<h1>Don't have file [" . __FUNCTION__ . "]</h1>";
            }
        }
    }

    public function do_upload_many_core() {
        $this->load->library('upload');
        $files   = $_FILES;
        $cpt     = count($_FILES['userfile']['name']);
        $error   = [];
        $success = [];
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
            $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
            $_FILES['userfile']['size']     = $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options_core());
            if ($this->upload->do_upload()) {
                $img_info  = $this->upload->data();
                $success[] = $img_info;
                $this->resize_img(FCPATH . "asset/images/" . $img_info['file_name'], 100, 100);
            } else {
                $error[] = $this->upload->display_errors();
            }
        }

        return ["error" => $error, "success" => $success];
    }

    public function do_upload_single_core() {
        $this->load->library('upload');
        $this->upload->initialize($this->set_upload_options_core());
        if ($this->upload->do_upload()) {
            $img_info = $this->upload->data();
            $success  = $img_info;
            $this->resize_img_core(FCPATH . "asset/images/" . $img_info['file_name'], 100, 100);
        } else {
            $error = $this->upload->display_errors();
        }

        return ["error" => $error, "success" => $success];
    }

    private function set_upload_options_core() {
        //upload an image options
        $config                  = [];
        $config['upload_path']   = 'asset/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '1000000';
        $config['max_width']     = '102400';
        $config['max_height']    = '76800';
        $config['overwrite']     = false;

        return $config;
    }

    private function resize_img_core($path, $width, $height) {
        $this->load->library('image_lib');
        $config['image_library']  = 'gd2';
        $config['source_image']   = $path;
        $config['new_image']      = FCPATH . "asset/images/thumb/";
        $config['create_thumb']   = true;
        $config['maintain_ratio'] = true;
        $config['width']          = $width;
        $config['height']         = $height;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    /**
     * So sánh file config đã được tạo chưa
     */
    private function check_define_config() {
        $path_file_config = file_get_contents(FCPATH . "application/config/family/config.php");
        $a1               = $this->getDefineInFile($path_file_config);

        $path_file_config = file_get_contents(FCPATH . "application/config/family/config.sample.php");
        $a2               = $this->getDefineInFile($path_file_config);

        if (!($a1 === array_intersect($a1, $a2) && $a2 === array_intersect($a2, $a1))) {
            $html = '';
            $html .= '<p>application/config/family/config.php</p>';
            $html .= '<p>application/config/family/config.sample.php</p>';
            $html .= '<p>Không đồng nhất với nhau, mời kiểm tra lại</p>';
            $this->log->write_log("ERROR", $html);
        }
    }

    //============ ============  ============  ============
    // getDefineInFile()
    // Lấy tất cả tên các define đổ vào mảng
    //============ ============  ============  ============
    private function getDefineInFile($path_file_config) {
        $array_str = array_unique(explode("\n", $path_file_config));
        $return    = [];
        foreach ($array_str as $key => $value) {
            preg_match("/define\(\"(.+?)\"/", $value, $match);
            if ($match[1]) {
                $return[] = ($match[1]) . "\n";
            }
        }

        return $return;
    }


    /**
     * Check trường hợp bắt buộc phải đăng nhập
     *
     * @return bool
     * True: Phải đăng nhập
     * Fasle: Không phải đăng nhập
     */
    private function is_check_login() {
        if (function_exists('getallheaders')) {
            if (getallheaders()["security"] == VAR_SECURITY) {
                return false;
            }
        }

        // Nếu là testing không cần đăng nhập
        if ($GLOBALS["phpunit"] == true) {
            return false;
        }

        // Nếu là cron hoặc xử lý facebook không cần đăng nhập
        if ($this->router->fetch_method() == "cron" || $this->router->fetch_method() == "fb_callback") {
            return false;
        }

        return true;
    }

    /**
     * Use $this->load->vars set navbar_custom for menu
     */
    protected function set_variable_view_for_menu_left_admin() {
        $this->load->vars([
            "navbar_custom" => [
                ["link" => "/admin/admin_page/session_login", "text" => "Session login"],
                ["link" => "/admin/admin_page/controll_list_login_facebook", "text" => "List login Facebook"],
                ["link" => "/admin/blank_page", "text" => "Blank"],
                ["link" => "/admin/files_controller/show", "text" => "Manager Images"],
                ["link" => "/admin/control_popup", "text" => "Control popup"],
                ["link" => "/admin/admin_page/manager_media", "text" => "Quản lý media"],
                ["link" => "/phpliteadmin.php", "text" => "PHP Sqlite"],
                ["link" => "/admin/manage_background/index", "text" => "Manager background"],
                ["link" => "/admin/quote_page/index", "text" => "Lời vàng ý ngọc"],
            ]
        ]);
    }

}

?>
