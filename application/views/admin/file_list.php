<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Setting"=>"/setting",
		"File list"=>"",
	],
	"custom_html"=> '<h1> Nơi up hình ảnh cần thiết </h1>',
];
$this->load->view('_includes/header_admin',$data_header); ?>

<p><a href="/admin/files_controller/do_upload" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm media</a> <button type='button' onclick='$(".hide_box").toggle()'><i class='fa fa-eye'></i></button></p>
<div class="row">
	<?php foreach ($rs as $key => $value) {
		if(true){
			$value->files_path_url = str_replace(FCPATH, "/", $value->files_path);
			?>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<?php echo "
				<div>
					<div class='image-link' >
						<a class='thumbnail ' target='_blank' href='".$value->files_path_url.$value->files_name."'>
							<img src='".$value->files_path_url."".$value->files_name."' onError='".$value->files_path_url.$value->files_name."'>
						</a>
					</div>
					<p><input type='text' class='form-control' value='".$value->files_title."'></p>
					<p><input type='text' class='form-control' value='".preg_replace("/\/$/", "", base_url()).$value->files_path_url.$value->files_name."'></p>
					<div class='hide_box'>
						<a href='/admin/files_controller/delete/".$value->id."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
						<a href='/admin/files_controller/edit/".$value->id."' class='btn btn-default'><i class='fa fa-pencil'></i></a>
					</div>
				</div>
				"; ?>
			</div>
			<?php
		}
	} ?>
</div>
<?php $this->load->view('_includes/footer_admin'); ?>
