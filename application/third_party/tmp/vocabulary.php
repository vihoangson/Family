<?php 	require "data.php"; ?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Learning English</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container" >
			<div class="box_word" data-cur="0">
			<table class="table table-hover">
				<thead>
					<tr>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>


				<?php 
				foreach ($array as $key => $value) {
					?>
					<tr>
						<td><h2><?php echo $key ?></h2></td>
						<td class="vietnamese" style="display:none;"><?php echo $value ?></td>
						<td><img src='images/<?php echo $key ?>_0.jpg'><img src='images/<?php echo $key ?>_1.jpg'><img src='images/<?php echo $key ?>_2.jpg'></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
				<div class="clearfix"></div>
			</div>			
			<input type="text" name="" id="input" class="typing form-control" value="" required="required" pattern="" title="">
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<script>
  $(document).unbind('keyup');
  $(document).keyup(function(e){
    if(e.which==113||e.which==114){
      console.log(e.which);
      $(".vietnamese").toggle();
      e.preventDefault();
    }
  });
		</script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>