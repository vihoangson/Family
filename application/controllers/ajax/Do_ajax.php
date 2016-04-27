<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Do_ajax extends CI_Controller {
	public function save_img_box(){
		$config['upload_path'] = FCPATH.'asset/file_upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '10240';
		$config['max_height']  = '76800';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload("file_x")){
			$error = array('error' => $this->upload->display_errors());
			echo $config['upload_path'];
			print_r($error);
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			$rs = $this->db->get('files')->result();
			echo json_encode($rs);
		}
	}

	public function load_media(){
		$rs = $this->db->get('files')->result();
		echo '<button class="btn btn-default upload-btn"><i class="fa fa-plus"></i> Upload</button>';
		?>
	<form id='upload_form' method="post" enctype="multipart/form-data">
		<input type="file" style="display:none;" name='file_x'>
	</form>
		<?php
		echo "<div class='row list-media'>";
		foreach ($rs as $key => $value) {
			preg_match("/^.+(\/asset\/.+)$/", $value->files_path,$match);
			if($match[1]){
				echo "<div class='col-sm-4 text-center thumbnail '><img src='".$match[1].$value->files_name."' onError='this.src=\"http://placehold.it/100x100\"'></div>";
			}
		}
		echo "</div>";
		die;
	}

	public function index()
	{
		?>
			<div class="text-center">
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
		<?php
	}

}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */