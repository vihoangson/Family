<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller {

	private $data_friends;

	public function __construct(){
		parent::__construct();
		$this->data_friends = [
			"Bố Sơn" =>[
				"img" => "/asset/data/img_quote/vihoangson.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Mẹ Su" =>[
				"img" => "/asset/data/img_quote/doanthuynhauyen.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Tú" =>[
				"img" => "/asset/data/img_quote/cotu.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Trinh" =>[
				"img" => "/asset/data/img_quote/cotrinh.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Chú Sang" =>[
				"img" => "/asset/data/img_quote/chusang.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Bác Tuấn" =>[
				"img" => "/asset/data/img_quote/bactuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Xuân" =>[
				"img" => "/asset/data/img_quote/coxuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Tứ" =>[
				"img" => "/asset/data/img_quote/dixuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],
		];
	}

	public function index()
	{
		$this->list_f();
	}

	public function list_f(){
		foreach ($this->data_friends as $key => $value) {
			$value["img"]=substr($value["img"],0-(strlen($value["img"])-1));
			if(!file_exists(FCPATH.$value["img"])){
				$alert_img_quote[] = basename($value["img"]);
			}
		}
		if($alert_img_quote){
			$this->session->set_flashdata('item', ["danger"=>"<h3>Không có các hình: </h3>".json_encode($alert_img_quote)]);
		}
		$data=$this->data_friends;
		$this->load->view('friends_list',compact("data"));
	}

	public function show(){
		foreach ($this->data_friends as $key => $value) {
			$value["img"]=substr($value["img"],0-(strlen($value["img"])-1));
			if(!file_exists(FCPATH.$value["img"])){
				$alert_img_quote[] = basename($value["img"]);
			}
		}

		if($alert_img_quote){
			$this->session->set_flashdata('item', ["danger"=>"<h3>Không có các hình: </h3>".json_encode($alert_img_quote)]);
		}
		$data=$this->data_friends;
		$this->load->view('friends',compact("data"));
	}
}

/* End of file friends.php */
/* Location: ./application/controllers/friends.php */