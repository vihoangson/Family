<?php

//require_once (FCPATH."application/libraries/dBug.php");

if ( ! function_exists( 'd' ) ) {
  // dBug wrapper ( see:http://dbug.ospinto.com)
  function d( $data )
  {
  	//コマンドラインからの実行の場合
  	if(!isset($_SERVER["REMOTE_ADDR"])){
  		print_r($data);
  	}else{
	    ob_start();
	    new dBug($data);
	    $output = ob_get_contents(); 
	    ob_end_clean();
	    echo $output;
  	}
  }
}

if ( ! function_exists( 'dd' ) ) {
	// dBug wrapper ( see:http://dbug.ospinto.com)
	function dd( $data )
	{
		d($data);
		exit();
	}
}
