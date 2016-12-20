<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH."core/REST_Controller.php";
class Options_control extends REST_Controller {

	/**
	 * @url    /api/options_control/getdict?key=[king]
	 */
	public function getdict_get(){
		$this->load->helper("simplehtmldom");
		$keyword = $this->input->get("key");
		$return=[];
		$values = ["the","of","and","to","a","in","is","you","are","for","that","or","it","as","be","on","your","with","can","have","this","an","by","not","but","at","from","I","they","more","will"];
		$values = ["if","some","there","what","about","which","when","one","their","all","also","how","many","do","has","most","people","other","time","so","was","we","these","may","like","use","into","than","up","out","who","them","make","because","such","through","get","work","even","different","its","no","our","new","film","just","only","see","used","good","water","been","need","should","very","any","history","often","way","well","art","know","were","then","my","first","would","money","each","over","world","information","map","find","where","much","take","two","want","important","family","those","example","while","he","look","government","before","help","between","go","own","however","business","us","great","his","being","another","health","same","study","why","few","game","might","think","free","too","had","hi","right","still","system","after","computer","best","must","her","life","since","could","does","now","during","learn","around","usually","form","meat","air","day","place","become","number","public","read","keep","part","start","year","every","field","large","once","available","down","give","fish","human","both","local","sure","something","without","come","me","back","better","general","process","she","heat","thanks","specific","enough","long","lot","hand","popular","small","though","experience","include","job","music","person","really","although","thank","book","early","reading","end","method","never","less","play","able","data","feel","high","off","point","type","whether","food","understanding","here","home","certain","economy","little","theory","tonight","law","put","under","value","always","body","common","market","set","bird","guide","provide","change","interest","literature","sometimes","problem","say","next","create","simple","software","state","together","control","knowledge","power","radio","ability","basic","course","economics","hard","add","company","known","love","past","price","size","away","big","internet","possible","television","three","understand","various","yourself","card","difficult","including","list","mind","particular","real","science","trade","consider","either","library","likely","nature","fact","line","product","care","group","idea","risk","several","someone","temperature","united","word","fat","force","key","light","simply","today","training","until","major","name","personal","school","top","current","generally","historical","investment","left","national","amount","level","order","practice","research","sense","service","area","cut","hot","instead","least","natural","physical","piece","show","society","try","check","choose","develop","second","useful","web","activity","boss","short","story","call","industry","last","media","mental","move","pay","sport","thing","actually","against","far","fun","house","let","page","remember","term","test","within","along","answer","increase","oven","quite","scared","single","sound","again","community","definition","focus","individual","matter","safety","turn","everything","kind","quality","soil","ask","board","buy","development","guard","hold","language","later","main","offer","oil","picture","potential","professional","rather","access","additional","almost","especially","garden","international","lower","management","open","player","range","rate","reason","travel","variety","video","week","above","according","cook","determine","future","site","alternative","demand","ever","exercise","following","image","quickly","special","working","case","cause","coast","probably","security","TRUE","whole","action","age","among","bad","boat","country","dance","exam","excuse","grow","movie","organization","record","result","section","across","already","below","building","mouse","allow","cash","class","clear","dry","easy","emotional","equipment","live","nothing","period","physics","plan","store","tax","analysis","cold","commercial","directly","full","involved","itself","low","old","policy","political","purchase","series","side","subject","supply","therefore","thought","basis","boyfriend","deal","direction","mean","primary","space","strategy","technology","worth","army","camera","fall","freedom","paper","rule","similar","stock","weather","yet","bring","chance","environment","everyone","figure","improve","man","model","necessary","positive","produce","search","source","beginning","child","earth","else","healthy","instance","maintain","month","present","program","spend","talk","truth","upset","begin","chicken","close","creative","design","feature","financial","head","marketing","material","medical","purpose","question","rock","salt","tell","themselves","traditional","university","writing","act","article","birth","car","cost","department","difference","dog","drive","exist","federal","goal","green","late","news","object","scale","sun","support","tend","thus","audience","enjoy","entire","fishing","fit","glad","growth","income","marriage","note","perform","profit","proper","related","remove","rent","return","run","speed","strong","style","throughout","user","war","actual","appropriate","bank","combination","complex","content","craft","due","easily","effective","eventually","exactly","failure","half","inside","meaning","medicine","middle","outside","philosophy","regular","reserve","standard","bus","decide","exchange","eye","fast","fire","identify","independent","leave","original","position","pressure","reach","rest","serve","stress","teacher","watch","wide","advantage","beautiful","benefit","box","charge","communication","complete","continue","frame","issue","limited","night","protect","require","significant","step","successful","unless","active","break","chemistry","cycle","disease","disk","electrical","energy","expensive","face","interested","item","metal","nation","negative","occur","paint","pregnant","review","road","role","room","safe","screen","soup","stay","structure","view","visit","visual","write","wrong","account","advertising","affect","ago","anyone","approach","avoid","ball","behind","certainly","concerned","cover","discipline","location","medium","normally","prepare","quick","ready","report","rise","share","success","addition","apartment","balance","bit","black","bottom","build","choice","education","gift","impact","machine","math","moment","painting","politics","shape","straight","tool","walk","white","wind","achieve","address","attention","average","believe","beyond","career","culture","decision","direct","event","excellent","extra","intelligent","interesting","junior","morning","pick","poor","pot","pretty","property","receive","seem","shopping","sign","student","table","task","unique","wood","anything","classic","competition","condition","contact","credit","currently","discuss","distribution","egg","entertainment","final","happy","hope","ice","lift","mix","network","north","office","overall","population","president","private","realize","responsible","separate","square","stop","teach","unit","western","yes","alone","attempt","category","cigarette","concern","contain","context","cute","date","effect","extremely","familiar","finally","fly","follow","helpful","introduction","link","official","opportunity","perfect","performance","post","recent","refer","solve","star","voice","willing","born","bright","broad","capital","challenge","comfortable","constantly","describe","despite","driver","flat","flight","friend","gain","him","length","magazine","maybe","newspaper","nice","prefer","prevent","properly","relationship","rich","save","self","shot","soon","specifically","stand","teaching","warm","wonderful","young","ahead","brush","cell","couple","daily","dealer","debate","discover","ensure","exit","expect","experienced","fail","finding","front","function","heavy","hello","highly","immediately","impossible","invest","lack","lake","lead","listen","living","member","message","phone","plant","plastic","reduce","relatively","scene","serious","slowly","speak","spot","summer","taste","theme","towards","track","valuable","whatever","wing","worry","appear","appearance","association","brain","button","click","concept","correct","customer","death","desire","discussion","explain","explore","express","fairly","fixed","foot","gas","handle","housing","huge","inflation","influence","insurance","involve","leading","lose","meet","mood","notice","primarily","rain","rare","release","sell","slow","technical","typical","upon","wall","woman","advice","afford","agree","base","blood","clean","competitive","completely","critical","damage","distance","effort","electronic","expression","feeling","finish","fresh","hear","immediate","importance","normal","opinion","otherwise","pair","payment","plus","press","reality","remain","represent","responsibility","ride","savings","secret","situation","skill","spread","spring","staff","statement","sugar","target","text","tough","ultimately","wait","wealth","whenever","whose","widely","animal","application","apply","author","aware","brown","budget","cheap","city","complicated","county","deep","depth","discount","display","educational","environmental","estate","file","flow","forget","foundation","global","grandmother","ground","heart","hit","legal","lesson","minute","near","objective","officer","perspective","phase","photo","recently","recipe","recommend","reference","register","relevant","rely","secure","seriously","shoot","sky","stage","stick","studio","thin","title","topic","touch","trouble","vary","accurate","advanced","bowl","bridge","campaign","cancel","capable","character","chemical","club","collection","cool","cry","dangerous","depression","dump","edge","evidence","extreme","fan","frequently","fully","generate","imagination","letter","lock","maximum","mostly","myself","naturally","nearly","novel","obtain","occasionally","option","organized","pack","park","passion","percentage","plenty","push","quarter","resource","select","setting","skin","sort","weight","accept","ad","agency","baby","background","carefully","carry","clearly","college","communicate","complain","conflict","connection","criticism","debt","depend","description","die","dish","dramatic","eat","efficient","enter","essentially","exact","factor","fair","fill","fine","formal","forward","fruit","glass","happen","indicate","joint","jump","kick","master","memory","muscle","opposite","pass","patience","pitch","possibly","powerful","red","remote","secretary","slightly","solution","somewhat","strength","suggest","survive","total","traffic","treat","trip","vast","vegetable","abuse","administration","appeal","appreciate","aspect","attitude","beat","burn","chart","compare","deposit","director","equally","foreign","gear","greatly","hungry","ideal","imagine","kitchen","land","log","lost","manage","mother","necessarily","net","party","personality","personally","practical","principle","print","psychological","psychology","raise","rarely","recommendation","regularly","relative","response","sale","season","selection","severe","signal","similarly","sleep","smooth","somewhere","spirit","storage","street","suitable","tree","version","wave","advance","alcohol","anywhere","argument","basically","belt","bench","closed","closely","commission","complaint","connect","consist","contract","contribute","copy","dark","differ","double","draw","drop","effectively","emphasis","encourage","equal","everybody","expand","firm","fix","frequent","highway","hire","initially","internal","join","kill","literally","loss","mainly","membership","merely","minimum","numerous","path","possession","preparation","progress","project","prove","react","recognize","relax","replace","sea","sensitive","sit","south","status","steak","stuff","sufficient","tap","ticket","tour","union","unusual","win","agreement","angle","attack","blue","borrow","breakfast","cancer","claim","confidence","consistent","constant","cultural","currency","daughter","degree","doctor","dot","drag","dream","drink","duty","earn","emphasize","employment","enable","engineering","entry","essay","existing","famous","father","fee","finance","gently","guess","hopefully","hour","interaction","juice","limit","luck","milk","minor","mixed","mixture","mouth","nor","operate","originally","peace","pipe","please","preference","previous","pull","pure","raw","reflect","region","republic","roughly","seat","send","significantly","soft","solid","stable","storm","substance","team","tradition","trick","virus","wear","weird","wonder","actor","afraid","afternoon","amazing","annual","anticipate","assume","bat","beach","blank","busy","catch","chain","classroom","consideration","count","cream","crew","dead","delivery","detail","detailed","device","difficulty","doubt","drama","election","engage","engine","enhance","examine","FALSE","feed","football","forever","gold","guidance","hotel","impress","install","interview","kid","mark","match","mission","nobody","obvious","ourselves","owner","pain","participate","pleasure","priority","protection","repeat","round","score","screw","seek","sex","sharp","shop","shower","sing","slide","strip","suggestion","suit","tension","thick","tone","totally","twice","variation","whereas","window","wise","wish","agent","anxiety","atmosphere","awareness","band","bath","block","bone","bread","calendar","candidate","cap","careful","climate","coat","collect","combine","command","comparison","confusion","construction","contest","corner","court","cup","dig","district","divide","door","east","elevator","elsewhere","emotion","employee","employer","equivalent","everywhere","except","finger","garage","guarantee","guest","hang","height","himself","hole","hook","hunt","implement","initial","intend","introduce","latter","layer","leadership","lecture","lie","mall","manager","manner","march","married","meeting","mention","narrow","nearby","neither","nose","obviously","operation","parking","partner","perfectly","physically","profile","proud","recording","relate","respect","rice","routine","sample","schedule","settle","smell","somehow","spiritual","survey","swimming","telephone","tie","tip","transportation","unhappy","wild","winter","absolutely","acceptable","adult","aggressive","airline","apart","assure","attract","bag","battle","bed","bill","boring","bother","brief","cake","charity","code","cousin","crazy","curve","designer","dimension","disaster","distinct","distribute","dress","ease","eastern","editor","efficiency","emergency","escape","evening","excitement","expose","extension","extent","farm","feedback","fight","gap","gather","grade","guitar","hate","holiday","homework","horror","horse","host","husband","leader","loan","logical","mistake","mom","mountain","nail","noise","none","occasion","outcome","overcome","owe","package","patient","pause","permission","phrase","presentation","prior","promotion","proof","race","reasonable","reflection","refrigerator","relief","repair","resolution","revenue","rough","sad","sand","scratch","sentence","session","shoulder","sick","singer","smoke","stomach","strange","strict","strike","string","succeed","successfully","suddenly","suffer","surprised","tennis","throw","tourist","towel","truly","vacation","virtually","west","wheel","wine","acquire","adapt","adjust","administrative","altogether","anyway","argue","arise","arm","aside","associate","automatic","automatically","basket","bet","blow","bonus","border","branch","breast","brother","buddy","bunch","cabinet","childhood","chip","church","civil","clothes","coach","coffee","confirm","cross","deeply","definitely","deliberately","dinner","document","draft","drawing","dust","employ","encouraging","expert","external","floor","former","god","golf","habit","hair","hardly","hearing","hurt","illegal","incorporate","initiative","iron","judge","judgment","justify","knife","lab","landscape","laugh","lay","league","loud","mail","massive","measurement","mess","mobile","mode","mud","nasty","native","opening","orange","ordinary","organize","ought","parent","pattern","pin","poetry","police","pool","possess","possibility","pound","procedure","queen","ratio","readily","relation","relieve","request","respond","restaurant","retain","royal","salary","satisfaction","sector","senior","shame","shelter","shoe","shut","signature","significance","silver","somebody","song","southern","split","strain","struggle","super","swim","tackle","tank","terribly","tight","tooth","town","train","trust","unfair","unfortunately","upper","vehicle","visible","volume","wash","waste","wife","yellow","yours","accident","airport","alive","angry","appointment","arrival","assist","assumption","bake","bar","baseball","bell","bike","blame","boy","brick","calculate","chair","chapter","closet","clue","collar","comment","committee","compete","concerning","conference","consult","conversation","convert","crash","database","deliver","dependent","desperate","devil","diet","enthusiasm","error","exciting","explanation","extend","farmer","fear","fold","forth","friendly","fuel","funny","gate","girl","glove","grab","gross","hall","herself","hide","historian","hospital","ill","injury","instruction","investigate","jacket","lucky","lunch","maintenance","manufacturer","meal","miss","monitor","mortgage","negotiate","nurse","pace","panic","peak","perception","permit","pie","plane","poem","presence","proposal","provided","qualify","quote","realistic","reception","recover","replacement","resolve","retire","revolution","reward","rid","river","roll","row","sandwich","shock","sink","slip","son","sorry","spare","speech","spite","spray","surprise","suspect","sweet","swing","tea","till","transition","twist","ugly","unlikely","upstairs","usual","village","warning","weekend","weigh","welcome","winner","worker","writer","yard","abroad","alarm","anxious","arrive","assistance","attach","behave","bend","bicycle","bite","blind","bottle","brave","breath","briefly","buyer","cable","calm","candle","celebrate","chest","chocolate","clerk","cloud","comprehensive","concentrate","concert","conclusion","contribution","convince","cookie","counter","courage","curious","dad","desk","dirty","disagree","downtown","drawer","establish","establishment","estimate","examination","flower","garbage","grand","grandfather","grocery","harm","honest","honey","ignore","imply","impression","impressive","improvement","independence","informal","inner","insect","insist","inspection","inspector","king","knee","ladder","lawyer","leather","load","loose","male","menu","mine","mirror","moreover","neck","penalty","pension","piano","plate","pleasant","pleased","potato","profession","professor","prompt","proposed","purple","pursue","quantity","quiet","reaction","refuse","regret","remaining","requirement","reveal","ruin","rush","salad","sexual","shake","shift","shine","ship","sister","skirt","slice","snow","specialist","specify","steal","stroke","strongly","suck","sudden","supermarket","surround","switch","terrible","tired","tongue","trash","tune","unable","warn","weak","weakness","wedding","wooden","worried","yeah","zone","accuse","admire","admit","adopt","affair","ambition","analyst","anger","announce","anybody","apologize","apple","approve","asleep","assignment","assistant","attend","award","bathroom","bear","bedroom","beer","belong","bid","birthday","bitter","boot","brilliant","bug","camp","candy","carpet","cat","celebration","champion","championship","channel","cheek","client","clock","comfort","commit","confident","conscious","consequence","cow","crack","criticize","dare","dear","decent","delay","departure","deserve","destroy","diamond","dirt","disappointed","drunk","ear","embarrassed","empty","engineer","entrance","fault","female","fortune","friendship","funeral","gene","girlfriend","grass","guilty","guy","hat","hell","hesitate","highlight","honestly","hurry","illustrate","incident","indication","inevitable","inform","intention","invite","island","joke","jury","kiss","lady","leg","lip","lonely","mad","manufacturing","marry","mate","midnight","motor","neat","negotiation","nerve","nervous","nowhere","obligation","odd","ok","passage","passenger","pen","persuade","pizza","platform","poet","pollution","pop","pour","pray","pretend","previously","pride","priest","prize","promise","propose","punch","quit","recognition","remarkable","remind","reply","representative","reputation","resident","resist","resort","ring","rip","roof","rope","rub","sail","scheme","script","shall","shirt","silly","sir","slight","smart","smile","sock","speaker","spell","station","stranger","stretch","stupid","submit","substantial","suppose","surgery","suspicious","sympathy","tale","tall","tear","temporary","throat","tiny","toe","tomorrow","tower","trainer","translate","truck","uncle","wake","weekly","whoever","witness","wrap","yesterday","youth"];
		foreach ($values as $key=>$value){
			if(!file_exists(FCPATH."asset/words/".$value.".txt")){
				$html = file_get_html("https://vdict.com/".$value.",1,0,0.html");
				foreach($html->find('.pronounce') as $element){
					$pro = $element->plaintext . '<br>';
				}
				$html->clear();
				file_put_contents(FCPATH."asset/words/".$value.".txt",$value."___".$pro);
			}
		}
		echo "<pre>";
		print_r($return);

		//$this->response($return);
	}

