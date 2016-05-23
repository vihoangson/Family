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
	<?php if($rs->blogcomment){ ?>
		<h3>Comment</h3>
		<?php
		// Không sort được thì dùng cách reverse mảng lại
		$rs->blogcomment = array_reverse($rs->blogcomment);
		foreach ($rs->blogcomment as $key => $value) {
			echo $value->comment_content;
			echo "<hr>";
		} ?>
	<?php } ?>
<?php $this->load->view('_includes/footer');
?>