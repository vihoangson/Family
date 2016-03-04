<?php
	if($_SERVER["HTTP_HOST"]=="family.vihoangson.com"){
		// family.vihoangson.com
		define("APP_ID","990882487654318");
		define("APP_SECRET","3bcd21ad4d38fd842fc205a875fd85c5");
	}elseif($_SERVER["HTTP_HOST"]=="family.vn"){
		// family.vn
		define("APP_ID","991382657604301");
		define("APP_SECRET","2d6d71abd8d083a79fe80713b8b76264");
	}
	$config['app_id'] = APP_ID;
	$config['app_secret'] = APP_SECRET;
?>