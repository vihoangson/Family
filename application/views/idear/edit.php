<?php
$data_header = [
	"breadcrumb"=>[
		"Idear"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>

<?= form_open_multipart("/idear/edit"); ?>
<form action="" method="POST" role="form" enctype="multipart/form-data">
	<legend>Form title</legend>
	<div class="form-group">
		<label for="">Title</label>
		<input name="txt_title" type="text" class="form-control" id="" placeholder="Input field" required>
	</div>
	<div class="form-group">
		<label for="">Content</label>
		<textarea name ="txt_content" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label for="">Image</label>
		<input name="userfile[]" type="file" class="form-control" id="" placeholder="Input field" multiple>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php $this->load->view('_includes/footer');
?>