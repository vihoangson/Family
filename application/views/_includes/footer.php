		</div>
	<?php if(DEBUG_MOD){ ?>
	<style>
		button.toggle_debug {
		    position: fixed;
		    top: 0px;
		    right: 0px;
		}

		.toggle_debug_box {
		    position: absolute;
		    top: 0px;
		    left: 0px;
		}
	</style>
	<button  onclick="" class="toggle_debug btn btn-default">Debug(F2)</button>
	<hr>
	<div style="display:none;" class='toggle_debug_box'>
	<button type="button" class="btn btn-danger debug_close">Close</button>
	<?php d($this->_ci_cached_vars);
	echo "<h2>Last Query</h2>";
	d($this->db->last_query());
	?>
	</div>
	<script>
		$(".toggle_debug,.debug_close").click(function(){
			$('.toggle_debug_box').toggle();
		});

		$(document).keyup(function(event){
		    if(event.which==113){
		    	$(".toggle_debug").trigger("click");
		        event.preventDefault();
		        return false;
		    }
		});
	</script>
	<?php } ?>

	</body>
</html>