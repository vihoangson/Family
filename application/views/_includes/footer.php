		<div class="text-center center-block">
			<p class="txt-railway">- Sweet house -</p>
			<img src="/asset/data/Sweet_House.gif">
			<br />
			<a href="https://www.facebook.com/conduonghanhphuc/"  target="_blank"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
			<a href="http://youtube.com/vihoangson/"  target="_blank"><i id="social-tw" class="fa fa-youtube-square fa-3x social"></i></a>
			<a href="https://picasaweb.google.com/106931759947217084754" target="_blank"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
			<a href="mailto:vihoangson@gmail.com"  target="_blank"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
		</div>
	</div>
	<script>
		//============ ============  ============ ============
		//  Gắn hình mặt cười trong phần nhập liệu
		//============ ============  ============ ============
			jQuery.fn.extend({
				insertAtCaret: function(myValue) {
					return this.each(function(i) {
						if (document.selection) {
							//For browsers like Internet Explorer
							this.focus();
							sel = document.selection.createRange();
							sel.text = myValue;
							this.focus();
						}
						else if (this.selectionStart || this.selectionStart == '0') {
							//For browsers like Firefox and Webkit based
							var startPos = this.selectionStart;
							var endPos = this.selectionEnd;
							var scrollTop = this.scrollTop;
							this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
							this.focus();
							this.selectionStart = startPos + myValue.length;
							this.selectionEnd = startPos + myValue.length;
							this.scrollTop = scrollTop;
						} else {
							this.value += myValue;
							this.focus();
						}
					})
				}
			});

			$(".emotion_icon").click(function(){
				rg = $("#content").val().match(/(\([a-z]*\)|\:\))/g);
				$("#content").insertAtCaret(" "+$(this).attr("alt")+" ");
				$(".icon_box").hide();
			});
		//============ ============  ============ ============
		// END Gắn hình mặt cười trong phần nhập liệu
		//============ ============  ============ ============

		//============ ============  ============ ============
		// Tagit trong phần nhập liệu
		//============ ============  ============ ============
			$(".tag_ele").click(function(){
				rg = $("#content").val().match(/(\([a-z]*\)|\:\))/g);
				$("#content").insertAtCaret(" "+$(this).attr("alt")+" ");		
			});
		//============ ============  ============ ============
		// END Tagit trong phần nhập liệu
		//============ ============  ============ ============

		//============ ============  ============ ============
		// img click
		//============ ============  ============ ============
			$('.image-link').magnificPopup({
				gallery:{enabled:true},
				type:'image',
				delegate: 'a'
			});
		//============ ============  ============ ============
		// END img click
		//============ ============  ============ ============

	</script>
	<script src="<?= base_url(); ?>asset/js/script.js"></script>
	<?php
		//============ ============  ============  ============ 
		//  Phần popup đầu tiên
		if($this->Options_model->get_option("popup_flag")->option_content==1){
			// option popup
			if($this->Options_model->get_option("popup")->option_content ){

				?>
				<div class="modal fade popup" id="modal-general">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<!-- <h4 class="modal-title">Modal title</h4> -->
							</div>
							<div class="modal-body"></div>
						</div>
					</div>
				</div>

				<div class="modal fade popup" id="modal-id-popup">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<!-- <h4 class="modal-title">Modal title</h4> -->
							</div>
							<div class="modal-body"><?= check_popup($this->Options_model->get_option("popup")->option_content); ?></div>
						</div>
					</div>
				</div>
				<script>
					<?php
					if($this->Options_model->get_option("popup_session")->option_content == 1 && $this->session->userdata('popup')!=1){
						?>$("#modal-id-popup").modal("show");
						<?php
						$this->session->set_userdata( ['popup' => 1] );
					}else{
						?>
						$("#button_popup").click(function() {
							$("#modal-id-popup").modal("show");
							return false;
						});
						<?php
					}
					?>
				</script>
				<?php
			}
		}
		// End popup
		//============ ============  ============  ============ 
	//<script src="/asset/js/jquery.lazyload.js"></script>
	?>
	<script>
		//$("img").lazyload();
	</script>
</body>
</html>