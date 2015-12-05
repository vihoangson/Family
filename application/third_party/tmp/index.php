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
		<style>
			.current {
				font-weight: bold;
				color: blue;
			}
			.typing {
				border: 1px solid #ccc;
				font-size: 19px;
				padding: 10px;
			}
			.box_word span {
				padding: 13px;
				float: left;
				font-size: 17px;
				height: 64px;
				width: 236px;
				text-align: center;
			}
			.error {
				color: red;
			}
			.success{
				color: green;
			}
			.card {
				display: block;
				position: fixed;
				top: 0px;
				left: 0px;
				width: 100%;
				background-color: white;
				height: 100%;
				text-align: center;
			}
			p.mean {
				color: #FF0582;
				font-weight: bold;
			}
			.img_box {
				width: 760px;
				margin: 0 auto;
			}
			.img_ele {
				float: left;
				width: 152px;
				padding: 3px;
				height: 152px;
				overflow: hidden;
			}
			.img_ele img{
				width:100%;
			}
		</style>
	</head>
	<body>
		<div class="container" >
			<p>
				<button type="button" id="trogiup" class="btn btn-warning">Trợ giúp</button>
				<button type="button" id="xemketqua" class="btn btn-danger">Xem kết quả</button>
			</p>
			<div class="box_word" data-cur="0">
				<?php 
				$i=0;
				$key_a = array_keys($array);
				shuffle($key_a);
				foreach ($key_a as $key => $value) {
					echo '<span class="word'.$key.'" data-mean="'.htmlentities($array[$value]).'" >'.$value.'</span>';
					if($key>20){
						break;
					}
				}
				 ?>
				 <div class="clearfix"></div>
			</div>			
			<input type="text" name="" id="input" class="typing form-control" value="" required="required" pattern="" title="">
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<script>

		$("#trogiup").click(function(event) {
			if($(".mean").length==0){
				$(".box_word span").each(function(index, el) {
					$(this).prepend("<p class='mean'>"+$(this).data("mean")+"</p>");
				});
				$(".mean").fadeIn(3000);
				window.setTimeout(function(){
					$(".mean").remove();
				
				}, 4000);
			}
		});

		$("#xemketqua").click(function(event) {
			if($(".mean").length==0){
				$(".box_word span").each(function(index, el) {
					$(this).prepend("<p class='mean'>"+$(this).data("mean")+"</p>");
				});
				$(".typing").remove();
				$("#xemketqua").after("\
					<h1>Game Over !</h1>\
					<p>Bạn đã không hoàn thành được mời thử lại</p>\
					");
				$("#xemketqua").html("Làm lại");
			}else{
				location.reload();
			}
		});

		$(".typing").focus();
		cur = 0;
		$(".word"+cur).addClass('current');	
		$(".box_word").data("cur",parseInt($(".box_word").data("cur")));

		$(".typing").keydown(function(event) {
			if(event.which==116){
			}
		});

		$(".typing").keyup(function(event) {
			if(event.which==13){
				$.ajax({
					url: 'ajax.php',
					type: 'post',
					dataType: 'text',
					data: {text: $(".word"+cur).html(),type:$(".typing").val()},
				})
				.done(function(data) {
					if(parseInt(data)==1){
						$(".word"+(parseInt(cur))).addClass('success');
						$(".typing").val("");
						$(".box_word").data("cur",parseInt($(".box_word").data("cur"))+1);
						$(".current").removeClass('current');
						cur = $(".box_word").data("cur");
						$(".word"+cur).addClass('current');
					}else{
						$(".word"+(parseInt(cur))).addClass('error');
						if($(".card").length==0){
							$("body").append("<div class='card'></div>");
						}
						$(".card").html(data);
						$(".card").fadeIn(200);
						window.setTimeout(function(){
							$(".card").fadeOut(200);
							$(".typing").val("");
						}, 4000);
					}					
				});
			}
		});

		function nhaplai3lan(){			


		}
		</script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>