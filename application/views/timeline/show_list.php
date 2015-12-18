<?php
$data_header = [
	"breadcrumb"=>[
		"List time line"=>""
	],
	"custom_html"=> '<p><a href="/timeline/logouttimeline" class="btn btn-default"><i class="fa fa-power-off"></i> Logout timeline</a></p>',
];
$this->load->view('_includes/header',$data_header); ?>

<!-- <h3><a class='btn btn-danger' href="/timeline/delete_all"><i class="fa fa-trash"></i> Delete_all</a></h3> -->
<a href="/timeline/edit" class="btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
<?php
	if(!empty($this->input->get("year"))){
		echo "<p><span class=\"label label-info\">Hình ảnh trong năm ".$this->input->get("year")."</span></p>";
	}
?>
<div class="" onclick="$('.toggle_box').toggle();"><h5><i class="fa fa-angle-down"></i> Tìm kiếm nâng cao</h5></div>
<div class="toggle_box" style="display:none;">
	<div class="well">
		<!-- #List Year -->
		<h3>Hiển thị theo năm </h3>
		<select class="form-control change-year" style="width:155px;">
			<option value=''>== Show all ==</option>
			<option <?= ($this->input->get("year")==2015?"selected":""); ?>>2015</option>
			<option <?= ($this->input->get("year")==2016?"selected":""); ?>>2016</option>
		</select>
		<form action="" method="GET" role="form">
			<div class="form-group">
				<label for="">Keyword</label>
				<input type="text" name="keyword" class="form-control" id="" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Tag</label>
				<input type="text" name="tag" class="form-control" id="" placeholder="Input field">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<a href="#" onclick="$('.toggle_selector').toggle(); return false;" class="btn btn-danger btn-small"><i class="fa fa-plus"></i> Show button delete</a>
</div>
<div class="show_list row">
	<?php
	foreach ($tl as $key => $value) {
		if($value->timeline_image){
			?>
			<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
				<div class="text-center ele_timeline">
					<div class="image-link">
						<a href="/asset/images/timeline/<?= $value->timeline_image; ?>">
							<img src="/asset/images/timeline/<?= $value->timeline_image; ?>" class="img_timeline">
						</a>
					</div>
					<p><h4><?= $value->timeline_title; ?></h4></p>
					<p><h6><?= $value->timeline_date; ?></h6></p>
					<p>
						<a href="/timeline/edit/<?= $value->id; ?>"><i class="fa fa-pencil"></i></a>
						<a class="toggle_selector" href="/timeline/delete/<?= $value->id; ?>"><i class="fa fa-remove"></i></a>
					</p>
				</div>
			</div>
			<?php
		}
	}
	?>
</div>
<script>
	$(".change-year").change(function(event) {
		if($(this).val()==""){
			location.href = "/timeline";
			return;
		}
		location.href = "/timeline/index/?year="+$(this).val();
		return;
	});
</script>
<?php $this->load->view('_includes/footer');
?>