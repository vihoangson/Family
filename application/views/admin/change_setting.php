<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Setting"=>"/setting",
		"Quản lý thành viên" => "/admin/users/index",
		"Thay đổi setting"=>""
	],
	"custom_html"=> '<h1> Thay đổi setting</h1>',
];
$this->load->view('_includes/header',$data_header); ?>

<form action="" method="POST" role="form" enctype="multipart/form-data">
	<legend>Change setting</legend>
	<?php if(file_exists(FCPATH."/asset/images/".$rs->user_avatar)){
		?><p><img src="/asset/images/<?= $rs->user_avatar; ?>"></p><?php
	}?>
	<div class="form-group">
		<label for="">Avatar</label>
		<input type="file" name="userfile" class="form-control" id="" placeholder="Input field">
	</div>

	<button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
</form>
<?php $this->load->view('_includes/footer'); ?>