		<div id="post-list" class="clear">
			<div id="col1" class="col"></div>
			<div id="col2" class="col"></div>
			<div id="col3" class="col"></div>
			<div id="col4" class="col"></div>
<?php
		$i = 0;
		while(have_posts()) :
			the_post();
			$displayExcerpt = (bool) get_theme_mod('fluxipress_display_excerpts', true);
			$displayMoreLink = (bool) get_theme_mod('fluxipress_display_more', true);
			
			$classes = array();
			if(!$displayExcerpt) $classes[] = 'no-excerpt';
			if(!$displayMoreLink) $classes[] = 'no-more';
?>
			<div id="post-<?php echo $i++; ?>" <?php post_class(implode(' ', $classes)); ?> title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>">
				<?php if(is_sticky()) : ?><span class="sticky-icon"></span><?php endif; ?>
				<?php if(!$displayMoreLink) : ?><a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>" class="no-more"><?php endif; ?>
				<?php the_post_thumbnail('medium', array('class' => 'post-thumb', 'alt' => htmlspecialchars(strip_tags(get_the_title())))); ?>
				<h2><?php the_title(); ?></h2>
				<?php if($displayExcerpt) : ?><span><?php echo strip_tags(get_the_excerpt(), '<strong><em>'); ?></span><?php endif; ?>
				<?php if($displayMoreLink) : ?><span class="tr"><a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars(strip_tags(get_the_title())); ?>"><?php echo get_theme_mod('fluxipress_more_link', __('more&hellip;', 'fluxipress')); ?></a></span><?php endif; ?>
				<?php if(!$displayMoreLink) : ?></a><?php endif; ?>
			</div>
<?php
		endwhile;
?>
		</div>
		
		<?php if((bool) get_theme_mod('fluxipress_infinite_scroll', false)) : ?>
		<div id="loading-icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="64" height="64" fill="<?php echo htmlspecialchars(get_theme_mod('fluxipress_highlight_color', '#ff0099')); ?>">
				<circle cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(45 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.125s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(90 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.25s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(135 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.375s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(180 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(225 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.625s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(270 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.75s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(315 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.875s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
				<circle transform="rotate(180 16 16)" cx="16" cy="3" r="0"><animate attributeName="r" values="0;3;0;0" dur="1s" repeatCount="indefinite" begin="0.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" calcMode="spline"/></circle>
			</svg>
		</div>
		<?php endif; ?>

		<?php
			global $posts_per_page, $wp_query;
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			if($wp_query->found_posts > $posts_per_page || $paged > 1) :
		?>
		<div id="post-navi">
			<div class="prev"><?php next_posts_link(__('&laquo;&nbsp;Older posts', 'fluxipress')); ?></div>
			<div class="next"><?php previous_posts_link(__('Newer posts&nbsp;&raquo;', 'fluxipress')); ?></div>
		</div>
		<?php endif; ?>