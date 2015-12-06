<?php 
function get_thumb_file_name($file_name){
	$file_name_new = preg_replace("/(\.)(\w{3,4})/", "_thumb.$2", $file_name);
	return $file_name_new;
}	
 ?>
