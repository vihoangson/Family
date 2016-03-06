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
	<div class="row" style="">
		<div class="col-sm-3 col-md-3 text-right">
			<span><b>Username</b></span>
		</div>
		<div class="col-sm-9 col-md-9 text-left">
			<div class="form-group">
				<input type="text" name="username" class="form-control" id="" placeholder="Input field" value="<?= $rs->username; ?>">
			</div>
		</div>
	</div>
	<div class="row" style="">
		<div class="col-sm-3 col-md-3 text-right">
			<span><b>Avatar</b></span>
		</div>
		<div class="col-sm-9 col-md-9 text-left">
			<?php if(file_exists(FCPATH."/asset/images/".$rs->user_avatar)){
				?><p><img style="max-width: 100px;" src="/asset/images/<?= $rs->user_avatar; ?>"></p><?php
			}?>
			<div class="form-group">
				<input type="file" name="userfile" class="form-control" id="" placeholder="Input field">
			</div>
		</div>
	</div>
	<br>
	<p><button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button></p>
</form>
<?php $this->load->view('_includes/footer'); ?>