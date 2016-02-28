<?php
$data_header = [
	"breadcrumb"=>[
		"Idear"=>"",
	],
	"custom_html"=> '',
];
$this->load->view('_includes/header',$data_header); ?>
<style>
	.equalize{
		overflow: hidden;
		max-height:400px;
	}

</style>
<?php
if($this->session->flashdata('alert')){
	echo '
<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	'.$this->session->flashdata('alert').'
</div>
	';
	
}
 ?>
<p><a class="btn btn-primary" href="idear/edit">Add new idear</a></p>
<div class="row">
	
<?php foreach ($rs as $key => $value) {
	echo "<div class='col-md-3'>";
	if($value->idear_img){
		$img = json_decode($value->idear_img);
		echo "<a href='javasript:void()' class='thumbnail equalize'><img src='/asset/images/idear/".$img[0]."'></a>";
	}
	echo $value_img->idear_content."<br>";
	echo "</div>";
} ?>
</div>
<script>
  $(document).ready(function() {
    var maxHeight = 0;          
    $(".equalize").each(function(){
      if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
    });         
    $(".equalize").height(maxHeight);
  }); 
</script>
<?php $this->load->view('_includes/footer');
?>