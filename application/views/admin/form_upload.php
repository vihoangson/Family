<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Setting"=>"/setting",
		"Upload hình ảnh"=>""
	],
	"custom_html"=> '<h1> Nơi up hình ảnh cần thiết </h1>',
];
$this->load->view('_includes/header',$data_header); ?>
<form action="/admin/files_controller/do_upload" method="POST" role="form" enctype="multipart/form-data" >
	<legend>Upload file</legend>
	<div class="form-group">
		<label for="">Tiêu đề</label>
		<input type="text" name="file_title" class="form-control" id="" placeholder="Input field">
	</div>
	<div class="form-group">
		<label for="">File</label>
		<input type="file" name="userfile" class="form-control" id="" placeholder="Input field">
	</div>
	<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
</form>
<hr>
<p><button type='button' onclick='$(".hide_box").toggle()'><i class='fa fa-eye'></i></button></p>
<div class="row">
	<?php foreach ($rs as $key => $value) {
		if(file_exists($value->files_path.$value->files_name)){
			$value->files_path_url = str_replace(FCPATH, "/", $value->files_path);
			?>
			<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
				<?php echo "
				<div>
					<div  class='thumbnail'>
						<img src='".$value->files_path_url.$value->files_name."'>
					</div>
					<p><input type='text' class='form-control' value='".$value->files_title."'></p>
					<p><input type='text' class='form-control' value='".preg_replace("/\/$/", "", base_url()).$value->files_path_url.$value->files_name."'></p>
					<div class='hide_box'>
						<a href='/admin/files_controller/delete/".$value->id."' class='btn btn-danger'><i class='fa fa-trash'></i></a>
					</div>
				</div>
				"; ?>
			</div>
			<?php
		}
	} ?>
</div>
<?php $this->load->view('_includes/footer'); ?>
