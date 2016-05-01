<?php

	define("PATH_AVATAR","/asset/images/");

	// ALLOW_SENT_MAIL
	// true: Được phép send mail
	// false: Không được phép send mail
	define("ALLOW_SENT_MAIL",true);

	// NEED_OLD_PASS
	// 1: Không cần oldpassword
	// 2: Cần oldpassword
	define("NEED_OLD_PASS",1);

	// $config["password_timeline"]
	// password vào time line
	$config["password_timeline"] = "susu";

	// Ngày dự sinh để đếm trong countdown
	// Format date YYYY-MM-DD
	// define("NGAYDUSINH","2016-08-30");// Xuân
	define("NGAYDUSINH","2016-05-20");

	define("MAX_SIZE_IMG",800);
?>