<?php 
// https://www.google.com/search?q=".$_GET["w"]."&es_sm=122&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAWoVChMIgNmD7KKMyQIVweOmCh1CKwHX&biw=1851&bih=952#q=".$_GET["w"]."&tbm=isch&tbs=itp:clipart&imgrc=dSVdnddBAfH_CM%3A
// https://www.google.com/search?q=".$_GET["w"]."&es_sm=122&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAWoVChMIgNmD7KKMyQIVweOmCh1CKwHX&biw=1851&bih=952#q=".$_GET["w"]."&tbm=isch&tbs=itp:clipart
// echo "https://www.google.com/search?q=".$_GET["w"]."&es_sm=122&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAWoVChMIgNmD7KKMyQIVweOmCh1CKwHX&biw=1851&bih=952#q=".$_GET["w"]."&tbm=isch&tbs=itp:clipart&imgrc=dSVdnddBAfH_CM%3A";
//preg_match_all("/[\"\']((http:\/\/|https:\/\/).+?)[\"\']/",$string,$return );

$string = file_get_contents("https://www.google.com/search?q=".$_GET["w"]."&es_sm=122&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAWoVChMIgNmD7KKMyQIVweOmCh1CKwHX&biw=1851&bih=952#q=".$_GET["w"]."&tbm=isch&tbs=itp:clipart&imgrc=dSVdnddBAfH_CM%3A");
preg_match_all("/[\"\']((https\:\/\/encrypted-tbn).+?)[\"\']/",$string,$return );
foreach($return[1] as $key => $value){
	downloadFile ($value, "images/".($_GET["n"]?$_GET["n"]:$_GET["w"])."_".$key.".jpg");
}
foreach($arr as $key =>$value){
	if($i>50){
		downloadFile("http://soundoftext.com/static/sounds/en/".strtolower($key).".mp3",APPPATH."../asset/".strtolower($key).".mp3");
	}
	$i++;
}
function downloadFile ($url, $path) {

	$newfname = $path;
	$file = fopen ($url, "rb");
	if ($file) {
		$newf = fopen ($newfname, "wb");

		if ($newf)
		while(!feof($file)) {
			fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
		}
	}

	if ($file) {
		fclose($file);
	}

	if ($newf) {
		fclose($newf);
	}
 }

 ?>
