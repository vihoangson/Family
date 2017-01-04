<?php
	get_header();
	
	if(have_posts()) :
?>
		<div id="post">
			<div class="post-content post-list-content">
				<h1><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'fluxipress' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'fluxipress' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'fluxipress' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'fluxipress' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'fluxipress' ) ) . '</span>' );
					else :
						_e( 'Archives', 'fluxipress' );
					endif;
				?></h1>
			</div>
		</div>
		
<?php
		get_template_part('content', 'postlist');

	else :
	
		get_template_part('content', 'none');
	
	endif;
	
	get_footer();
?>
