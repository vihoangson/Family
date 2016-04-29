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

