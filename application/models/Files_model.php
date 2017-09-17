<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_model extends CI_Model {

    private $_table = "files";

    public function __construct() {
        parent::__construct();
        $this->install_db();
    }

    public function entity_db() {
        $field = [
            "id",
            "files_name",
            "files_path",
            "files_size",
            "files_type",
            "delete_flg"
        ];

        return $field;
    }

    public function detele($id) {
        $this->db->where('id', $id);
        $rs = $this->db->get($this->_table, 1)
                       ->row();
        unlink($rs->files_path . $rs->files_name);
        $this->db->where('id', $id);
        if ($this->db->delete($this->_table)) {
            return true;
        }

        return false;
    }

    public function find($condition = null) {
        if ($condition["files_name"]) {
            $this->db->where('files_name', $condition["files_name"]);
        }
        if ($condition["id"]) {
            $this->db->where('id', $condition["id"]);
        }

        return $this->db->get($this->_table);
    }

    public function create($data) {
        $this->db->insert($this->_table, $data);
    }

    public function install_db() {

        if ($this->db->query("SELECT name FROM sqlite_master WHERE name='files'")
                     ->num_rows() == 0
        ) {
            $sql = "
			CREATE TABLE 'files' ('id' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 'files_name' TEXT NOT NULL, 'files_path' TEXT, 'files_size' REAL, 'files_type' TEXT, 'delete_flg' INTEGER NOT NULL DEFAULT 0 , 'files_title' TEXT);
		";

            $this->db->query($sql);
        }
    }

    /**
     * @param $options
     *
     * @return mixed
     */
    public function get_by_name($options) {
        return $this->db->where('name',$options)->get('files_position')->row();
    }

}

/* End of file Timeline_model.php */
/* Location: ./application/models/Timeline_model.php */