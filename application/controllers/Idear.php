<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Idear extends MY_Controller {

    private $max_size_upload_timeline = 800;

    public function __construct() {

        parent::__construct();

        $this->load->library('image_lib');
        // ============ ============  ============  ============
        // Kiểm tra folder
        //
        $folders = [
            FCPATH . "asset/images/",
            FCPATH . "asset/images/idear/",
            FCPATH . "asset/images/idear/thumb/",
        ];
        foreach ($folders as $key => $value) {
            // Fucntion in common_helper
            check_folder($value);
        }
        //
        // ============ ============  ============  ============

        // ============ ============  ============  ============
        // Khởi tạo DB
        //
        if (!$this->db->table_exists("idear")) {
            $this->db->query("CREATE TABLE 'idear' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'idear_title' TEXT, 'idear_content' TEXT, 'idear_img' TEXT, 'idear_create' TEXT);");
        }
        //
        //  ============ ============  ============  ============
    }

    public function detail($id) {
        $rs = $this->db->where('id', $id)
                       ->get('idear')
                       ->row();
        $this->load->view('idear/detail', compact("rs"));
    }

    public function index() {
        $rs = $this->db->get('idear')
                       ->result();
        $this->load->view('idear/index', compact("rs"));
    }

    public function edit($id = null) {
        if ($this->input->post()) {
            if ($_FILES["userfile"]["name"][0] != "") {
                $ul  = $this->do_upload();
                $dt  = $this->db->where('id', $id)
                                ->get("idear")
                                ->row();
                $img = json_decode($dt->idear_img, true);
                foreach ($ul["success"] as $key => $value) {
                    $img[] = $value["file_name"];
                }
                $json_img = json_encode($img);
            }
            $object = [
                "idear_title"   => $this->input->post("txt_title"),
                "idear_content" => $this->input->post("txt_content"),
                "idear_create"  => date("Y-m-d h:i:s", time()),
            ];
            if ($json_img) {
                $object["idear_img"] = $json_img;
            }
            if (empty($id)) {
                if ($this->db->insert('idear', $object)) {
                    $this->session->set_flashdata('alert', 'Đã lưu idear');
                    redirect('/idear', 'refresh');
                }
            } else {
                if ($this->db->where("id", $id)
                             ->update('idear', $object)
                ) {
                    $this->session->set_flashdata('alert', 'Đã lưu idear');
                    redirect('/idear/detail/' . $id, 'refresh');
                }
            }
        }
        if ($id) {
            $rs = $this->db->where('id', $id)
                           ->get("idear")
                           ->row();
        }
        $this->load->view('idear/edit', compact("rs"));
    }

    public function ajax_delete_img() {
        $img_delete = $this->input->post('img');
        $rs         = $this->db->like("idear_img", "$img_delete")
                               ->get("idear")
                               ->row();
        $imgs       = json_decode($rs->idear_img, true);
        $key        = array_search($img_delete, $imgs);
        if (false !== $key) {
            unset($imgs[$key]);
        }
        $imgs      = array_values($imgs);
        $idear_img = json_encode($imgs);
        if ($this->db->where("id", $rs->id)
                     ->update('idear', compact("idear_img"))
        ) {
            echo 1;
        } else {
            echo 0;
        }

    }

    private function set_upload_options() {
        //upload an image options
        $config                  = [];
        $config['upload_path']   = 'asset/images/idear/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '1000000';
        $config['max_width']     = '102400';
        $config['max_height']    = '76800';
        $config['overwrite']     = false;

        return $config;
    }

    private function do_upload() {
        $this->load->library('upload');
        $files   = $_FILES;
        $cpt     = count($_FILES['userfile']['name']);
        $error   = [];
        $success = [];
        for ($i = 0; $i < $cpt; $i++) {
            preg_match("/\.(\w+)$/", $files['userfile']['name'][$i], $match);
            $_FILES['userfile']['name']     = time() . "." . $match[1];
            $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
            $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
            $this->upload->initialize($this->set_upload_options());
            if ($this->upload->do_upload()) {
                $img_info  = $this->upload->data();
                $success[] = $this->upload->data();
                $this->resize_img(FCPATH . "asset/images/idear/" . $img_info['file_name'], 100, 100);
            } else {
                $error[] = $this->upload->display_errors();
            }
        }

        return ["error" => $error, "success" => $success];
    }


    private function resize_img($path, $width, $height) {
        $config['source_image'] = $path;
        $namefile               = basename($path);
        $config['new_image']    = FCPATH . "asset/images/idear/thumb/" . $namefile;
        $config['width']        = $width;
        $config['height']       = $height;
        $this->image_lib->initialize($config);

        return $this->image_lib->resize();
    }

    public function delete($id) {
        $content = json_encode($this->db->where("id", $id)
                                        ->get('idear')
                                        ->row());
        $this->action->archive_log("delete_idear", $content);
        if ($this->db->where("id", $id)
                     ->delete('idear')
        ) {
            redirect('/idear/', 'refresh');
        }
    }


}

/* End of file Timeline.php */
/* Location: ./application/controllers/Timeline.php */