<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Admin"=>"/admin",
		"Control popup"=>""
	],
	"custom_js"=>'',
	"custom_html"=> '<h1> <i class="fa fa-image"></i> Control popup </h1>',
];

$this->load->view('_includes/header_admin',$data_header);
?>
<form action="" method="POST" role="form">
	<legend>Controll popup</legend>
	<div class="form-group">
		<label for="">Content</label>
		<div class="thumbnail"><?= check_popup($rs->option_content); ?></div>
		<input type="text" name="content" id="inputContent" class="form-control" value="<?= $rs->option_content; ?>" required="required" title="">
		</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
	<?php
$this->load->view('_includes/footer_admin');
