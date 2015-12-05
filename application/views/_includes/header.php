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
	</head>
	<body>

		<div class="container">

			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url(); ?>">Learning English</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<?php 
						foreach ((array)$navigation_bar as $key => $value) {
							echo "<li><a href=\"".$key."\">".$value."</a></li>";
						} ?>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Link</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>

			<ol class="breadcrumb">
				<li>
					<a href="<?= base_url();?>">Trang chủ</a>
				</li>
				<?php if($this->router->fetch_class()){ ?>
				<li>
					<a href="<?= base_url().$this->router->fetch_class(); ?>"><?= $this->router->fetch_class(); ?></a>
				</li>
				<?php } ?>
				<?php if($this->router->fetch_method() && $this->router->fetch_method() != "index"){ ?>
				<li class="actice">
					<?= $this->router->fetch_method(); ?>
					<!-- <a href="<?= base_url().$this->router->fetch_class()."/".$this->router->fetch_method(); ?>"></a> -->
				</li>
				<?php } ?>
			</ol>

		<div class="clearfix"></div>