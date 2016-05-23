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
		<label for="">Tên của kỷ niệm</label>
		<input name="title" type="text" class="form-control" id="" placeholder="Input field" value="<?= ($data->kyniem_title?$data->kyniem_title:""); ?>">
	</div>
	<div class="form-group">
		<label for="">Nội dung (<span style="color:red;">*</span>)</label>
		<div style="padding:4px 0;">
		<button type="button" class="btn btn-default" onclick="$('.icon_box').toggle();"><img src="/asset/data/img_emotion/1.gif"></button>
		<button type="button" class="btn btn-default insert-img" onclick="">Insert img</button>
		</div>
		<div class="icon_box" style="display:none; padding:10px;"><?= $emotion; ?></div>
		<textarea data-time="<?= time(); ?>" name="content" id="content" class="form-control" style="height:250px;" required><?= ($data->kyniem_content?$data->kyniem_content:""); ?></textarea>
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
	<?php
	if($list_tag){
		?>
		<div id="tags_list">
			<?php
			foreach ((array)$list_tag as $key => $value) {
				echo "<span class='tag_ele' alt='(#$value)'><a href='javascript:void()'> (#".$value.") </a></span>";
			}
			?>
		</div>
		<?php
	}
	?>
	<button type="submit" class="btn btn-primary">Lưu</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>	
</form>
<script>

    $('textarea,input').keyup(function () {
        localStorage.setItem(this.name+"_"+$(this).data("id")+"_"+$("textarea").first().data("time"), this.value);
    });
	

window.onbeforeunload = function () {
	if(localStorage.length>0){
		$.post('/ajax/do_ajax/ajax_save_cache', {localStorage: localStorage}, function(data, textStatus, xhr) {
			localStorage.clear();
		});
	}
};

</script>
<?php if($mode=="edit"){
	?>
<script>
	$(".img_ele").click(function(event) {
		$.post('/homepage/ajax_delete_img', {img: $(this).data("img"),id: $(this).data("id")}, function(data, textStatus, xhr) {
			console.log(data);
			console.log(textStatus);
		});
	});


</script>
	<?php 
}

show_modal_media("add_img_homepage");

?>
