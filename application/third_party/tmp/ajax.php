<?php
	require "data.php";		

	if(remove_special_character($array[$_POST["text"]])== remove_special_character($_POST["type"])){
		echo 1;
	}else{
		echo "<h2>".$_POST["text"]."</h2>";
    echo "<h2 class='vietnamese' style='display:none;'>".$array[$_POST["text"]]."</h2>";
    echo "<div class='img_box'>";
    for($i=0;$i<19;$i++){
      echo "<div class='img_ele'><img src='images/".$_POST["text"]."_".$i.".jpg'/></div>";
    }
    echo "</div>
    ";
	}
?>
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
<?php
 function remove_special_character($str)
 {
  $coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
   "ằ","ắ","ặ","ẳ","ẵ",
   "è","é","ẹ","ẻ","ẽ","ê","ề"     ,"ế","ệ","ể","ễ",
   "ì","í","ị","ỉ","ĩ",
   "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
   ,"ờ","ớ","ợ","ở","ỡ",
   "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
   "ỳ","ý","ỵ","ỷ","ỹ",
   "đ",
   "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
   ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
   "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
   "Ì","Í","Ị","Ỉ","Ĩ",
   "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
   ,"Ờ","Ớ","Ợ","Ở","Ỡ",
   "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
   "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
   "Đ","ê","ù","à");

  $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
   ,"a","a","a","a","a","a",
   "e","e","e","e","e","e","e","e","e","e","e",
   "i","i","i","i","i",
   "o","o","o","o","o","o","o","o","o","o","o","o"
   ,"o","o","o","o","o",
   "u","u","u","u","u","u","u","u","u","u","u",
   "y","y","y","y","y",
   "d",
   "A","A","A","A","A","A","A","A","A","A","A","A"
   ,"A","A","A","A","A",
   "E","E","E","E","E","E","E","E","E","E","E",
   "I","I","I","I","I",
   "O","O","O","O","O","O","O","O","O","O","O","O"
   ,"O","O","O","O","O",
   "U","U","U","U","U","U","U","U","U","U","U",
   "Y","Y","Y","Y","Y",
   "D","e","u","a");
  $return = str_replace($coDau,$khongDau,$str);
  $return = strtolower(str_replace(" ","",$return));
  //$return = preg_replace('/[^a-zA-Z0-9\s-]/', '', $return);
  return $return;
 }
 ?>
