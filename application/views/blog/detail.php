<?php
$data_header = [
	"breadcrumb"=>[
		"Blog"=>"/blog",
		$rs->blog_title=>"",
	],
	"title"=> $rs->blog_title,
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>
	<h2><?= $rs->blog_title; ?></h2>
	<article><?= $rs->blog_content; ?></article>
<?php $this->load->view('_includes/footer');
?>