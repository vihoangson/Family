<?php
$data_header = [];
 $this->load->view('_includes/header',$data_header); ?>
		<form action="" method="POST" role="form">
			<legend><i class="fa fa-inbox"></i> Login</legend>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" name="pass" class="form-control" id="" placeholder="Input field">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
<?php $this->load->view('_includes/footer'); ?>