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
     * Lấy dữ liệu vẽ ra grid
     *
     * @param $data
     * @return html_string
     */
    public function draw_grid($data){
        $max_value = max($data);
        $m = new DateTime(end(array_keys($data)));
        $date_left = ($m->format("N") % 7)+6;
        for($i=0;$i<$date_left ;$i++){
            $data[] = -1;
        }
        $data = array_reverse($data);
        $html="";
        $i = 0;
        if($this->kyniem->history_auth == null){
            $html .= '<h2>All page history wrote blog</h2>';
        }else{
            $html .= '<h2>Your history wrote blog</h2>';
        }
        $html .= '
            
            <div id="gird_date">
            <div class="week">';
        foreach ($data as $key => $item){
            if($i % 7 ==0){
                $html .= '</div><div class="week">';
            }
            if($item > 0 ){
                $name_class = "has";

                $arrange = round(($item / $max_value)*100);
                if($arrange<25){
                    $name_class .= " has_1";
                }elseif($arrange<=25 && $arrange<50){
                    $name_class .= " has_2";
                }elseif($arrange<=50 && $arrange<75){
                    $name_class .= " has_3";
                }elseif($arrange > 75){
                    $name_class .= " has_4";
                }

            }elseif($item == -1){
                $name_class = "no_show";
            }else{
                $name_class = "no_has";
            }
            $html .= "<div data-date='".$item."' class='date ".$name_class ."' title='".$key."'></div>";
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
     * Vẽ history viết blog của gia đình
     *
     * @return html_string
     */
    public function draw_often_wrote_blog(){
        $date = $this->get_all_date_in_year_has_wrote(NOW);
        $html_grid = $this->draw_grid($date);
        return $html_grid;
    }

}

/* End of file Kyniem.php */
/* Location: ./application/models/Kyniem.php */