<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends MY_Controller {

    private $max_size_upload_timeline = 800;

    public function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('timeline'))) {
            if ($this->router->fetch_method() != "logintimeline") {
                redirect('/timeline/logintimeline', 'refresh');
            }
        }
        $this->load->model('Timeline_model');
        $this->automatic_create_time_line();
    }

    public function logouttimeline() {
        $this->session->unset_userdata('timeline');
        redirect('/timeline', 'refresh');
    }

    //============ ============  ============  ============
    //  url: /timeline/mansonry/
    public function mansonry() {
        $this->load->model('MY_Kyniem');
        $data = $this->MY_Kyniem->order_by(["id" => "desc"])
                                ->get_all();
        $this->load->view('tmp/mansonry', compact("data"));
    }

    public function logintimeline() {
        if ($this->input->post("pass")) {
            if ($this->input->post("pass") == $this->config->item("password_timeline")) {
                $array = [
                    'timeline' => 'on'
                ];
                $this->session->set_userdata($array);
                redirect('/timeline', 'refresh');
            } else {
                $this->session->set_flashdata('item', ["danger" => "Đăng nhập không đúng !"]);
            }
        } else {
        }
        $this->load->view('timeline/login_timeline');
    }

    private function automatic_create_time_line() {
        $this->_is_show();
        $this->db->order_by('timeline_create', 'desc');
        $rs = $this->db->get('timeline', 1)
                       ->row();
        if (!empty($rs)) {
            preg_match("/(.+)\s(.+)/", $rs->timeline_create, $match);
            $datetime1 = new DateTime($rs->timeline_create);
            $datetime2 = new DateTime(date("Y-m-d h:i:s"));
            $interval  = $datetime1->diff($datetime2);
            if ($interval->d > 0) {
            }
        }
    }

    private function create_timeline_null($timestamp) {
        $object = [
            "timeline_date"    => date("Y-m-d", $timestamp),
            "timeline_image"   => "family.jpg",
            "timeline_create"  => date("Y-m-d h:i:s", $timestamp),
            "timeline_modifie" => date("Y-m-d h:i:s", $timestamp),
        ];
        if ($this->db->insert('timeline', $object)) {
            return true;
        }

        return false;
    }

    private function _is_show() {
        $this->db->where('delete_flg', 0);
    }

    public function index() {
        $condition = [];
        if (!empty($this->input->get("year"))) {
            $condition["year"] = $this->input->get("year");
        }
        if (!empty($this->input->get("tag"))) {
            $condition["tag"] = $this->input->get("tag");
        }
        if (!empty($this->input->get("keyword"))) {
            $condition["keyword"] = $this->input->get("keyword");
        }

        $tl   = $this->Timeline_model->getAll($condition);
        $data = [
            "tl" => $tl
        ];
        $this->load->view('timeline/show_list', $data);
    }

    public function edit($id = null) {
        if ($id) {
            $rs = $this->Timeline_model->getById($id);
        }
        if ($this->input->post()) {
            $upload = $this->do_upload();
            if ($id) {
                $data["id"] = $id;
            }
            $data["timeline_image"] = $upload["file_name"];
            $data["timeline_title"] = set_value("timeline_title");
            $data["timeline_date"]  = set_value("timeline_date");
            $data["timeline_tag"]   = set_value("timeline_tag");
            $data["timeline_note"]  = set_value("timeline_note");
            $this->Timeline_model->save($data);
        }
        $this->load->view('timeline/timeline_edit', ["rs" => $rs]);
    }

    public function delete($id = null) {
        $this->Timeline_model->deleteById($id);
    }

    private function do_upload() {
        $this->load->library('upload');
        $files                          = $_FILES;
        $_FILES['userfile']['name']     = $files['timeline_image']['name'];
        $_FILES['userfile']['type']     = $files['timeline_image']['type'];
        $_FILES['userfile']['tmp_name'] = $files['timeline_image']['tmp_name'];
        $_FILES['userfile']['error']    = $files['timeline_image']['error'];
        $_FILES['userfile']['size']     = $files['timeline_image']['size'];

        $this->upload->initialize($this->set_upload_options());
        if ($this->upload->do_upload()) {
            $return = $this->upload->data();
            if ($return["image_height"] > $this->max_size_upload_timeline || $return["image_width"] > $this->max_size_upload_timeline) {
                $this->resize_img($return["full_path"], $this->max_size_upload_timeline, $this->max_size_upload_timeline);
            }
            $this->session->set_flashdata('item', ["success" => "Đã upload thành công"]);
        } else {
            $this->session->set_flashdata('item', ["danger" => $this->upload->display_errors()]);
        }

        return $return;
    }

    private function resize_img($path, $width, $height) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']  = $path;
        $config['width']         = $width;
        $config['height']        = $height;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    private function set_upload_options() {
        $config                  = [];
        $config['upload_path']   = 'asset/images/timeline/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '1000000';
        $config['max_width']     = '102400';
        $config['max_height']    = '76800';
        $config['overwrite']     = false;

        return $config;
    }

    public function add_picture() {
        $this->load->view('timeline/add_picture');
    }

    public function rotate_img_timeline($id, $case = null) {
        preg_match("/(\w+)_(\w+)/", $id, $match);
        $rs = $this->Timeline_model->getById($match[2]);
        if (empty($rs->timeline_image)) {
            return false;
        }
        if ($match[1] == "timeline") {
            $path = FCPATH . "asset/images/timeline/" . $rs->timeline_image;
        }
        $this->load->library('image_lib');
        $config                  = [];
        $config['image_library'] = 'gd2';
        $config['source_image']  = $path;
        switch ($case) {
            case "right":
                $config['rotation_angle'] = '90';
            break;
            default:
                $config['rotation_angle'] = '270';
            break;
        }
        $this->image_lib->initialize($config); // reinitialize it instead of reloading
        if ($this->image_lib->rotate()) {
            $this->session->set_flashdata('item', ['success' => "Xoay hình thành công"]);
        } else {
            $this->session->set_flashdata('item', ['danger' => "Không xoay được hình"]);
        }
        redirect('/timeline/edit/' . $rs->id, 'refresh');
    }

    private function delete_all() {
        if (false) {
            $this->Timeline_model->deleteById(1, "all");
        }
    }

}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */