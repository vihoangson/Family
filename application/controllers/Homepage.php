<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {
//10153523162001902 Bố Sơn

	public function __construct(){
		parent::__construct();
		$this->load->model('kyniem');
		$this->load->library('image_lib');
		$this->load->library('facebook');
		if($this->session->userdata('fb_access_token')){
			$this->facebook->setDefaultAccessToken($this->session->userdata('fb_access_token'));
			$response = $this->facebook->get('/me?locale=en_US&fields=name,email');
			$userNode = $response->getGraphUser();
		}
		echo $this->session->userdata('userinfo');
		$this->init();
	}

	public function post_group(){
		$this->facebook->post_group();
	}

	// ============ ============  ============ ============
	// General test: Tập hợp các test case
	//
	public function general_test(){
		$this->test_resize_this_img();
	}
	//
	// ============ ============  ============ ============


	//============ ============  ============ ============
	// php index.php Homepage/test_resize_this_img
	// Đây là function test đầu tiên của tôi
	// Kiểm tra chức năng resize hình.
	//
		private function test_resize_this_img(){
			$path = FCPATH."asset/images/dont_delete_test_img.jpg";
			$path2 = FCPATH."asset/images/dont_delete_test_img_tmp.jpg";
			copy($path,$path2);
			$this->resize_this_img($path2,100,100);
			$size_img = getimagesize($path2);
			if($size_img[0]==100 || $size_img==100){
				echo __FUNCTION__.": [true]".PHP_EOL;
			}else{
				echo __FUNCTION__.": [false]".PHP_EOL;
			}
			unlink($path2);
		}
	//
	//============ ============  ============ ============

	private function init(){
		
		//Khởi tạo năm
		if(!$this->session->userdata("year")){
			$this->session->set_userdata( ['year' => date("Y")] );
		}
	}

	public function index()
	{
		if($this->session->userdata('year')){
			$cond_year = $this->session->userdata('year');
		}else{
			$cond_year = date("Y");
		}
		$condition["year"] = $cond_year;
		$kn = $this->kyniem->getAll($condition);
		foreach ($kn as $key => $value) {
			$rs = $this->db->where("kyniem_id",$value->id)->select("comment.*,user.username,user.user_avatar")->join("user","user.id=comment_user")->order_by("id","desc")->get('comment')->result();
			$comment[$value->id] = $rs;
		}
		$tags = $this->kyniem->list_tag();
		$this->load->view('homepage',compact("kn","comment","tags"));
	}

	public function chang_year($year){
		$array = array(
			'year' => $year
		);
		$this->session->set_userdata( $array );
		redirect('/','refresh');
	}

	public function landpage(){
		$this->load->view('index_page');
	}

	public function search_keyword()
	{
		if($this->input->post()){
			if($this->input->post("keyword")){
				$keyword = $this->input->post("keyword");
				$this->db->or_like('kyniem_title', $keyword);
				$this->db->or_like('kyniem_content', $keyword);
			}
			$rs = $this->db->get('kyniem')->result();
			$this->load->view('search_keyword', ["rs"=>$rs]);
			
		}else{
			redirect('/404','refresh');
		}
	}

	public function login($case = null){

		$flag = false;
		if($this->input->post('username') && $this->input->post('password')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->db->where('username', $username);
			$rs_user = $this->db->get('user',1)->row();
			if($username == $rs_user->username && $rs_user->password == md5($password."__".$rs_user->username)){
				$array = array(
					'user' => $username,
					'user_id' => ($rs_user->id),
				);
				$this->action->archive_log("login_comment",json_encode($array));
				$flag = true;
				$this->session->set_userdata( $array );
			}
		}
		if(!$flag){
			$url_fb = $this->facebook->getbuttonlogin();
			$this->load->view('login',compact("url_fb"));
		}else{
			redirect(base_url(),'refresh');
		}
	}

	public function logout(){
		//  $this->session->unset_userdata();
		session_destroy();
		redirect('/','refresh');
	}

	public function setting(){
		$this->load->view('setting');
	}


	private function do_upload()
	{       
		$this->load->library('upload');
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		$error = [];
		$success = [];
		for($i=0; $i<$cpt; $i++)
		{
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

			$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload()){
				$img_info = $this->upload->data();
				$success[] = $this->upload->data();
				$this->resize_img(FCPATH."asset/images/".$img_info['file_name'],100,100);
			}else{
				$error[] = $this->upload->display_errors();
			}
		}
		return ["error" => $error, "success" => $success];
		
	}

	private function set_upload_options()
	{   
	    //upload an image options
		$config = array();
		$config['upload_path'] = 'asset/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '1000000';
		$config['max_width']  = '102400';
		$config['max_height']  = '76800';
		$config['overwrite']     = FALSE;
		return $config;
	}

	public function add_new(){
		$ul = $this->do_upload();
		if($ul["error"]){
			$this->session->set_flashdata('error_upload', $error);
		}
		foreach ($ul["success"] as $key => $value) {
			$file[] = $value["file_name"];
		}

		$data = [
			"kyniem_title" => $this->input->post("title"),
			"kyniem_content" => $this->input->post("content"),
			"kyniem_auth" => $this->input->post("kyniem_auth"),
			"kyniem_create" => date("Y-m-d h:i:s",time()),
			"kyniem_modifie" => date("Y-m-d h:i:s",time()),
		];
		if($file){
			$data["kyniem_images"] = json_encode($file);
		}
		if($this->db->insert('kyniem', $data)){
			redirect('/','refresh');
		}else{
			echo 0;
		}
		
	}

	public function edit_new($token=null,$id=null){

		if($this->input->post()){

			$data = [
				"kyniem_title" => $this->input->post("title"),
				"kyniem_content" => $this->input->post("content"),
				"kyniem_auth" => $this->input->post("kyniem_auth"),				
				"kyniem_modifie" => date("Y-m-d h:i:s",time()),
			];
			
			if($_FILES){				
				$ul = $this->do_upload();
				if($ul["error"]){
					$this->session->set_flashdata('error_upload', $error);
				}
				foreach ($ul["success"] as $key => $value) {
					$file[] = $value["file_name"];
				}
				if($file){
					$imgs = $this->kyniem->getById($id)->kyniem_images;
					$array_imgs = json_decode($imgs);
					foreach ($file as $key => $value) {
						$array_imgs[]=$value;
					}
					$data["kyniem_images"] = json_encode($array_imgs);
				}
			}
			$this->db->where('id', $id);
			if($this->db->update('kyniem', $data)){
				redirect('/','refresh');
			}else{
				echo 0;
			}
		}else{
			if(!md5($this->config->config["encryption_key"]."__".$id) == $token){
				redirect('/404','refresh');	
			}			
			$rs = $this->kyniem->getById($id);		
			$this->load->view('_includes/header');
			$list_tag = $this->kyniem->list_tag();
			$this->load->view('ajax_add_new',["data"=>$rs,"list_tag"=>$list_tag]);
			$this->load->view('_includes/footer');
		}
	}

	public function delete_kyniem($token,$id){
		if(!md5($this->config->config["encryption_key"]."__".$id) == $token){
			redirect('/404','refresh');	
		}else{
			$this->kyniem->delete_kyniem($id);
			redirect('/','refresh');
		}
	}

	public function ajax_delete_img(){
		try {
			$this->db->where('id', $this->input->post("id"));
			$rs = json_decode($this->db->get('kyniem', 1)->row()->kyniem_images,true);
			unset($rs[array_search($this->input->post("img"), $rs)]) ;
			$images = json_encode($rs);
			if(!$this->_move_file_to_trash($this->input->post("img"))){
				throw new Exception("Không move được file", 1);
			}
			$this->db->where('id', $this->input->post("id"));
			if(!$this->db->update('kyniem', ["kyniem_images"=>$images])){
				throw new Exception("Không update được db", 1);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	private function _move_file_to_trash($file_name){
		$flag=true;
		if(FCPATH."asset/images/".$file_name){
			if(!rename(FCPATH."asset/images/".$file_name,FCPATH."asset/images/trash/".$file_name)){
				$flag=false;
				throw new Exception("Không move được file", 1);
			}
		}
		if(FCPATH."asset/images/thumb/".get_thumb_file_name($file_name)){
			if(!rename(FCPATH."asset/images/thumb/".get_thumb_file_name($file_name),FCPATH."asset/images/trash/".get_thumb_file_name($file_name))){
				throw new Exception("Không move được file", 1);
				$flag=false;
			}
		}
		return $flag;
	}

	private function _get_content_countdown(){
		return get_content_countdown();
		
		$date1=date_create(date("Y-m-d h:i:s",time()));
		$date2=date_create("2016-05-20");
		$diff=date_diff($date1,$date2);
		$days = $diff->days;
		$percent = 100-round(($days/266)*100);
		$m = $diff->m;
		$d = $diff->d;
		$h = $diff->h;
		$i = $diff->i;
		$s = $diff->s;
		$html = "
		<center>
			<h2 class='text-center'>Ngày dự sinh: <br>".date("d-m-Y",$date2->getTimestamp())."</h2>
			<h1>".$days." Ngày</h1>
			<h3>".$m." Tháng ".$d." Ngày - ".$h." Giờ ".$i." Phút ".$s." Giây </h3> 
			".'
			<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
					<span class="sr-only">'.$percent.'% Complete (success)</span>
				</div>
			</div>
			<h2><i class="fa fa-refresh fa-spin"></i> Loading</h2>
			'."
		</center>
		";
		return $html;
	}

	public function count_down(){
		$html = $this->_get_content_countdown();
		$this->load->view('count_down', ["content" => $html]);
	}

	public function calendar(){
		$this->load->view('calendar');
	}

	public function custom($url){
		$this->load->view('custom/'.$url);

	}

	private function resize_this_img($path,$width,$height){
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		//$config['new_image'] = FCPATH."asset/images/";
		$config['new_image'] = $path;
		$config['create_thumb'] = false;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$config['height']       = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();	
	}

	private function resize_img($path,$width,$height){
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['new_image'] = FCPATH."asset/images/thumb/";
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$config['height']       = $height;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();	
	}

	public function error404(){
		$this->load->view('errors/404');
	}

	public function cron($case=null){
		switch ($case){
			case "backup_db_family":
				$this->backup_db_family();
			break;
			case "backup_file_images_family":
				$this->backup_file_images_family();
			break;
			default:
				$html = $this->_get_content_countdown();
				$this->my_sent_email(["subject"=>"Count down ".date("Y-m-d H:i:s"),"content"=>$html]);
			break;
		}
	}

	public function tags($tag=null){
		$condition = ["keyword" => "#".$tag];
		$kn = $this->kyniem->getAll($condition);
		$this->load->view('homepage',["kn" => $kn]);
	}

	public function ajax_post_comment(){
		$id    = $this->input->post('id');
		if(!empty($this->input->post('value'))){
			$value = h($this->input->post('value'));
			$object=[
			"kyniem_id"=>$id,
			"comment_content"=>$value,
			"comment_user" => $this->session->userdata("user_id"),
			"comment_create"=>date("Y-m-d h:i:s"),
			"comment_modifie"=>date("Y-m-d h:i:s"),
			];
			$this->db->insert('comment', $object);
		}
		echo json_encode($this->db->select("comment.*,user.username,user.user_avatar")->join("user","user.id=comment_user")->where("kyniem_id",$id)->get('comment')->result());
	}

	public function ajax_delete_comment(){
		$id    = $this->input->post('id');
		$string = json_encode($this->db->where("id",$id)->get("comment")->result());
		$this->action->archive_log("delete_comment",$string);
		if($this->db->where("id",$id)->delete('comment')){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function button_fb(){
		$helper = $this->facebook->getRedirectLoginHelper();
		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl('http://'.$_SESSION["HTTP_HOST"].'/homepage/fb_callback', $permissions);
		echo $this->session->userdata('fb_access_token');
		echo "<hr>";
		var_dump($this->session->userdata('tokenMetadata'));
		echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
	}

	public function button_fb_logout(){
		$this->session->sess_destroy();
		header('Location: /homepage/button_fb');
	}

	public function fb_callback(){
		$html = "";
		if(!$this->session->userdata('fb_access_token')){
			$helper = $this->facebook->getRedirectLoginHelper();
			try {
				$accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
				$html.= 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
				$html.= 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			if (! isset($accessToken)) {
				if ($helper->getError()) {
					header('HTTP/1.0 401 Unauthorized');
					$html.= "Error: " . $helper->getError() . "\n";
					$html.= "Error Code: " . $helper->getErrorCode() . "\n";
					$html.= "Error Reason: " . $helper->getErrorReason() . "\n";
					$html.= "Error Description: " . $helper->getErrorDescription() . "\n";
				} else {
					header('HTTP/1.0 400 Bad Request');
					$html.= 'Bad request';
				}
				exit;
			}

			// Logged in
			$html.= '<h3>Access Token</h3>';
			//var_dump($accessToken->getValue());

			// The OAuth 2.0 client handler helps us manage access tokens
			$oAuth2Client = $this->facebook->getOAuth2Client();

			// Get the access token metadata from /debug_token
			$tokenMetadata = $oAuth2Client->debugToken($accessToken);
			$html.= '<h3>Metadata</h3>';
			//var_dump($tokenMetadata);

			// Validation (these will throw FacebookSDKException's when they fail)
			$tokenMetadata->validateAppId(APP_ID); // Replace 990882487654318 with your app id
			// If you know the user ID this access token belongs to, you can validate it here
			//$tokenMetadata->validateUserId('123');
			$tokenMetadata->validateExpiration();

			if (! $accessToken->isLongLived()) {
			// Exchanges a short-lived access token for a long-lived one
			try {
				$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				$html.= "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
				exit;
			}

				$html.= '<h3>Long-lived</h3>';
				//var_dump($accessToken->getValue());
			}
			$this->facebook->setDefaultAccessToken($accessToken);
			$response = $this->facebook->get('/me?locale=en_US&fields=name,email');
			$userNode = $response->getGraphUser();
			switch($userNode["email"]){
				case "vihoangson@gmail.com":
					$array = array(
						'fb_access_token' => (string) $accessToken,
						'user'            => "bo",
						'user_id'         => 11,
					);
				break;
				case "4t.nhauyen@gmail.com":
					$array = array(
						'fb_access_token' => (string) $accessToken,
						'user'            => "me",
						'user_id'         => 12,
					);
				break;
				default:

					redirect('/','refresh');
					$array = array(
						'fb_access_token' => (string) $accessToken,
						'user'            => "khach",
						'user_id'         => 0,
					);
				break;
			}
			$this->action->archive_log("login_facebook",json_encode([$userNode["name"],$userNode["email"],$userNode["id"]]));
			$this->session->set_userdata( $array);
			header('Location: /');
		}else{
			header('Location: /');
		}
	}

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */