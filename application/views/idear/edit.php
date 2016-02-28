<?php
$data_header = [
	"breadcrumb"=>[
		"Idear"=>"/idear/",
		"Add new"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>

<?= form_open_multipart("/idear/edit/".($rs->id?$rs->id:"")); ?>
<form action="" method="POST" role="form" enctype="multipart/form-data">
	<legend>Ý tưởng của gia đình nhỏ</legend>
	<div class="form-group">
		<label for="">Title</label>
		<input value="<?= $rs->idear_title; ?>" name="txt_title" type="text" class="form-control" id="" placeholder="Input field" required>
	</div>
	<div class="form-group">
		<label for="">Content</label>
		<textarea value="<?= $rs->idear_content; ?>" name ="txt_content" class="form-control"><?= $rs->idear_content; ?></textarea>
	</div>
	<div class="form-group">
		<label for="">Image</label>
		<input name="userfile[]" type="file" class="form-control" id="" placeholder="Input field" multiple>
		<?php if($rs->idear_img){
				$imgs = json_decode($rs->idear_img);
				echo "<div class='row'>";
				foreach ((array)$imgs as $key => $value) {
					echo "<div class='col-md-2'><span class='thumbnail'><img src='/asset/images/idear/$value'></span><p><button type='button' class='rm-img-idear' data-img='$value'>Remove</button></p></div>";
				}
				echo "</div>";
			} ?>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
	$(".rm-img-idear").click(function(){
		var this_s = $(this);
		$.post('/idear/ajax_delete_img', {img: $(this).data("img")}, function(data, textStatus, xhr) {
			if(parseInt(data)==1){
				this_s.parents("div.col-md-2").remove();
			}else{
				alert("Can't delete img, please try again");
			}
		});
	});
</script>
<?php $this->load->view('_includes/footer');
?>