	/**
	 * Lấy tất cả các file hình trong slide của con
	 *
	 * @return array
	 * @url    /api/options_control/get_all_picture_slide
	 */
	public function get_all_picture_slide_get(){
		$this->load->helper("directory");
		if(!is_dir(FCPATH."asset/img_slide")){
			mkdir(FCPATH."asset/img_slide");
		}
		$img_slides = directory_map(FCPATH."asset/img_slide");
		if(!$img_slides){return;}
		$this->_create_thumbnail(FCPATH."asset/img_slide");
		foreach ($img_slides as $key => $value) {
			if (preg_match("/_thumb/", $value)) {
				unset($img_slides[$key]);
			}
		}
		$this->response(array_values($img_slides));
	}

	/**
	 *
	 * Refresh lại hình thumbnail
	 *
	 * @url /api/options_control/delete_thumbnail_slide
	 */
	public function delete_thumbnail_slide_get(){
		$this->load->helper("directory");
		$options["delete_all_thumbnail"] = true;
		$this->_create_thumbnail(FCPATH."asset/img_slide",$options);
	}

	/**
	 * Tạo thumbnail cho các hình nằm trong $path
	 *
	 * @param $path Path director
	 * @param $option["delete_all_thumbnail"] boolean
	 */
	private function _create_thumbnail($path,$options = []){
		$img_slides = directory_map($path);
		$this->load->library("Image_lib");
		foreach ($img_slides as $key => $value){
			if(preg_match("/_thumb/",$value)) {
				if($options["delete_all_thumbnail"]){
					unlink($path."/".$value);
				}
				continue;
			}
			if(!file_exists($path."/".$this->image_lib->thumb_marker.$value)){
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path."/".$value;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 500;
				$config['height']   = 500;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
		}
	}

	/**
	 * [getAllOption_get description]
	 *
	 * [GET]
	 * /api/options_control/getalloption
	 *
	 * @return json
	 */
	public function getAllOption_get()
	{
		$this->load->model('Options_model');
		$rs = $this->Options_model->get_all_option();
		$this->response($rs);
	}

	public function changeuser_post(){
		if($this->input->post('name')){
			$array = array(
				'user' => $this->input->post('name'),
				'user_id' => 0,
			);
			try {
				$this->session->set_userdata( $array );
				echo $this->session->userdata( "user" );
			} catch (Exception $e) {
				echo "error";
			}
			
		}
	}


}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */
