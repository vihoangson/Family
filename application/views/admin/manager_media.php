<?php
$data_header = [
	"css"=>[],
	"js"=>[],
	"breadcrumb"=>[
		"Admin"=>"/admin",
		"Manager media"=>"",
	],
	"custom_js"=>'',
	"custom_html"=> '<h1> <i class="fa fa-sticky-note"></i> Manager media </h1>',
];
$this->load->view('_includes/header_admin',$data_header);
		if($success){
			?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Success: </strong> <?= $success; ?>
			</div>
			<?php
		}
		if($error){
			?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Error: </strong> <?= $error ?>
			</div>
			<?php
		}

		echo '<p><button class="btn btn-default upload-btn"><i class="fa fa-plus"></i> Upload</button></p>';
		?>
		<progress value="0" max="100" class="hidden"></progress>
		<form id='upload_form' method="post" enctype="multipart/form-data" data-reload="true">
			<input type="file" style="display:none;" name='file_x'>
		</form>
		<?php
		echo "<div class='row list-media'></div>";
?>
<hr>
<form action="" method="post">
	<p><button type="submit" class="btn btn-danger" value="delete" name="submit"><i class="fa fa-trash"></i> Delete</button></p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rs as $key => $value) {
				?>
				<tr>
					<td style="width:20px; text-align:center;"><input type="checkbox" name="media_id[]" value="<?= $value->id; ?>"></td>
					<td>
						<img style="width:100px;" src="<?= $value->files_path."/".$value->files_name; ?>">
					</td>
					<td><?= $value->id; ?></td>
				</tr>
				<?php
			} ?>
		</tbody>
	</table>
</form>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<div class="modal fade" id="modal-upload-media">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script src="/asset/js/jquery.form.js"></script>
<script src="/asset/js/media-box.js"></script>
<!-- ============ ============ ============ ============  ============  ============  ============  ============  -->
<?php
$this->load->view('_includes/footer_admin');
