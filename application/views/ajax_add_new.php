<?php 
	if($data->id){
		$mode = "edit";
	}else{
		$mode = "add";
	}
foreach ($this->config->item("emotion_yahoo") as $key => $value) {
	$emotion .= "<span class='emotion_icon' alt='".$key."'>".$value."</span> ";
}	
?>
<form action="<?= base_url(); ?>homepage/<?= ($data->id?"edit_new/".md5($this->config->config["encryption_key"]."__".$data->id)."/".$data->id:"add_new"); ?>" id="add_new" method="POST" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Người viết</label>
		<input type="radio" id='bo_checkbox' <?= ($data->kyniem_auth=="Bố"?"checked":""); ?> name="kyniem_auth" value="Bố" required> <label for="bo_checkbox">Bố </label> 
		<input type="radio" id='me_checkbox' <?= ($data->kyniem_auth=="Mẹ"?"checked":""); ?> name="kyniem_auth" value="Mẹ" required> <label for="me_checkbox">Mẹ </label>
	</div>

	<div class="form-group">
		<label for="">Tên của kỷ niệm</label>
		<input name="title" type="text" class="form-control" id="" placeholder="Input field" value="<?= ($data->kyniem_title?$data->kyniem_title:""); ?>">
	</div>
	<div class="form-group">
		<label for="">Nội dung</label>
		<div style="padding:4px 0;"><button type="button" class="btn btn-default" onclick="$('.icon_box').toggle();"><img src="/asset/data/img_emotion/1.gif"></button></div>
		<div class="icon_box" style="display:none; padding:10px;"><?= $emotion; ?></div>
		<textarea name="content" id="content" class="form-control" style="height:250px;" required><?= ($data->kyniem_content?$data->kyniem_content:""); ?></textarea>
	</div>
	<div class="form-group">
		<label for="">File</label>
		<input name="userfile[]" type="file" class="form-control" id="" placeholder="Input field" multiple >
		<?php 
		if($data->kyniem_images){
			$imgs = json_decode($data->kyniem_images);
			echo "<div class='image-link'>";								
			foreach ($imgs as $key => $value) {
				echo "<span class='img_ele' data-img='".$value."' data-id='".$data->id."' ><img src='".base_url()."asset/images/".$value."'></span>";
			}
			echo "</div>";
		}
		 ?>
	</div>
	<button type="submit" class="btn btn-primary">Lưu</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>	
</form>
<?php if($mode=="edit"){
	  ?> 
<script>
	$(".img_ele").click(function(event) {
		$.post('<?= base_url(); ?>homepage/ajax_delete_img', {img: $(this).data("img"),id: $(this).data("id")}, function(data, textStatus, xhr) {
			console.log(data);
			console.log(textStatus);
		});
	});




		


			


</script>
	   <?php 
} ?>