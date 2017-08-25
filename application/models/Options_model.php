<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @property Options_model $options_model                 Loads framework components.
 */
class Options_model extends CI_Model {

    public function __construct() {
        $this->ddl_install();
    }

    private function ddl_install() {
        if (!$this->db->table_exists("options")) {
            $sql = "CREATE TABLE 'options' ('id' INTEGER PRIMARY KEY NOT NULL, 'option_key' TEXT NOT NULL, 'option_content' TEXT, 'option_create' DATETIME);";
            $this->db->query($sql);
            $this->save_option("popup", "1");
            $this->save_option("popup_flag", "1");
            $this->save_option("popup_session", "1");
        }
    }

    //============ ============  ============ ============
    //
    //============ ============  ============ ============
    public function get_all_option() {
        return $this->db->get('Options')
                        ->result();
    }

    public function get_all_option_by_object() {
        $return = [];
        $data   = $this->get_all_option();
        foreach ($data as $value) {
            $return[$value->option_key] = $value;
        }

        return $return;
    }

    //============ ============  ============ ============
    //
    //============ ============  ============ ============
    public function get_option($key) {
        if (!$key) {
            return [];
        }
        $this->db->where('option_key', $key);

        return $this->db->get('Options')
                        ->row();
    }

    //============ ============  ============ ============
    //
    //============ ============  ============ ============
    /**
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function save_option($key, $value) {
        if (!$key) {
            return false;
        }
        if ($this->db->where("option_key", $key)
                     ->count_all_results('options') == 0
        ) {
            if ($this->db->insert("options", ["option_key"     => $key,
                                              "option_content" => $value,
                                              "option_create"  => date("Y-m-d h:i:s")
            ])
            ) {
                return true;
            }
        } else {
            if ($this->db->where("option_key", $key)
                         ->update("options", [
                                 "option_create"  => date("Y-m-d h:i:s"),
                                 "option_content" => $value
                             ])
            ) {
                return true;
            }
        }

        return false;
    }

    //============ ============  ============ ============
    // Input
    // $keys= [option_key1,option_key2];
    //
    // Output: arrayObject
    //
    // Ex:
    // $keys = ["popup","popup_flag","popup_session"];
    // $data1 = $this->Options_model->get_many_option($keys);
    //============ ============  ============ ============
    public function get_many_option($keys) {
        if (!$keys) {
            return [];
        }
        $return = [];
        foreach ($keys as $key => $value) {
            $return[$value] = $this->get_option($value);
        }

        return $return;
    }

    //============ ============  ============ ============
    // Input
    // $data= [
    //		option_key1=>option_content1,
    //		option_key2=>option_content2
    // ];
    //
    // Output: Boolean
    //
    // Ex:
    // $data = ["popup"=>1,"popup_flag"=>1,"popup_session"=>1];
    // d($this->Options_model->save_many_option($data));
    //
    //============ ============  ============ ============
    public function save_many_option($data) {
        if (!$data) {
            return false;
        }
        $flag = true;
        foreach ($data as $key => $value) {
            if (!$this->save_option($key, $value)) {
                $flag = false;
            }
        }

        return $flag;
    }
}

/* End of file Options.php */
/* Location: ./application/models/Options.php */