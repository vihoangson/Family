<?php
$data_header = [
	"breadcrumb"=>[
		"Blog"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>

<p><a href="/blog/create" class="btn btn-info"><i class="fa fa-plus"></i> Create blog</a></p>
<br>
<?php
	if($rs){
		foreach ($rs as $key => $value) {
			?>
			<h4><a href='/blog/detail/<?= $value->id; ?>-<?= createSlug($value->blog_title); ?>'><?= $value->blog_title; ?></a></h4>
			<?php
		}
	}else{
		echo "<h2>No data</h2>";
	}
 ?>

<?php $this->load->view('_includes/footer');
?>