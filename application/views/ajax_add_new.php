<form action="<?= base_url(); ?>homepage/<?= ($data->id?"edit_new/".md5($this->config->config["encryption_key"]."__".$data->id)."/".$data->id:"add_new"); ?>" id="add_new" method="POST" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Người viết</label>
		<input type="radio" id='bo_checkbox' checked name="kyniem_auth" value="Bố" required> <label for="bo_checkbox">Bố </label> 
		<input type="radio" id='me_checkbox' name="kyniem_auth" value="Mẹ" required> <label for="me_checkbox">Mẹ </label>
	</div>

	<div class="form-group">
		<label for="">Tên của kỷ niệm</label>
		<input name="title" type="text" class="form-control" id="" placeholder="Input field" required value="<?= ($data->kyniem_title?$data->kyniem_title:""); ?>">
	</div>
	<div class="form-group">
		<label for="">Nội dung</label>
		<textarea name="content" class="form-control" style="height:250px;" required><?= ($data->kyniem_content?$data->kyniem_content:""); ?></textarea>
	</div>
	<div class="form-group">
		<label for="">File</label>
		<input name="userfile[]" type="file" class="form-control" id="" placeholder="Input field" multiple >
		<?php 
		if($data->kyniem_images){
			$imgs = json_decode($data->kyniem_images);
			foreach ($imgs as $key => $value) {
				echo "<span class='img_ele'><img src='".base_url()."asset/images/".$value."'></span>";
			}
		}
		 ?>
	</div>
	<button type="submit" class="btn btn-primary">Lưu</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>	
</form>