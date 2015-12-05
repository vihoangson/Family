<?php $this->load->view('_includes/header'); ?>

	<div class="row">
		<h2>Time Line</h2>
	</div>
	<div class="text-right">
		<button type="button" id="button_add" class="btn btn-primary">Thêm</button>
	</div>
    <div class="qa-message-list" id="wallmessages">
	<?php
	foreach($kn as $key=>$value){
		  ?> 
				<div class="message-item" id="m16">
					<div class="message-inner">
						<div class="message-head clearfix">
							<div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"></a></div>
							<div class="user-detail">
								<h5 class="handle"><?= $value->kyniem_title; ?></h5>
								<div class="post-meta">
									<div class="asker-meta">
										<span class="qa-message-what"></span>
										<span class="qa-message-when">
											<span class="qa-message-when-data">Jan 21</span>
										</span>
										<span class="qa-message-who">
											<span class="qa-message-who-pad">by </span>
											<span class="qa-message-who-data"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko">Oleg Kolesnichenko</a></span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="qa-message-content">
							<?= $value->kyniem_content; ?>
						</div>
					</div>
				</div>
		   <?php 
		} ?>
	</div>

	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Hạnh phúc là một quá trình không phải là đích đến</h4>
				</div>
				<div class="modal-body">
					<?php $this->load->view('ajax_add_new'); ?>
				</div>
			</div>
		</div>
	</div>
<script>
	$("#button_add").click(function(event) {
			$("#modal-id").modal();
	});
	$("#add_new").submit(function(event) {
		$.post('<?= base_url(); ?>homepage/ajax_add_new', $("#add_new").serialize() , function(data, textStatus, xhr) {
			if(parseInt(data)==0){
				$("#add_new").append("Error");
			}else{
				location.reload();
			}
		});
		event.preventDefault();
	});
</script>
<?php $this->load->view('_includes/footer'); ?>