
<form action="<?= base_url(); ?>homepage/add_new" id="add_new" method="POST" role="form" enctype="multipart/form-data">
	<div class="form-group">
		<label for="">Người viết</label>
		<input type="radio" id='bo_checkbox' checked name="kyniem_auth" value="Bố" required> <label for="bo_checkbox">Bố </label> 
		<input type="radio" id='me_checkbox' name="kyniem_auth" value="Mẹ" required> <label for="me_checkbox">Mẹ </label>
	</div>

	<div class="form-group">
		<label for="">Tên của kỷ niệm</label>
		<input name="title" type="text" class="form-control" id="" placeholder="Input field" required>
	</div>
	<div class="form-group">
		<label for="">Nội dung</label>
		<textarea name="content" class="form-control" style="height:250px;" required></textarea>
	</div>
	<div class="form-group">
		<label for="">File</label>
		<input name="userfile[]" type="file" class="form-control" id="" placeholder="Input field" multiple >
	</div>
	<button type="submit" class="btn btn-primary">Lưu</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>	
</form>