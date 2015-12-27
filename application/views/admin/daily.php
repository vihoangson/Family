<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Setting"=>"/setting",
		"Daily"=>""
	],
	"custom_js"=>'
	
		<link href="/asset/bower_components/highlight.js/src/styles/default.css" rel="stylesheet">
		<link href="/asset/bower_components/highlight.js/src/styles/agate.css" rel="stylesheet">
		<script src="/asset/bower_components/highlight.js/src/highlight.min.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>	
	',
	"custom_html"=> '<h1> <i class="fa fa-sticky-note"></i> Note </h1>',
];
$this->load->view('_includes/header',$data_header); 
$content = file_get_contents($file);
?>
<div class="well"><?= h($content); ?></div>
<a href='/admin/daily_controller/<?= ($markdown?"edit_markdown":"edit"); ?>' type="submit" class="btn btn-primary btn-lg btn-block top-buffer">Edit note</a>
<?php $this->load->view('_includes/footer'); ?>