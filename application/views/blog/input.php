<?php
$data_header = [
	"breadcrumb"=>[
		"Blog"=>"/blog",
		"Create"=>"",
	],
	"js"=>["/asset/js/summer_note/summernote.min.js"],
	"css"=>["/asset/js/summer_note/summernote.css"],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>
<form method="post" action="">
	<p><input type="text" class="form-control" name="title"></p>
	<div id = "summernote"></div>
	<button type="button" class="btn btn-primary submit-blog">Submit</button>
	<textarea name="content" style="display:none;"></textarea></form>
<script>
	$("#summernote").summernote({height:300,lang:"VN"});
	$(".submit-blog").click(function(event) {
		$("[name='content']").html($("#summernote").summernote("code"))
		$("form").submit();
	});
</script>
<?php $this->load->view('_includes/footer');
?>