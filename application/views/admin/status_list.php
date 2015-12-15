<?php $this->load->view('_includes/header'); ?>
<?php
		if($files && count($files)>2){
			echo "
			<h2>Danh sách file trong folder tmp</h2>
			<div class='well'>
				<ul>";
					foreach ($files as $key => $value) {
						if(!in_array($value, [".",".."])){
							echo "<li><a href='".base_url()."asset/tmp/".$value."'>".$value."</a></li>";
						}
					}
				echo "
				</ul>
			</div>
			";
			?><p><a href="/admin/status/<?= $case_delete; ?>/ok" class="btn btn-danger">Xóa hết file <?= $case_delete; ?></a></p><?php
		}else{
			echo "<h2>Không có file</h2>";
		}
 ?>
<script>
	$("a.btn-danger").click(function(){
		return confirm("Bạn có muốn xóa tất cả file?");
	});
</script>
<?php $this->load->view('_includes/footer'); ?>