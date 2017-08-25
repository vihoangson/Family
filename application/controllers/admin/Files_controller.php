<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('files_model');
        $this->path_file_upload = FCPATH . "asset/file_upload/";
    }

    public function index() {
        dd($this->dirToArray($this->path_file_upload));
    }

    /**
     * @param $path
     * @param $width
     * @param $height
     *
     * @return bool
     */
    private function resize_img($path, $width, $height) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image']  = $path;
        $config['width']         = $width;
        $config['height']        = $height;
        $this->image_lib->initialize($config);

        return $this->image_lib->resize();
    }

    /**
     * Function controller
     */
    public function show() {
        $rs = $this->files_model->find()
                                ->result();
        foreach ($rs as &$item) {
            $this->_prepare_thumbnail_to_show($item);
        }
        $this->load->view('admin/file_list', compact("rs"));
    }

    public function do_upload() {
        if ($_FILES["userfile"]) {
            $config = [
                'upload_path'   => FCPATH . "asset/uploads/",
                'allowed_types' => 'gif|jpg|png',
                'max_size'      => '10000',
                'max_width'     => '20000',
                'max_height'    => '20000'
            ];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = ['error' => $this->upload->display_errors()];
                $this->session->set_flashdata('item', ["danger" => "Upload có lỗi [" . $this->upload->display_errors() . "]"]);
            } else {
                $this->max_size_upload_timeline = $this->config->item('var_max_size_img');
                $data                           = ['upload_data' => $this->upload->data()];

                // Kiểm tra có vượt quá khung giới hạn không
                if ($data["upload_data"]["image_height"] > $this->max_size_upload_timeline || $data["upload_data"]["image_width"] > $this->max_size_upload_timeline) {
                    // Nếu vượt qua thì resize lại
                    $this->resize_img($data["upload_data"]["full_path"], $this->max_size_upload_timeline, $this->max_size_upload_timeline);
                }

                // Chuẩn bị object để lưu vào db
                $object = [
                    "files_title" => $this->input->post('file_title'),
                    "files_name"  => $data["upload_data"]['file_name'],
                    "files_path"  => "/asset/uploads/",
                    "files_size"  => @$data["upload_data"]['image_size_str'],
                    "files_type"  => $data["upload_data"]['file_type'],
                ];
                try {
                    $this->files_model->create($object);
                } catch (Exception $e) {
                    dd($e);
                }

                $this->session->set_flashdata('item', ["success" => "Upload thành công"]);
            }

            redirect('admin/files_controller/show', 'refresh');
        }

        $rs = $this->files_model->find()
                                ->result();
        $this->load->view('admin/form_upload', compact("rs"));
    }


    public function delete($id) {
        if ($this->files_model->detele($id)) {
            redirect('/admin/files_controller/show', 'refresh');
        } else {
            redirect('404', 'refresh');
        }
    }

    public function edit($id) {
        $rs = $this->files_model->find(["id" => $id])
                                ->row();
        $this->load->view('admin/files_edit', compact("rs"));
    }

    public function rotate_img_files($id, $case = null) {
        preg_match("/(\w+)_(\w+)/", $id, $match);
        $rs = $this->files_model->find(["id" => $match[2]])
                                ->row();
        if (empty($rs->files_name)) {
            return false;
        }
        if ($match[1] == "files") {
            $path = $rs->files_path . $rs->files_name;
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
        redirect('/admin/files_controller/edit/' . $rs->id, 'refresh');
    }

    private function array_values_recursive($array) {
        $arrayValues = [];

        foreach ($array as $value) {
            if (is_scalar($value) OR is_resource($value)) {
                $arrayValues[] = $value;
            } elseif (is_array($value)) {
                $arrayValues = array_merge($arrayValues, $this->array_values_recursive($value));
            }
        }

        return $arrayValues;
    }

    private function dirToArray($dir) {

        $result = [];

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, [".", ".."])) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * @param $item
     */
    private function _prepare_thumbnail_to_show(&$item) {
        preg_match("/(asset.+)$/", $item->files_path, $match);

        $path_file     = (FCPATH . $match[1] . $item->files_name);
        $path_file_new = (FCPATH . $match[1] . "thumb_" . $item->files_name);

        $thumb_img = "/" . $match[1] . "thumb_" . $item->files_name;
        $full_img  = "/" . $match[1] . $item->files_name;

        if (!file_exists($path_file_new)) {
            if (file_exists($path_file)) {
                if (in_array($item->files_type, ['image/gif', 'image/png', 'image/jpg', 'image/jpeg'])) {
                    copy($path_file, $path_file_new);
                    if ($this->resize_img($path_file_new, 100, 100)) {
                        $thumb_img = "/" . $match[1] . "thumb_" . $item->files_name;
                    } else {

                        unlink($path_file_new);
                    }
                }
            } else {
                $thumb_img = "http://placehold.it/200x200";
            }
        }
        $item->full_img  = $full_img;
        $item->thumb_img = $thumb_img;

    }
}

/* End of file Files_controller.php */
/* Location: ./application/controllers/admin/Files_controller.php */