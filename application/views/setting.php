<?php $this->load->view('_includes/header'); ?>
	<div class="list-group">
		<a href="/admin/users/index" class="list-group-item">Manager user</a>
		<a href="/admin/users/change_password" class="list-group-item">Change password</a>
		<a href="/homepage/custom/sample_markdown" class="list-group-item">Mark down</a>
	</div>

	<hr>

	<a href="/homepage/cron" class="btn btn-default" target="_blank">
		Test send mail
	</a>
	<a href="/homepage/cron/backup_db_family" class="btn btn-default" target="_blank">
		Sent mail back up DB
	</a>
	<a href="/homepage/cron/backup_file_images_family" class="btn btn-default" target="_blank">
		Sent mail back up file images
	</a>
	
	
<?php $this->load->view('_includes/footer'); ?>