<?php

/**
 * Class Common_service
 */
class Common_service {

    private static $instance;
    private static $dem_so_ngay;
    private static $all_kyniem;

    /**
     * Cấu trúc Singleton nếu đã load rồi ko load lại nữa
     *
     * @return mixed
     */
    public static function get_instance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Lấy tổng số ngày từ lúc sinh tới hiện tại của Kem
     *
     * @return int
     * @example Common_service::GetDayKem();
     */
    public static function GetDayKem() {
        if (null === static::$dem_so_ngay) {
            $date1               = date_create(date("Y-m-d h:i:s", time()));
            $date2               = date_create(NGAYDUSINH);
            $diff_obj            = $date1->diff($date2);
            static::$dem_so_ngay = $diff_obj->days;
        }

        return static::$dem_so_ngay;
    }

    /**
     * Lấy tất cả thông tin từ db ra biến
     *
     * @return int
     * @example Common_service::get_db_service(3);
     */
    public static function get_db_service($limit = null) {
        if (null === static::$all_kyniem) {
            /** @var CI_Controller $ci */
            $ci = &get_instance();
            if (!is_null($limit)) {
                $ci->db->limit($limit);
            }
            static::$all_kyniem = $ci->db->select('*')
                                         ->from("kyniem")
                                         ->get()
                                         ->result_array();
        }

        return static::$all_kyniem;

    }

    /**
     * Lấy tổng số ngày từ lúc sinh tới hiện tại của Kem
     *
     * @return int
     * @example Common_service::getThemes();
     */
    public static function getThemes() {

        /** @var MY_Controller $ci */
        $ci = &get_instance();

        $option_theme_name = $ci->options_model->get_option('theme_name');

        // Check is exits
        if(!$option_theme_name){
            // Set default option theme_name
            $ci->options_model->save_option('theme_name','default');
            $option_theme_name = $ci->options_model->get_option('theme_name');
        }

        $theme_name = $option_theme_name->option_content;

        // Check file exists
        if(!file_exists(BASEPATH . '../asset/themes/'.$theme_name.'/style.css')){
            return;
        }

        //Set var to render
        $ci->load->vars('load_theme', '<link href="\asset\themes\\' . $theme_name . '\style.css" rel="stylesheet">');

        return;

    }

}