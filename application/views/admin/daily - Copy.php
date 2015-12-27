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
		<script src="/asset/bower_components/highlight.js/src/highlight.js"></script>
		
		
		<script>hljs.initHighlightingOnLoad();</script>	
	',
	"custom_html"=> '<h1> Daily </h1>',
];
$this->load->view('_includes/header',$data_header); 
$content = file_get_contents($file);
?>

<pre><code class="php">...
ád

ádasdasd

ádasdasd
<?php echo htmlentities('adfadfad <p></p><?php echo 12312312; ?>');?>
</code></pre>
<pre><code class="css"><?php echo htmlentities('
body{
	background:red;
}
	<html>
	<body>
		<p>
			<?php echo 123123123;?>
		</p>
	</body>
</html>') ?></code></pre>



<hr>
<div class="well"><?= h($content); ?></div>
<a href='/admin/daily_controller/edit' type="submit" class="btn btn-primary btn-lg btn-block top-buffer">Edit note</a>
<?php $this->load->view('_includes/footer'); ?>