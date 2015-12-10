<?php $this->load->view('_includes/header'); ?>
<form action="" method="POST" role="form">
	<legend>Change password</legend>
	<div class="form-group">
		<label for="">Old password</label>
		<input type="password" class="form-control" name="old_password" id="" placeholder="Input field">
	</div>
	<div class="form-group">
		<label for="">New password</label>
		<input type="password" class="form-control" name="new_password" id="" placeholder="Input field">
	</div>
			<div class="form-group">
		<label for="">Re-new password</label>
		<input type="password" class="form-control" name="renew_password" id="" placeholder="Input field">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php $this->load->view('_includes/footer'); ?>