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
<h1>Ý tưởng làm cuộc sống vui vẻ và thú vị hơn</h1>
<p><a class="btn btn-primary" href="/idear/edit">Add new idear</a></p>
<div class="row">
<?php foreach ($rs as $key => $value) {
	echo "<div class='col-md-3'>";
	if($value->idear_img){
		$img = json_decode($value->idear_img,true);
		$file_name = basename($img[0]);
		echo "
		<a href='/idear/detail/".$value->id."' class='thumbnail equalize ele_idear'>
			<img src='/asset/images/idear/thumb/".$file_name."' onError='this.src=\"http://placehold.it/100x100\"'>
		</a>
		<h3>".$value->idear_title."</h3>
		";
	}
	echo "</div>";
} ?>
</div>
<script>
	$(window).load(function(){
	    var maxHeight = 0;
	    $(".equalize").each(function(){
	      if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
	    });
	    $(".equalize").height(maxHeight);
	});
</script>
<?php $this->load->view('_includes/footer');
?>