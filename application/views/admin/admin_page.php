<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Admin"=>"",
	],
	"custom_js"=>'',
	"custom_html"=> '<h1> <i class="fa fa-sticky-note"></i> Admin page </h1>',
];
$this->load->view('_includes/header_admin',$data_header);

echo "<h3>Admin page </h3>";

?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Satus</h3>
	</div>
	<div class="panel-body">
		<?= get_status(); ?>
	</div>
</div>
<?php
$this->load->view('_includes/footer_admin');
