<?php
$data_header = [
	"breadcrumb"=>[
		"List time line"=>""
	]
];
$this->load->view('_includes/header',$data_header); ?>
<a href="/timeline/edit" class="btn btn-primary"><i class="fa fa-plus"></i> Add new</a>
<div class="show_list">
	<?php
	foreach ($tl as $key => $value) {
		if($value->timeline_image){
			?>
			<div class="text-center ele_timeline">
				<img src="/asset/images/timeline/<?= $value->timeline_image; ?>" style="height:100px;">
				<p><h4><?= $value->timeline_title; ?></h4></p>
				<p><a href="/timeline/edit/<?= $value->id; ?>"><i class="fa fa-pencil"></i></a></p>
			</div>
			<?php
		}
	}
	?>
</div>
<?php $this->load->view('_includes/footer');
?>