<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Action
 *
 * @property Action        $action                 Loads framework components.
 * @property CI_Controller $ci
 *
 */
class Action {

    protected $ci;

    public function __construct() {
        $this->ci =& get_instance();
    }

    /**
     * [archive_log description]
     *
     * @since  20160704132530
     *
     * @param  [type] $key     [description]
     * @param  [type] $content [description]
     *
     * @return [type]          [description]
     *
     *  Using:
     * $this->action->archive_log("login_facebook","login ".time());
     */
    public function archive_log($key, $content) {
        $object = [
            "archive_key"     => $key,
            "archive_content" => $content,
            "archive_create"  => date("Y-m-d h:i:s"),
        ];
        $this->ci->db->insert('archive', $object);
    }

    /**
     * [archive_log_read description]
     *
     * @since  20160704132512
     *
     * @param  [type] $key [description]
     *
     * @return [type]      [description]
     *
     *  Using:
     * dd($this->action->archive_log_read("login_facebook"));
     * dd($this->action->archive_log_read("login_%"));
     * ...
     */
    public function archive_log_read($key) {
        $rs = $this->ci->db->where("archive_key like '$key' ")
                           ->order_by("id", "desc")
                           ->get('archive')
                           ->result();

        return $rs;
    }

    public function check_valid_add_new() {

        if ($this->ci->input->post("content")) {
            return true;
        }
        throw new Exception("Khong duoc");

    }


    /**
     * Set quyền đăng nhập
     *
     * @param My_User $default_user
     *
     * @return void
     */
    public function set_authentication(My_User $user) {
        if ($info_user = $user->get()) {
            $username = $info_user->username;
            $user_id  = $info_user->id;
            $array    = [
                'user'        => $username,
                'user_id'     => $user_id,
                'auth_source' => 'bosonmesuemkem',
                'time_now'    => time(),
            ];
            $this->ci->session->set_userdata($array);
        } else {
            throw new Exception("Can't get info user");
        }
    }

    /**
     * Lấy tất cả các ngày thuộc 1 năm xác định
     *
     * @param $year int
     *
     * @return array
     * $return = [
     * "2016-01-01",
     * "2016-01-02",
     * "2016-01-03",
     * "2016-01-04",
     * "2016-01-05",
     * ...
     * ];
     */
    public function get_date_in_year($year) {
        $date_flow    = new DateTime($year . "-01-01");
        $date_in_year = [];
        while ($date_flow->format("Y") == $year) {
            $date_in_year[] = $date_flow->format("Y-m-d");
            $date_flow->modify("+1 day");
        }

        return array_reverse($date_in_year);
    }

    /**
     * Lấy tất cả các ngày thuộc 1 năm bắt đầu từ ngày hôm nay
     *
     * @return array
     * $return = [
     * "2016-01-01",
     * "2016-01-02",
     * "2016-01-03",
     * "2016-01-04",
     * "2016-01-05",
     * ...
     * ];
     */
    public function get_date_from_now() {
        $date_flow    = new DateTime();
        $date_in_year = [];
        $step         = 365;
        while ($step > 0) {
            $date_in_year[] = $date_flow->format("Y-m-d");
            $date_flow->modify("-1 day");
            $step--;
        }

        return $date_in_year;
    }

    /**
     * Lấy dữ liệu từ server về
     *
     * @return boolean
     * @throws Exception
     */
    public function sync_db_server() {
        if ($_SERVER["SERVER_NAME"] != "family.vihoangson.com") {
            $m = file_get_contents("http://family.vihoangson.com/application/models/db/family");
            if ($m) {
                copy(APPPATH . "models/db/family", FCPATH . "backup_file/family_backup_" . date("Y_m_d__h_i_s"));
                file_put_contents(APPPATH . "models/db/family", $m);
            } else {
                return false;
            }

            return true;
        }
    }

    /**
     * Vẽ history viết blog của gia đình 1 nam tinh tu nam hiện tại
     *
     * @return html_string
     */
    public function draw_often_wrote_blog_from_now() {
        $this->ci->load->model("kyniem");
        $date      = $this->ci->kyniem->get_all_date_in_year_has_wrote(NOW);
        $html_grid = $this->draw_grid($date);

        return $html_grid;
    }

    /**
     * Vẽ history viết blog của gia đình theo năm
     *
     * @return html_string
     */
    public function draw_often_wrote_blog_by_year($year) {
        $this->ci->load->model("kyniem");
        $date      = $this->ci->kyniem->get_all_date_in_year_has_wrote("IN_YEAR", $year);
        $html_grid = $this->draw_grid($date);

        return $html_grid;
    }

    /**
     * Lấy dữ liệu vẽ ra grid
     *
     * @param $data
     *
     * @return html_string
     */
    public function draw_grid($data) {
        $max_value = max($data);
        $m         = new DateTime(end(array_keys($data)));
        $date_left = ($m->format("N") % 7) + 6;
        for ($i = 0; $i < $date_left; $i++) {
            $data[] = -1;
        }
        $data = array_reverse($data);
        $html = "";
        $i    = 0;
        if ($this->ci->kyniem->history_auth == null) {
            //$html .= '<h2>All page history wrote blog</h2>';
        } else {
            //$html .= '<h2>Your history wrote blog</h2>';
        }
        $html .= '
            
            <div id="gird_date">
            <div class="week">';
        foreach ($data as $key => $item) {

            if ($i % 7 == 0) {
                $html .= '</div><div class="week">';
            }

            // Nếu có bài viết
            if ($item > 0) {

                // Khởi tạo $name_class
                $name_class = "has";

                // Tính phần trăm của từng ngày
                $arrange = round(($item / $max_value) * 100);
                if ($arrange < 25) {
                    $name_class .= " has_1";
                } elseif ($arrange <= 25 && $arrange < 50) {
                    $name_class .= " has_2";
                } elseif ($arrange <= 50 && $arrange < 75) {
                    $name_class .= " has_3";
                } elseif ($arrange > 75) {
                    $name_class .= " has_4";
                }

                // Nếu có tình trạng đặc biết thì thêm class màu đỏ vào
                $status = $this->ci->kyniem->check_status($key);
                if ($status > 0) {
                    $name_class .= " status_important";
                }

            } // Phần này để không hiện ở những ngày đầu tiên
            elseif ($item == -1) {
                $name_class = "no_show";
            } // Những ngày không có bài viết
            else {
                $name_class = "no_has";
            }
            $html .= "<div data-date='" . $item . "' id='date-$key' class='date " . $name_class . "' title='" . $key . "'></div>";
            $i++;
        }
        $html .= '</div>
        </div>
        <div class="clearfix"></div>
        <hr>
        ';

        return $html;
    }

    /**
     * Tạo file backup file hình ảnh
     */
    public function backup_all_project($case = "db") {
        $this->ci->load->helper("url");
        $this->ci->load->library("zip");
        switch ($case) {
            case "file_upload":
                $this->ci->zip->read_dir(FCPATH . "asset/file_upload");
            break;
            case "images":
                $this->ci->zip->read_dir(FCPATH . "asset/images");
            break;
            default:
                $case = "db";
                $this->ci->zip->read_dir(APPPATH . "models/db");
            break;
        }
        $this->ci->zip->download("backup_" . $case . "_" . date("Ymd_His") . ".zip");
        $this->ci->zip->clear_data();
    }

}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
