<?php $this->load->view('_includes/header',["js"=>["/asset/js/jquery.lazyload.js"]]); ?>
<?php 
	if(false){
		if(!$this->session->userdata('popup')){
			  ?>
				<div class="popup_home_mark"></div>
				<div class="popup_home" style="display:none;"><?= show_img_countdown(); ?></div>
				<script>
					$(document).ready(function() {
						$(".popup_home").css("left",(($(window).height()/2)))
						$(".popup_home").show();
					});
					$(".popup_home_mark").click(function() {
						$(this).hide();
						$(".popup_home").hide();
					});

				</script>
			 <?php 
			 $array = array(
			 	'popup' => 'on'
			 );
			 
			 $this->session->set_userdata( $array );
		}
	}
 ?>
<script>
	$(document).ready(function() {
		$("img.lazy").lazyload({
			threshold : 200
		});
		//data-original=""
		//$("img[src*='gif']").lazyload();
		$(".change-year").change(function(event) {
			location.href = "/homepage/chang_year/"+$(this).val();
		});
	});
</script>
	<div class="row">
		<h2>Time Line</h2>
	</div>
	<!-- #List Year -->
	<select class="form-control change-year" style="width:100px;">
		<?php
		for($i=2015 ; $i<=date("Y");$i++){
			?>
			<option value="<?= $i; ?>" <?= ((int)$this->session->userdata("year")== $i?"selected":""); ?> > <?= $i; ?> </option>
			<?php
		}
			?>
	</select>
	<div class="text-right">
		<button type="button" id="button_add" class="btn btn-primary">Thêm kỷ niệm</button>
	</div>
	<hr>
    <div class="qa-message-list" id="wallmessages">
	<?php
	foreach($kn as $key=>$value){
		  ?> 
				<div class="message-item" id="m16">
					<div class="options_icon"><span></span>
					<ul>
					<li><a href="<?= base_url(); ?>homepage/edit_new/<?= md5($this->config->config["encryption_key"]."__".$value->id) ; ?>/<?= $value->id; ?>">Edit</a></li>
					<li><a class="delete_b" href="<?= base_url(); ?>homepage/delete_kyniem/<?= md5($this->config->config["encryption_key"]."__".$value->id) ; ?>/<?= $value->id; ?>">Delete</a></li>
					</ul>
					</div>
					<div class="message-inner">
						<div class="message-head clearfix">
							<div class="avatar pull-left">
							<a href="#"><img src="<?= PATH_AVATAR.$value->user_avatar; ?>"></a>
							</div>
							<div class="user-detail">
								<h5 class="handle"><?= ($value->kyniem_title?$value->kyniem_title:"Happy Family"); ?></h5>
								<div class="post-meta">
									<div class="asker-meta">
										<span class="qa-message-what"></span>
										<span class="qa-message-when">
											<span class="qa-message-when-data"><?= date("d-m-Y H:i:s",strtotime($value->kyniem_create)); ?></span>
										</span>
										<span class="qa-message-who">
											<span class="qa-message-who-pad">by </span>
											<span class="qa-message-who-data"><a href="#"><?= $value->username; ?></a></span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="qa-message-content">
							<div><?= h($value->kyniem_content); ?></div>
							<?php
							if($value->kyniem_images){
								$images = json_decode($value->kyniem_images,true);
								echo "<div class='image-link'>";
								foreach ((array)$images as $key2 => $value2) {
									if(file_exists(FCPATH."asset/images/thumb/".get_thumb_file_name($value2))){
										$value2_c = "thumb/".get_thumb_file_name($value2);
									}else{
										$value2_c = $value2;
									}
									echo '<a href="'.base_url().'asset/images/'.$value2.'"  class=""><img class="lazy"  data-original="'.base_url().'asset/images/'.$value2_c.'"  src=""></a>';
								}
								echo "</div>";
							}
							?>
							<div class="box-comment">
								<div class="row-tail">
									<div class="input-c">
										<input class='input-comment' data-id="<?= $value->id; ?>" placeholder="Write comment ...">
										<a href="javascript:void(0)" class="smile-button"><i class="fa fa-smile-o"></i></a>
									</div>
									<div class="button-c">
										<button class="btn btn-primary btn-block send-button">Send</button>
									</div>
									<div class="clearfix"></div>
								</div>
								<ul>
									<?php
									foreach ((array)$comment[$value->id] as $key_comment => $value_comment) {
										  ?> 
											<li data-id='<?= $value_comment->id; ?>' class='ele_comment' id="">
												<div class='avatar'><img src='<?= PATH_AVATAR.$value_comment->user_avatar; ?>' class='avatar_comment'> </div>
												<div class="content">
													<div class="username"><b><?= $value_comment->username; ?></b></div>
													<div class="comment_create"><small><?= $value_comment->comment_create; ?></small></div> 
													<div class="comment_content"><?= $value_comment->comment_content; ?></div>
												</div>
											</li>
										   <?php 
										//echo "<li data-id='".($value_comment->id)."'>".($value_comment->comment_content)."</li>";
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
		   <?php 
		} ?>
	</div>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Hạnh phúc là một quá trình không phải là đích đến</h4>
				</div>
				<div class="modal-body">
					<?php $this->load->view('ajax_add_new',["list_tag"=>$tags]); ?>
				</div>
			</div>
		</div>
	</div>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<?php
if($tags){
	?>
	<div id="tags_list">
		<h3>Tags</h3>
		<?php 
		foreach ((array)$tags as $key => $value) {
			echo "<span><a href='/homepage/tags/$value'> #".$value." </a></span>";
		}
		?>
	</div>
	<?php
}
?>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<script src="/asset/js/comment.js"></script>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<div class="modal fade" id="modal-upload-media">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="/asset/js/jquery.form.js"></script>
<script src="/asset/js/media-box.js"></script>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->


<?php $this->load->view('_includes/footer'); ?>