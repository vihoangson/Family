<?php $this->load->view('_includes/header'); ?>

	<div class="row">
		<h2>Time Line</h2>
	</div>
    <div class="qa-message-list" id="wallmessages">
	<?php for($i=0;$i<10;$i++){
		  ?> 
				<div class="message-item" id="m16">
					<div class="message-inner">
						<div class="message-head clearfix">
							<div class="avatar pull-left"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko"><img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png"></a></div>
							<div class="user-detail">
								<h5 class="handle">Oleg Kolesnichenko</h5>
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
							Yo!
						</div>
					</div>
				</div>
		   <?php 
		} ?>
	</div>

<?php $this->load->view('_includes/footer'); ?>