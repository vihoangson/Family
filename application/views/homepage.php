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
											<span class="qa-message-who-data"><a href="#"><?= $value->kyniem_auth; ?></a></span>
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
<script>


	$(".box-comment li").append("<span class='del-c'>x</span>");

	$(document).on("click",".del-c",function(){
		if(!confirm("Bạn có muốn xóa ?")){
			return;
		}
		id = $(this).parent().data("id");
		console.log(id);
		this_c = $(this);
		$.post('homepage/ajax_delete_comment', {id:id}, function(data, textStatus, xhr) {
			//console.log(parseInt(data));
			if(data == "1"){
				this_c.parent().remove();
			}
		});
	});

	$(".input-comment").keydown(function(event){
		//return false;
		if(event.which==13){
			send_comment($(this));
		}
	});

	$(".send-button").click(function(event) {
		send_comment($(this).parents(".row-tail").find(".input-comment:first"));
	});

	function send_comment(this_s){
		id = this_s.data("id");
		value = this_s.val();
		this_c = this_s;
		$.post('homepage/ajax_post_comment', {id:id,value:value}, function(data, textStatus, xhr) {
			this_c.val("");
			rs = JSON.parse(data);
			this_ul = this_c.parents(".box-comment").find("ul");
			this_ul.text("");
			$.each(rs,function(index,val){
				var tmp_ele = $(".ele_comment:first").clone();
				tmp_ele.find("li").data("id",val.id);
				tmp_ele.find("img").attr("src","/asset/data/"+val.user_avatar+"");
				tmp_ele.find(".username b").text(val.username);
				tmp_ele.find(".comment_create small").text(val.comment_create);
				tmp_ele.find(".comment_content").html(val.comment_content);
				this_ul.prepend(tmp_ele);
				// this_ul.prepend("<li data-id='"+val.id+"' class='ele_comment'><img src='/asset/data/"+val.user_avatar+"' style='width:50px;' class='avatar_comment'> <p><b>"+val.username+"</b></p> <p><small>"+val.comment_create+"</small></p> "+val.comment_content+"</li>");
			});
			$(".del-c").remove();
			$(".box-comment li").append("<span class='del-c'> </span>");
		});
	}

	$("#button_add").click(function(event) {
			$("#modal-id").modal();
	});

	$(".delete_b").click(function() {
		return confirm("Bạn có muốn xóa ?");		
	});

</script>
<?php $this->load->view('_includes/footer'); ?>