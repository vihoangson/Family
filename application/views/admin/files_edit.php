<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Setting"=>"/setting",
		"File list"=>"/admin/files_controller/show",
		"Chỉnh sửa hình ảnh"=>""
	],
	"custom_html"=> '<h1> Chỉnh sửa hình ảnh </h1>',
];
$this->load->view('_includes/header_admin',$data_header);

$url_img = str_replace(FCPATH, "/", $rs->files_path);
?>

	<div class="thumbnail"><img src="<?= $url_img.$rs->files_name; ?>"></div>
	<div>
		<a href="/admin/files_controller/rotate_img_files/files_<?= $rs->id; ?>/left" class="btn btn-default"><i class="fa fa-rotate-right"></i></a>
		<a href="/admin/files_controller/rotate_img_files/files_<?= $rs->id; ?>/right" class="btn btn-default"><i class="fa fa-rotate-left"></i></a>
	</div>

<?php $this->load->view('_includes/footer_admin'); ?>
