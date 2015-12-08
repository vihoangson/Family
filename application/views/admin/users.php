<?php $this->load->view('_includes/header'); ?>
<?php
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

?>
<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Thêm user mới</a>
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thêm user mới</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form">
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" name="username" class="form-control" id="" placeholder="Input field">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input type="password" name="password" class="form-control" id="" placeholder="Input field">
					</div>
					<div class="form-group">
						<label for="">Thành viên</label>
						<select  name="type" class="form-control" >
							<option value="0">Khách</option>
							<option value="0">Admin</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<table class="table table-hover">
	<thead>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Type</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($rs as $key=>$value){
			?>
		<tr>
			<td><?= $value->username; ?></td>
			<td><?= $value->password; ?></td>
			<td><?= $value->type; ?></td>
		</tr>
			<?php
		} ?>

	</tbody>
</table>
<?php $this->load->view('_includes/footer'); ?>