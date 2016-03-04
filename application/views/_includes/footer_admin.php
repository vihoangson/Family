	</div>
</div>
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

		$(".tag_ele").click(function(){
			rg = $("#content").val().match(/(\([a-z]*\)|\:\))/g);
			$("#content").insertAtCaret(" "+$(this).attr("alt")+" ");		
		});
	</script>
</body>
</html>