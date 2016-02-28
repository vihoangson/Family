<?php
$data_header = [
	"breadcrumb"=>[
		"Idear"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>
<?php foreach ($rs as $key => $value) {
	echo $value->idear_content."<br>";
} ?>
<?php $this->load->view('_includes/footer');
?>