<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Admin"=>"/admin",
		"Session login"=>""
	],
	"custom_js"=>'',
	"custom_html"=> '<h1> <i class="fa fa-sticky-note"></i> Admin page </h1>',
];

$this->load->view('_includes/header_admin',$data_header); 
	foreach ($rs as $key => $value) {
		echo "<h4>".$value->archive_key."</h4>";
		print_r(array_values(json_decode($value->archive_content,true)));
		echo "<p><small>".$value->archive_create."</small></p>";
		echo "<hr>";
	}
$this->load->view('_includes/footer_admin');
