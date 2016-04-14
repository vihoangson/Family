<?php $this->load->view('_includes/header',[]); ?>
<div class="container">
	<div class="row">
		<div class='col-md-offset-2 col-md-8 text-center'>
			<h2>Friends</h2>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-offset-2 col-md-8'>
			<div class="carousel slide" data-ride="carousel" id="quote-carousel">
				<!-- Bottom Carousel Indicators -->
				<ol class="carousel-indicators">
					<?php
					$i=0;
					foreach ($data as $key => $value) {
						?><li data-target="#quote-carousel" data-slide-to="<?= $i; ?>" class=" <?= ($i==0?"active":""); ?>"></li><?php
						$i++;
					} ?>
				</ol>
				<div class="carousel-inner">
					<?php
					$i=0;
					foreach ($data as $key => $value) {
						?>
						<div class="item <?= ($i==0?"active":""); ?>">
							<blockquote>
								<div class="row">
									<div class="col-sm-3 text-center">
										<img onError="this.src='http://placehold.it/200x200'" class="img-circle" src="<?= $value["img"]; ?>" style="width: 100px;height:100px;">
									</div>
									<div class="col-sm-9">
										<p><?= $value["quote"]; ?></p>
										<small><?= $key; ?></small>
									</div>
								</div>
							</blockquote>
						</div>
						<?php
						$i++;
					} ?>
				</div>

				<!-- Carousel Buttons Next/Prev -->
				<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
				<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
			</div>
		</div>
	</div>
</div>

<style>
	/* carousel */
	#quote-carousel 
	{
		padding: 0 10px 30px 10px;
		margin-top: 30px;
	}

	/* Control buttons  */
	#quote-carousel .carousel-control
	{
		background: none;
		color: #222;
		font-size: 2.3em;
		text-shadow: none;
		margin-top: 30px;
	}
	/* Previous button  */
	#quote-carousel .carousel-control.left 
	{
		left: -12px;
	}
	/* Next button  */
	#quote-carousel .carousel-control.right 
	{
		right: -12px !important;
	}
	/* Changes the position of the indicators */
	#quote-carousel .carousel-indicators 
	{
		right: 50%;
		top: auto;
		bottom: 0px;
		margin-right: -19px;
	}
	/* Changes the color of the indicators */
	#quote-carousel .carousel-indicators li 
	{
		background: #c0c0c0;
	}
	#quote-carousel .carousel-indicators .active 
	{
		background: #333333;
	}
	#quote-carousel img
	{
		width: 250px;
		height: 100px
	}
	/* End carousel */

	.item blockquote {
		border-left: none; 
		margin: 0;
	}

	.item blockquote img {
		margin-bottom: 10px;
	}

	.item blockquote p:before {
		content: "\f10d";
		font-family: 'Fontawesome';
		float: left;
		margin-right: 10px;
	}



/**
  MEDIA QUERIES
  */

  /* Small devices (tablets, 768px and up) */
  @media (min-width: 768px) { 
  	#quote-carousel 
  	{
  		margin-bottom: 0;
  		padding: 0 40px 30px 40px;
  	}

  }

  /* Small devices (tablets, up to 768px) */
  @media (max-width: 768px) { 

  	/* Make the indicators larger for easier clicking with fingers/thumb on mobile */

  	#quote-carousel .carousel-indicators {
  		bottom: -20px !important;  
  	}
  	#quote-carousel .carousel-indicators li {
  		display: inline-block;
  		margin: 0px 5px;
  		width: 15px;
  		height: 15px;
  	}
  	#quote-carousel .carousel-indicators li.active {
  		margin: 0px 5px;
  		width: 20px;
  		height: 20px;
  	}
  }
</style>

<script>
  //Set the carousel options
  $('#quote-carousel').carousel({
  	pause: true,
  	interval: 10000,
  });
</script>

<?php $this->load->view('_includes/footer'); ?>