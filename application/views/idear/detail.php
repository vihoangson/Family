<?php
$data_header = [
	"breadcrumb"=>[
		"Idear"          =>"/idear/",
		$rs->idear_title => "",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>
	<h1><?= $rs->idear_title; ?></h1>
	<?= h($rs->idear_content); ?>
	<?php $imgs = json_decode($rs->idear_img);
	foreach ((array)$imgs as $key => $value) {
		echo "<p class='text-center'><img src='/asset/images/idear/".$value."'></p>";
	}
	?>
	<a href="/idear/edit/<?= $rs->id; ?>"><i class="fa fa-pencil"></i></a> <a href="/idear/delete/<?= $rs->id; ?>"><i class="fa fa-trash"></i></a>
<?php $this->load->view('_includes/footer');
?>