<?php $this->load->view('_includes/header',["js"=>["/asset/js/jquery.lazyload.js"]]); ?>
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
							<?php switch($value->kyniem_auth){
								case "Bố":
								  ?> <a href="#"><img src="<?= base_url(); ?>asset/data/BoSon.jpg"></a> <?php 
								break;
								case "Mẹ":
									?> <a href="#"><img src="<?= base_url(); ?>asset/data/MeSu.jpg"></a> <?php 
								break;
								} ?>
							
							</div>
							<div class="user-detail">
								<h5 class="handle"><?= $value->kyniem_title; ?></h5>
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
							<div class="box-comment">
								<input class='input-comment' data-id="<?= $value->id; ?>" placeholder="Write comment ...">
								<ul>
									<?php
									foreach ($comment[$value->id] as $key_comment => $value_comment) {
										echo "<li>".$value_comment->comment_content."</li>";
									}
									?>
								</ul>
							</div>
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
					<?php $this->load->view('ajax_add_new'); ?>
				</div>
			</div>
		</div>
	</div>
<script>

	$(".input-comment").keydown(function(event){
		//return false;
		if(event.which==13){
			id = $(this).data("id");
			value = $(this).val();
			this_c = $(this);
			$.post('homepage/ajax_post_comment', {id:id,value:value}, function(data, textStatus, xhr) {
				this_c.val("");
				rs = JSON.parse(data);
				this_ul = this_c.parent().find("ul");
				this_ul.text("");
				$.each(rs,function(index,val){
					this_ul.prepend("<li>"+val.comment_content+"</li>");
				});
			});
		}
	});
	$("#button_add").click(function(event) {
			$("#modal-id").modal();
	});
	$(".delete_b").click(function() {
		return confirm("Bạn có muốn xóa ?");		
	});
</script>
<?php $this->load->view('_includes/footer'); ?>