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
		<title><?= (!isset($title)?"Sweet house":$title); ?></title>
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />
		<!-- Bootstrap CSS -->
		<link href="<?= base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/css/family.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/css/button_switch.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/js/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/bower_components/bootstrap-sweetalert/dist/sweetalert.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/bower_components/Snarl/dist/snarl.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/bower_components/animate.css/animate.min.css" rel="stylesheet">
		<link href="<?= base_url(); ?>asset/bower_components/jquery-ui/themes/base/jquery-ui.min.css" rel="stylesheet">
		
		<?php
		if(isset($css)){
			foreach ((array)$css as $key => $value) {
				?><link href="<?= $value; ?>" rel="stylesheet">
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
		<script src="<?= base_url(); ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?= base_url(); ?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?= base_url(); ?>asset/js/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
		<script src="<?= base_url(); ?>asset/bower_components/jquery-form/jquery.form.js"></script>
		<script src="<?= base_url(); ?>asset/bower_components/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
		<script src="<?= base_url(); ?>asset/bower_components/Snarl/dist/snarl.min.js"></script>
		<script src="<?= base_url(); ?>asset/bower_components/jquery-ui/jquery-ui.min.js"></script>
		<script src="<?= base_url(); ?>asset/bower_components/blueimp-file-upload/js/jquery.fileupload.js"></script>
		<script src="<?= base_url(); ?>asset/js/app.js"></script>



		<?php
		if(isset($js)){
			foreach ((array)$js as $key => $value) {
				?><script src="<?= $value; ?>"></script>
				<?php
			}
		}
		?>
		<?= (isset($custom_js)?$custom_js:""); ?>
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

		if(!empty($this->session->flashdata('item'))){
			$keys   = array_keys($this->session->flashdata('item'));
			$values = array_values($this->session->flashdata('item'));
			foreach ($keys as $key => $value) {
				?>
				<div class="alert alert-<?= $keys[$key]; ?>">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Thông báo: </strong> <?php echo $values[$key]; ?>
				</div>
				<?php
			}
		}
		if($breadcrumb){
			?>
	<ol class="breadcrumb">
		<li>
			<a href="/"><i class="fa fa-home"></i> Trang chủ</a>
		</li>
			<?php
			foreach ($breadcrumb as $key => $value) {
				echo '
				<li>
					'.($value!=""?"<a href='".$value."'>".$key."</a>":$key).'
				</li>
				';
			}
			?>
	</ol>
			<?php
		}
		if($custom_html){
			echo $custom_html;
		}
		if($this->session->flashdata('alert')){
			?>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Alert!</strong> <?= $this->session->flashdata('alert'); ?>
			</div>
			<?php
		}
		if(isset($alert)){
			?>
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Alert!</strong> <?= $alert; ?>
			</div>
			<?php
		}