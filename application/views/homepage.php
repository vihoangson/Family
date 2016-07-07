<?php $this->load->view('_includes/header',["js"=>[]]); ?>
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
							<?php
							//============ ============  ============  ============ 
							//Hiển thị nội dung bài viết
							//============ ============  ============  ============ 
							?>
							<div><?= h($value->kyniem_content); ?></div>
							<?php
							//============ ============  ============  ============ 
							// Hiển thị hình kỷ niệm
							//============ ============  ============  ============ 
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

							//============ ============  ============  ============ 
							//Block comment
							//============ ============  ============  ============ 
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
								<?php 
								//============ ============  ============  ============ 
								//Hiển thị comment
								//============ ============  ============  ============ 
								 ?>
								<ul>
									<?php
									foreach ((array)$comment[$value->id] as $key_comment => $value_comment) {
										$this->load->view('_includes/ele_comment_box',compact("value_comment"));
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

	//============ ============  ============  ============ 
	//  Show tất cả tác tag trong source
	//  20160705152744
	//  
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
	//
	//============ ============  ============  ============ 
?>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<?php $this->load->view('_includes/footer'); ?>