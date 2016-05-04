<?php 
	if(isset($navbar_custom)){
		?>
		<h3>Main menu</h3>
		<div class="list-group">
			<?php foreach ($navbar_custom as $key => $value) {
				?><a href="<?= $value["link"]; ?>" class="list-group-item"><?= $value["text"]; ?></a><?php
			} ?>
			
		</div>
		<?php
	}else{
		?>
		<h3>Default menu</h3>
		<div class="list-group">
			<a href="/admin/admin_page/session_login" class="list-group-item">Session login</a>
			<a href="/admin/admin_page/controll_list_login_facebook" class="list-group-item">List login Facebook</a>
			<a href="/admin/blank_page" class="list-group-item">Blank</a>
			<a href="/admin/files_controller/show" class="list-group-item">Manager Images</a>
			<a href="/admin/control_popup" class="list-group-item">Control popup</a>
			<a href="/phpliteadmin.php" target="_blank" class="list-group-item">PHP Sqlite</a>
		</div>

		<?php
	}


?>

		<h3>Other tool</h3>
		<div class="list-group">
			<a class="list-group-item" href="/blog"><i class="fa fa-gear"></i> Blog</a>
			<a class="list-group-item" href="/blog/create"><i class="fa fa-gear"></i> Viết blog</a>
			<a class="list-group-item" href="/setting"><i class="fa fa-gear"></i> Tùy chỉnh</a>
			<a class="list-group-item" href="/homepage/landpage"><i class="fa fa-pagelines"></i> Landing page</a>
			<a class="list-group-item" href="/Template_view_controller">Template bootstrap</a>
			<a href="/admin/users/index" class="list-group-item"><i class="fa fa-user"></i> Manager user</a>
			<a href="/admin/users/change_password" class="list-group-item"><i class="fa fa-paw"></i> Change password</a>
			<a href="/admin/files_controller/show" class="list-group-item"><i class="fa fa-list"></i> List img gif</a>
			<a href="/admin/files_controller/do_upload" class="list-group-item"><i class="fa fa-upload"></i> Upload img gif</a>
			<a href="/admin/daily_controller/show_markdown" class="list-group-item"><i class="fa fa-sticky-note"></i> Take note</a>
			<a href="/admin/admin_page/instant_imgs" class="list-group-item"><i class="fa fa-image"></i> Instant img</a>
			<a href="/admin/admin_page/view_logs" class="list-group-item"><i class="fa fa-image"></i> View log</a>
		</div>