<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friends extends CI_Controller {

	public function index()
	{
		
	}
	public function list_f(){
		$data = [
			"Bố Sơn" =>[
				"img" => "/asset/data/img_quote/vihoangson.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Mẹ Su" =>[
				"img" => "/asset/data/img_quote/doanthuynhauyen.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Cô Tú" =>[
				"img" => "/asset/data/img_quote/cotu.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Cô Trinh" =>[
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

			"Cô Xuân" =>[
				"img" => "/asset/data/img_quote/coxuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Xuân" =>[
				"img" => "/asset/data/img_quote/dixuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],
		];

		foreach ($data as $key => $value) {
			$value["img"]=substr($value["img"],0-(strlen($value["img"])-1));
			if(!file_exists(FCPATH.$value["img"])){
				$alert_img_quote[] = basename($value["img"]);
			}
		}

		if($alert_img_quote){
			$this->session->set_flashdata('item', ["danger"=>"<h3>Không có các hình: </h3>".json_encode($alert_img_quote)]);
		}

		$this->load->view('friends_list',compact("data"));
	}
	public function show(){

		$data = [
			"Bố Sơn" =>[
				"img" => "/asset/data/img_quote/vihoangson.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Mẹ Su" =>[
				"img" => "/asset/data/img_quote/doanthuynhauyen.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Cô Tú" =>[
				"img" => "/asset/data/img_quote/cotu.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Cô Trinh" =>[
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

			"Cô Xuân" =>[
				"img" => "/asset/data/img_quote/coxuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],

			"Dì Xuân" =>[
				"img" => "/asset/data/img_quote/dixuan.jpg",
				"quote" => "Không có gì quý hơn độc lập tự do",
			],
		];

		foreach ($data as $key => $value) {
			$value["img"]=substr($value["img"],0-(strlen($value["img"])-1));
			if(!file_exists(FCPATH.$value["img"])){
				$alert_img_quote[] = basename($value["img"]);
			}
		}

		if($alert_img_quote){
			$this->session->set_flashdata('item', ["danger"=>"<h3>Không có các hình: </h3>".json_encode($alert_img_quote)]);
		}

		$this->load->view('friends',compact("data"));
	}
}

/* End of file friends.php */
/* Location: ./application/controllers/friends.php */