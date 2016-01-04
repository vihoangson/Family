<?php
$data_header = [];
 $this->load->view('_includes/header',$data_header); ?>
		<div style="float:none;margin:0 auto;" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

			<div class="panel panel-info">
				  <div class="panel-heading">
						<h3 class="panel-title"> <i class="fa fa-stop-circle"></i>  Bạn cần login để vào khu vực này</h3>
				  </div>
				  <div class="panel-body">
						<form action="" method="POST" role="form">
							<div class="form-group">
								<label for="">Vui lòng nhập password</label>
								<input type="password" name="pass" class="form-control" id="" placeholder="Input field">
							</div>
							<button type="submit" class="btn btn-block btn-primary">Đăng nhập</button>
						</form>
				  </div>
			</div>			
		</div>
		<hr>
<?php $this->load->view('_includes/footer'); ?>