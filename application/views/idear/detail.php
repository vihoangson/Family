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
	<?php
	$imgs = json_decode($rs->idear_img);
	foreach ((array)$imgs as $key => $value) {
		echo "<p class='text-center'><img style='max-width:100%' src='/asset/images/idear/".$value."' onError='this.src=\"http://placehold.it/100x100\"'></p>";
	}
	?>
	<a href="/idear/edit/<?= $rs->id; ?>"><i class="fa fa-pencil"></i></a> <a href="/idear/delete/<?= $rs->id; ?>"><i class="fa fa-trash"></i></a>


<div class="fb-comments" data-href="http://<?= $_SERVER["HTTP_HOST"]; ?>/idear/detail/<?= $rs->id; ?>" data-width="100%" data-numposts="5"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=1649988411892120";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php $this->load->view('_includes/footer');
?>