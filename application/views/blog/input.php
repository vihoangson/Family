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
	
	<p><input type="text" class="form-control" name="title" value="<?= (isset($data->blog_title)?$data->blog_title:""); ?>"></p>
	
	<?= (isset($data->id)?"<input type='hidden' value='".$data->id."' name='id'>":""); ?>

	<p><a class="btn btn-info" href="https://vihoangson.wordpress.com/wp-admin/media-new.php" target="_blank">Upload to Wordpress.com</a></p>
	
	<div id = "summernote"><?= (isset($data->blog_content)?$data->blog_content:""); ?></div>
	
	<button type="button" class="btn btn-primary submit-blog">Submit</button>
	
	<textarea name="content" style="display:none;"></textarea></form>

	<script>
		$("#summernote").summernote({height:300,lang:"VN"});
		$(".submit-blog").click(function(event) {
			$("[name='content']").html($("#summernote").summernote("code"))
			$("form").submit();
		});
	</script>
	<!-- <?= (isset($data->id)?$data->id:""); ?> -->
	<!-- <?= (isset($data->blog_title)?$data->blog_title:""); ?> -->
	<!-- <?= (isset($data->blog_content)?$data->blog_content:""); ?> -->
	<!-- <?= (isset($data->blog_extra)?$data->blog_extra:""); ?> -->
	<!-- <?= (isset($data->blog_image)?$data->blog_image:""); ?> -->
	<!-- <?= (isset($data->created_at)?$data->created_at:""); ?> -->
	<!-- <?= (isset($data->updated_at)?$data->updated_at:""); ?> -->
	<!-- <?= (isset($data->deleted_at)?$data->deleted_at:""); ?> -->
<?php $this->load->view('_includes/footer');
?>

