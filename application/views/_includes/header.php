<?php 
if(!$navigation_bar){
	$navigation_bar = [
		base_url() => "Trang chủ",
		base_url()."admin" => "Admin",
	];
}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Learning English</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/css/family.css" rel="stylesheet">
		<link href="<?= base_url(); ?>/asset/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
		<?php 
		if(isset($css)){
			foreach ((array)$css as $key => $value) {
				?><link href="<?= $value; ?>" rel="stylesheet">
				<?php
			}
		}
		if(isset($js)){
			foreach ((array)$js as $key => $value) {
				?><script src="<?= $value; ?>"></script>
				<?php
			}
		}
		?>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="<?= base_url(); ?>/asset/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
		<script>
			$(document).ready(function() {
				$('.image-link').magnificPopup({
					gallery:{enabled:true},
					type:'image',
					delegate: 'a'
				});
			});
		</script>
	</head>
	<body>

		<div class="container">
		<?php 
		if($this->session->flashdata('error_upload')){
			print_r($this->session->flashdata('error_upload'));
		}
		if($this->router->fetch_method()!="login"){
			$this->load->view('_includes/navbar');
		}
		 ?>
