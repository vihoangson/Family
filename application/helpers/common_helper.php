<?php 
	function get_thumb_file_name($file_name){
		$file_name_new = preg_replace("/(\.)(\w{3,4})/", "_thumb.$2", $file_name);
		return $file_name_new;
	}

	function h($string){
		$CI =& get_instance();
		$key = array_keys($CI->config->item("emotion_yahoo"));
		$value = array_values($CI->config->item("emotion_yahoo"));
		$string = str_replace($key, $value, $string);
		$string = Markdown::defaultTransform($string);
		$string = preg_replace("/\(\#(\w+)\)/", "<a href='/homepage/tags/$1'>#$1</a>", $string);
		return $string;
	}

	function show_social(){
		?>
		<div class="" style="margin:20px auto; width:325px;">
			<ul class="social-network social-circle">
				<li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
				<li><a href="https://www.facebook.com/conduonghanhphuc/" target="_blank" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
				<li><a href="http://youtube.com/vihoangson/" class="icoTwitter" title="Twitter"><i class="fa fa-youtube"></i></a></li>
				<li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="https://github.com/vihoangson/Family" class="icoLinkedin" title="Linkedin"><i class="fa fa-github"></i></a></li>
			</ul>
		</div>
		<?php
	}


	function get_content_countdown(){
		$date1=date_create(date("Y-m-d h:i:s",time()));
		$date2=date_create("2016-05-20");
		$diff=date_diff($date1,$date2);
		$days = $diff->days;
		$percent = 100-round(($days/266)*100);
		$m = $diff->m;
		$d = $diff->d;
		$h = $diff->h;
		$i = $diff->i;
		$s = $diff->s;
		$html = "
		<center>
			<h2 class='text-center'>Ngày dự sinh: <br>".date("d-m-Y",$date2->getTimestamp())."</h2>
			<h1>".$days." Ngày</h1>
			<h3>".$m." Tháng ".$d." Ngày - ".$h." Giờ ".$i." Phút ".$s." Giây </h3> 
			".'
			<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$percent.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percent.'%">
					<span class="sr-only">'.$percent.'% Complete (success)</span>
				</div>
			</div>
			<h2><i class="fa fa-refresh fa-spin"></i> Loading</h2>
			'."
		</center>
		";
		return $html;
	}