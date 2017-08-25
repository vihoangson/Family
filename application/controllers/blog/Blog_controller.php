<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Blog', 'BlogComment']);
    }

    /**
     * Hiển thị danh sách bài blog
     *
     * @since  20160704120115
     * @return [type] [description]
     */
    public function index() {
        $rs = $this->Blog->order_by("id", "DESC")
                         ->with_blogcomment()
                         ->get_all();
        $this->load->view('blog/index', compact("rs"));
    }

    /**
     * Show 1 bài viết
     *
     * @since  20160704120054
     *
     * @param  [type] $id [description]
     *
     * @return [type]     [description]
     */
    public function detail($id = null) {
        $id = (int) $id;
        $rs = $this->Blog->with_blogcomment("order_by:id,desc")
                         ->get($id);
        $this->load->view('blog/detail', compact("rs"));
    }

    /**
     * [input description]
     * Update | insert blog
     *
     * @since  20160704120031
     *
     * @param  [type] $id [description]
     *
     * @return void
     */
    public function input($id = null) {
        if ($this->input->post()) {
            // Chuẩn bị dữ liệu
            $blog_title   = $this->input->post("title");
            $blog_content = $this->input->post("content");
            $object       = [
                "blog_title"   => $blog_title,
                "blog_content" => $blog_content,
            ];

            if ($this->input->post('id')) {
                // Update blog
                if ($this->Blog->update($object, $this->input->post('id'))) {
                    $this->session->set_flashdata('alert', 'Đã ok');
                } else {
                    $this->session->set_flashdata('alert', 'Đã fail');
                }
            } else {
                // Create new
                if ($this->Blog->insert($object)) {
                    $this->session->set_flashdata('alert', 'Đã ok');
                } else {
                    $this->session->set_flashdata('alert', 'Đã fail');
                }
            }
            // Done redirect to list
            redirect('/blog', 'refresh');
        }

        // Phương thức hiển thị create | update
        if ($id) {
            // update
            $this->load->model('blog');
            $data = $this->blog->get($id);
        } else {
            // create new
            $data = new stdClass();
        }

        $this->load->view('blog/input', compact("data"));
    }

    /**
     * Xóa bài blog
     *
     * @since  20160704120157
     *
     * @param  [type] $id [description]
     *
     * @return [type]     [description]
     */
    public function remove($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('blog')) {
            redirect('/blog', 'refresh');
        }
    }
}

/* End of file Blog_controller.php */
/* Location: ./application/controllers/blog/Blog_controller.php */