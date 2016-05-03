<?php
$data_header = [
	"breadcrumb"=>[
		"Blog"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>

<?php 
foreach ($rs as $key => $value) {
	?>
	<h4><a href='/blog/detail/<?= $value->id; ?>-<?= createSlug($value->blog_title); ?>'><?= $value->blog_title; ?></a></h4>
	<?php
	
	
}
 ?>

<?php $this->load->view('_includes/footer');
?>