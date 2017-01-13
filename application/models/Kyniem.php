<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kyniem extends \CI_Model {

    /**
     * Property để lấy lịch sử blog của auth
     */
    public $history_auth;

    /**
	 * 	Lấy dữ liệu kỷ niệm
	 *
	 * 	@param int $condition["year"] Param lọc theo năm
	 * 	@param string $condition["keyword"] Param search theo keyword
	 * 	@param int $condition["limit"] Giới hạn
	 * 	@param int $condition["offset"] Bắt đầu từ vị trí nào
	 * @return mixed
	 */
	public function getAll($condition=null){
		if($condition["year"]){
			$this->db->like('(kyniem_create)', $condition["year"]);
		}
		if($condition["keyword"]){
			$this->db->like('(kyniem_content)', $condition["keyword"]);
		}
		if($condition["limit"]){
			$this->db->limit($condition["limit"],$condition["offset"]);
		}
		$this->db->select('kyniem.*, user.user_avatar, user.username');
		$this->db->join("user","user.id=kyniem_auth")->where('delete_flg', 0);
		$this->db->order_by('id', 'desc');
		return $this->db->get('kyniem')->result();
	}

	/**
	 * @param int $id id của row
	 * @return boolean
	 */
	public function delete_kyniem($id){
		$this->db->where('id', $id);
		$object= [
		"delete_flg" => 1,
		];
		if($this->db->update('kyniem', $object)){
			return true;
		}
		return false;
	}

	/**
	 * Lấy thông tin theo id
	 *
	 * @param $id
	 * @return array
	 */
	public function getById($id){
		$this->db->where('delete_flg', 0);
		$this->db->where('id', $id);
		return $this->db->get('kyniem',1)->row();
	}

	/**
	 * Lấy thông tin tất cả các tag
	 *
	 * @return array
	 */
	public function list_tag(){
		$rs = $this->db->query('select kyniem_content from kyniem where kyniem_content like "%(#%)%"')->result();
		foreach ($rs as $key => $value) {
			preg_match_all("/\(#(\w+?)\)/", $value->kyniem_content,$match);
			foreach ($match[1] as $key_2 => $value_2) {
				$tags[]=$value_2;
			}
		}
		$tags = array_unique(array_filter($tags));
		return $tags;
	}

    /**
     * Lấy dữ liệu số lần viết blog trong ngày
     *
     * @param string $user_id
     * @return array
     * $data["Y-m-d"] = count;
     * @Sample
     * $return["2016-06-21] = 1;
     * $return["2016-06-22] = 3;
     * $return["2016-06-23] = 3;
     * ...
     *
     */
    public function get_date_write_blog($user_id = null){
        if($user_id){
            $sql = 'select count(*) as `count`,date(kyniem_create) `date` from kyniem 
                    where kyniem_auth = '.$user_id.' 
                    GROUP BY date(kyniem_create)';
        }else{

            $sql = 'select count(*) as `count`,date(kyniem_create) `date` from kyniem GROUP BY date(kyniem_create)';
        }
        $data = $this->db->query($sql)->result();
        foreach ($data as $key => $item) {
            $return[$item->date] = $item->count;
        }
        return $return;
    }

	/**
	 *
	 * @param date $date
     */
	public function check_status($date)
	{
		$sql = 'select count(*) from kyniem where status >0 and  date(kyniem_create) = "'.$date.'" GROUP BY date(kyniem_create)';
		$data = $this->db->query($sql)->num_rows();
		return $data;

	}

    /**
     *
     * @param string $option NOW
     * @param string $option IN_YEAR
     * @param int $year
     * @return array
     */
    public function get_all_date_in_year_has_wrote($option = "NOW", $year = 2016)
    {
        switch($option){
            case "IN_YEAR":
                $date_in_year = $this->action->get_date_in_year($year);
                break;
            default:
                $date_in_year = $this->action->get_date_from_now();
                break;
        }
        $auth = $this->history_auth;
        $dates = $this->kyniem->get_date_write_blog($auth);
        $return = [];
        foreach ($date_in_year as $date_e){
            $return[$date_e] = $dates[$date_e];
        }
        return $return;
    }


    /**
     * Lấy số ngày không viết blog
     *
     * @return integer
     */
    public function get_count_dont_write(){
        $n = new DateTime(NOW);
        $m = new DateTime(end(array_keys($this->get_date_write_blog())));
        return $m->diff($n)->d;
    }

}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */