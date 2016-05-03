<nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<?= base_url(); ?>"><img style="margin-top:-6px;display:inline;" src="/favicon.ico"> My Family</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li class="active"><a href="<?= base_url(); ?>">Trang chủ</a></li>
			<?= ($this->Options_model->get_option("popup_flag")->option_content==1?'<li><a href="#" id="button_popup">Popup</a></li>':'') ?>
		</ul>
		<form action="/homepage/search_keyword" class="navbar-form navbar-left" role="search" method="post">
			<div class="form-group">
				<input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm">
			</div>
			<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="<?= base_url(); ?>calendar">Lịch gia đình</a></li>
			<li><a href="<?= base_url(); ?>count_down">Ngày dự sính</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Người dùng <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>admin"><i class="fa fa-user"></i> Admin page</a></li>
					<li><a href="<?= base_url(); ?>timeline"><i class="fa fa-image"></i> Time line</a></li>
					<li><a href="<?= base_url(); ?>idear"><i class="fa fa-eye"></i> Idear</a></li>
					<li><a href="<?= base_url(); ?>homepage/custom/tool"><i class="fa fa-facebook"></i> Các công cụ liên quan</a></li>
					<li><a href="<?= base_url(); ?>logout"><i class="fa fa-power-off"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>
