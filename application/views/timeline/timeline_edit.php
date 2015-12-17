<?php
$data_header = [
	"css"=>[base_url()."asset/bower_components/jquery-ui/themes/base/jquery-ui.min.css"],
	"js"=>[base_url()."asset/bower_components/jquery-ui/jquery-ui.min.js"],
	"breadcrumb"=>[
		"List time line"=>"/timeline",
		"Edit time line"=>""
	]
];
 $this->load->view('_includes/header',$data_header); ?>

	<form action="" method="POST" role="form" enctype="multipart/form-data">
		<legend>Time line</legend>
		<?php
		if($rs->timeline_image){
			?><p class="text-center"><img src="/asset/images/timeline/<?= $rs->timeline_image; ?>" style="height:100px;"></p><?php
		}
		?>
		<div class="form-group">
			<label for="">File hình</label>
			<input type="file" class="form-control" id="" placeholder="Input field"  name="timeline_image">
		</div>
		<div class="form-group">
			<label for="">Tiêu đề</label>
			<input type="text" class="form-control" id="" placeholder="Input field"  name="timeline_title" value="<?= $rs->timeline_title; ?>">
		</div>
		<div class="" onclick="$('.toggle_box').toggle();"><h5><i class="fa fa-angle-down"></i> Chi tiết</h5></div>
		<div class="toggle_box" style="display:none;">
			<div class="form-group">
				<label for="">Ngày tháng</label>
				<input type="text" class="form-control datepicker" id="" placeholder="Input field"  name="timeline_date" value="<?= ($rs->timeline_date?$rs->timeline_date:date("d-m-Y")); ?>">
			</div>
			<div class="form-group">
				<label for="">Tag</label>
				<input type="text" class="form-control" id="" placeholder="Input field"  name="timeline_tag" value="<?= $rs->timeline_tag; ?>">
			</div>
			<div class="form-group">
				<label for="">Ghi chú</label>
				<textarea type="text" style="height:200px;" class="form-control" id="" placeholder="Input field"  name="timeline_note"><?= $rs->timeline_note; ?></textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
	</form>
	<script>
		$(document).ready(function() {
			$(".datepicker").datepicker({dateFormat: "dd-mm-yy"});
		});
	</script>
<?php $this->load->view('_includes/footer'); ?>
