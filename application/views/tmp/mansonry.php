<?php $this->load->view('_includes/header',["js"=>["/asset/bower_components/masonry/dist/masonry.pkgd.min.js"]]); ?>
<div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
	<?php
		foreach ($data as $key => $value) {
			if($value->kyniem_title){
				?>
				<div class="grid-item">
					<div class="well" style="margin:3px;">
						<h4><?= $value->kyniem_title; ?></h4>
						<?= $value->kyniem_create; ?>
					</div>
				</div>
				<?php
			}
		}
	?>
</div>
<script>
	$('.grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: 200
	});
</script>
<?php $this->load->view('_includes/footer'); ?>