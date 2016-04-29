<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Do_ajax extends CI_Controller {

	//============ ============  ============  ============ 
	// Page: /ajax/do_ajax/save_img_box
	// $.post("/ajax/do_ajax/save_img_box",function(data){console.log(data);});
	//============ ============  ============  ============ 
	public function save_img_box(){
		// ============ ============  ============  ============ 
		// Upload img
		// 
		$config['upload_path'] = check_folder(FCPATH.'asset/file_upload/media/'.date("Y")."/".date("m")."/".date("d"));
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '1000000';
		$config['max_width']     = '10240';
		$config['max_height']    = '76800';
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload("file_x")){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode(["status"=> "Error","content"=>$error]);
		}
		else{
			//============ ============ ============  ============  ============  ============ 
			// Resize image after upload
			//
				$data = $this->upload->data();
				$thumbWidth             = 800;
				$thumbHeight            = 800;
				$config['source_image'] = $data["file_path"].$data["file_name"];
				$config['width']        = $thumbWidth;
				$config['height']       = $thumbHeight;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				if(@$this->image_lib->display_errors()){
					echo json_encode(["status"=> "Error","content"=>$this->image_lib->display_errors()]);
					return false;
				}
			//
			//============ ============ ============  ============  ============  ============ 

			//============ ============ ============  ============  ============  ============ 
			// Insert to db
			//

			$file_path = preg_replace("/^(.+)\/asset\//", "/asset/", $data["file_path"]);
			if(!$file_path){
				$file_path = $data["file_path"];
			}

			$object = [
				"files_name"  =>$data["file_name"],
				"files_path"  =>$file_path,
				"files_size"  =>$data["file_size"],
				"files_type"  =>$data["file_type"],
			];

			if(!$this->db->insert('media', $object)){
				echo json_encode(["status"=>"error"]);
				return false;
			}
			//
			//============ ============ ============  ============  ============  ============ 
		}
	}

	public function load_img_media(){
		$rs = $this->db->order_by("id","desc")->get('media')->result();
		foreach ($rs as $key => &$value) {
			preg_match("/^.+(\/asset\/.+)$/", $value->files_path,$match);
			if($match[1]){
				$value->files_path = $match[1];
			}
		}
		echo json_encode($rs);
	}

	public function load_media(){
		echo '<button class="btn btn-default upload-btn"><i class="fa fa-plus"></i> Upload</button>';
		?>
		<progress value="0" max="100" class="hidden"></progress>
		<form id='upload_form' method="post" enctype="multipart/form-data">
			<input type="file" style="display:none;" name='file_x'>
		</form>
		<?php
		echo "<div class='row list-media'></div>";
		die;
	}

	public function index()
	{
		?>
			<div class="text-center">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-heart"></i> Love</a>
						</li>
						<li role="presentation">
							<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-smile-o"></i> Happy</a>
						</li>
						<li role="presentation">
							<a href="#eating" aria-controls="eating" role="tab" data-toggle="tab"><i class="fa fa-check"></i> Eating</a>
						</li>
						<li role="presentation">
							<a href="#mostropi" aria-controls="eating" role="tab" data-toggle="tab"><i class="fa fa-child"></i> Mostropi</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="home">
							<img class='avatar_element' src='http://family.vihoangson.com/asset/uploads/icon_lick.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851560_551710611530737_79745517_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851565_401768539958711_290028601_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851568_396469623830477_2084168344_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851575_150916178429304_670813584_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851575_194382550685748_925626113_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851578_551710598197405_1346658353_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851582_150916201762635_1565638622_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851584_396468773830562_144785597_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851584_443281099111868_1573675643_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851585_490565371056908_1157825914_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851586_126362104215253_1651254063_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851586_209575229232979_1004007314_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851586_582402925104020_1853411551_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851588_209575132566322_766940191_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851595_460938580694657_59246824_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10173505_313426158818204_775161941_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10541012_456591364482960_1246532948_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10574701_520074084802755_1429693945_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10734286_481172855355137_520706700_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10734286_1578461445722639_1330279923_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10734312_383649311796508_969637020_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10935979_383649298463176_1866205660_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10935981_383649261796513_392257764_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/10935995_782436578507958_328330484_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/12330625_944849862231621_426325917_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/12624115_1523526111274707_2069916634_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/12683864_1523525987941386_1924921931_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851539_272698496237749_786804483_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851543_167788180085135_771369768_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851549_377001615779232_1579499571_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851555_167788120085141_1443830988_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851555_443281115778533_230573929_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851558_150916185095970_1363767498_n.png'>
							<img class='avatar_element' src='/asset/data/icon/love/851559_150916168429305_714795320_n.png'>
						</div>
						<div role="tabpanel" class="tab-pane" id="tab">
							<img class='avatar_element' src='/asset/data/icon/happy/851537_272701349570797_857638975_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851539_272698496237749_786804483_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851550_209575342566301_1742391284_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851554_209575375899631_174482815_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851555_209575209232981_1876032292_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851556_641023202579958_952038924_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851559_631487186879356_304873947_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851562_641023109246634_699907683_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851565_147663468749250_1873726033_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851565_275796349225020_1651436218_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851565_665073456837508_488195964_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_126361970881933_2050936102_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_126362047548592_307032461_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_168400739982971_1130460292_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_168401006649611_343837091_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_194382644019072_471497164_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_194382757352394_846050933_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_392309627533016_444569512_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851575_392309924199653_28092788_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851578_401768746625357_24636146_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851580_499671056782064_1498102408_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851581_150916191762636_963523626_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851582_275796329225022_867088750_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851583_147663482082582_1514500727_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851585_457535134356739_1793815498_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851589_443281352445176_1165314043_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/851593_488524174594361_1054180181_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173492_645899038824281_870509628_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173493_652781874816401_1384843031_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173496_645898802157638_1072232269_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173498_652781804816408_386186574_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173502_658968847531037_2000275936_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10173508_645898262157692_1782383363_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10333100_798723750139805_1108350702_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10333108_298592866987579_982646282_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10333116_567099273388569_1302585704_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10734312_1529175983999319_171771955_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10734319_334188633450824_537406245_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/10935984_1402232953407115_2108492437_n.png'>
							<img class='avatar_element' src='/asset/data/icon/happy/11404805_1457726067855439_1352584195_n.png'>
						</div>
						<div role="tabpanel" class="tab-pane" id="eating">
							<img class='avatar_element' src="/asset/data/icon/eating/11409284_973617299356993_186395117_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851574_555286174559237_1177223253_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10734346_334188700117484_1620996202_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851577_396469000497206_783815413_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851554_490565907723521_1819310451_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851567_592620470773084_238722246_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851579_555288787892309_385744812_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851571_555288481225673_1602454163_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851548_555286074559247_1970164712_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851581_555286011225920_1318345945_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851581_631487413546000_603210766_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10333105_657500230999901_2141619805_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851548_167788186751801_12340870_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851586_392309674199678_598882596_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851554_377001645779229_636975066_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10574690_364383977058241_2082796003_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851577_275796282558360_1015771912_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851575_168400763316302_1230648819_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10173503_272698822904383_393143349_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851586_165989766929982_1496365443_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851540_272702829570649_1475292467_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851536_272701746237424_61026026_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10173506_272701639570768_251509877_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10173494_272701532904112_1174622966_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10173504_272700662904199_1095176301_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10333112_472161936249065_1952874405_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851557_460938457361336_73538884_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10541018_313423568818463_302512478_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851586_499671026782067_165253303_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851578_631487400212668_2087073502_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851560_555289514558903_909068024_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10935997_1530127113935904_1659370569_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10734322_1529175800666004_970311349_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851571_1403156213296296_440149734_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/11057177_773581456091408_2057297768_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851583_654446917903722_178118452_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851565_641023175913294_875343096_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/10734334_830546316966590_1503555409_n.png">
							<img class='avatar_element' src="/asset/data/icon/eating/851560_617743648281246_2135880587_n.png">
						</div>
						<div role="tabpanel" class="tab-pane" id="mostropi">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851565_665073390170848_1030664237_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073396837514_240998303_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851580_665073403504180_375972893_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073410170846_821736238_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851576_665073416837512_1510811863_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851580_665073423504178_587399825_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851556_665073430170844_697563443_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851584_665073436837510_198179310_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851560_665073443504176_1093293082_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851579_665073450170842_1219442423_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851565_665073456837508_488195964_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073463504174_1022637082_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073470170840_788381655_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851583_665073476837506_1617942204_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851585_665073483504172_1568347975_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851578_665073490170838_1672362802_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073496837504_1438113354_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073506837503_1662818488_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851584_665073513504169_904626920_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851565_665073520170835_41349003_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073526837501_1268020686_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851556_665073533504167_1115964067_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851585_665073540170833_1760552001_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851584_665073546837499_6749879_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073553504165_831865561_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851580_665073560170831_1648685153_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073566837497_901476379_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851578_665073573504163_718696646_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851581_665073580170829_1960096432_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851577_665073590170828_541361236_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851585_665073596837494_435536134_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073603504160_522082510_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851586_665073613504159_1633271446_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851558_665073620170825_1329317059_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851584_665073633504157_1803908748_n.png">
							<img class='avatar_element' src="/asset/data/icon/mostropi/851562_665073640170823_1795886325_n.png">						
						</div>
					</div>
				</div>

			</div>
		<?php
	}

}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */