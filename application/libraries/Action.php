<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Action
 * @property Action           $action                 Loads framework components.
 * @property CI_Controller           $ci
 *
 */
class Action
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	/**
	 * [archive_log description]
	 *
	 * @since 20160704132530
	 * @param  [type] $key     [description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 * 
	 *  Using:
	 * $this->action->archive_log("login_facebook","login ".time());
	 */
	public function archive_log($key,$content){
		$object=[
			"archive_key" => $key,
			"archive_content" => $content,
			"archive_create" => date("Y-m-d h:i:s"),
		];
		$this->ci->db->insert('archive', $object);
	}

	/**
	 * [archive_log_read description]
	 * 
	 * @since  20160704132512
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 *
	 *  Using:
	 * dd($this->action->archive_log_read("login_facebook"));
	 * dd($this->action->archive_log_read("login_%"));
	 * ...
	 */
	public function archive_log_read($key){
		$rs = $this->ci->db->where("archive_key like '$key' ")->order_by("id","desc")->get('archive')->result();
		return $rs;
	}

	public function check_valid_add_new()
	{

		if($this->ci->input->post("content")){
			return true;
		}
		throw new Exception("Khong duoc");

	}


	/**
	 * Set quyền đăng nhập
	 *
	 * @param My_User $default_user
	 * @return void
     */
	public function set_authentication(My_User $user)
	{
		if($info_user = $user->get()){
			$username = $info_user->username;
			$user_id = $info_user->id;
			$array = array(
				'user' => $username,
				'user_id' => $user_id,
				'auth_source' => 'bosonmesuemkem',
				'time_now'=>time(),
			);
			$this->ci->session->set_userdata($array);
		}else{
			throw new Exception("Can't get info user");
		}
	}

    /**
     * @param $year int
     * @return array
     */
    public function get_date_in_year($year)
    {
        $date_flow = new DateTime($year."-01-01");
        $date_in_year = [];
        while($date_flow->format("Y") == $year){
            $date_in_year[] = $date_flow->format("Y-m-d");
            $date_flow->modify("+1 day");
        }
        return array_reverse($date_in_year);
    }

    /**
     * @param $year int
     * @return array
     */
    public function get_date_from_now()
    {
        $date_flow = new DateTime();
        $date_in_year = [];
        $step = 365;
        while($step > 0){
            $date_in_year[] = $date_flow->format("Y-m-d");
            $date_flow->modify("-1 day");
            $step-- ;
        }
        return $date_in_year;
    }

	/**
	 * Lấy dữ liệu từ server về
	 * @return boolean
	 * @throws Exception
     */
	public function sync_db_server()
	{
		if($_SERVER["SERVER_NAME"]!="family.vihoangson.com"){
			$m = file_get_contents("http://family.vihoangson.com/application/models/db/family");
			if($m){
				copy(APPPATH."models/db/family",FCPATH."backup_file/family_backup_".date("Y_m_d__h_i_s"));
				file_put_contents(APPPATH."models/db/family",$m);
			}else{
				return false;
			}
			return true;
		}
	}


}

/* End of file Action.php */
/* Location: ./application/libraries/Action.php */
