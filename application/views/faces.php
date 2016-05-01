<?php $this->load->view('_includes/header',[]); ?>
	<h2> Gương mặt thân quen </h2>
	<div class="row">
		<?php 
			foreach ($json_face as $key => $value) {
				echo "<div class='col-sm-2'><div class='thumbnail'><img src='".$value."'></div></div>";
			}
		 ?>
	</div>
<?php $this->load->view('_includes/footer'); ?>