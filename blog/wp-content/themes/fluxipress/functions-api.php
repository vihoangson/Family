<?php

/*
 * Register query vars. 
 */

function fluxipress_add_query_vars_filter($vars)
{
	$vars[] = 'fluxipress_style_options';
	$vars[] = 'fluxipress_load_posts';
	$vars[] = 'fluxipress_load_posts_num';
	$vars[] = 'fluxipress_load_posts_page';
	return $vars;
}
add_filter('query_vars', 'fluxipress_add_query_vars_filter');


/*
 * Load theme options and parse CSS. 
 */

function fluxipress_parse_style_options()
{
	if((int) get_query_var('fluxipress_style_options') === 1)
	{
		header('Content-type: text/css; charset: UTF-8');
		
		// cache control by chris coyier
		// http://css-tricks.com/snippets/php/intelligent-php-cache-control/
		$lastModified = filemtime(__FILE__);
		$etagFile = md5_file(__FILE__);
		$ifModifiedSince = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
		$etagHeader = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false;

		header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
		header('Etag: "' . $etagFile . '"');
		header('Cache-Control: public');

		if(@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $lastModified || $etagHeader == $etagFile)
		{
			header('HTTP/1.1 304 Not Modified');
			exit;
		}

		$bgColor = get_theme_mod('fluxipress_background_color', '#f0f0f0');
		$textColor = get_theme_mod('fluxipress_text_color', '#333333');
		$textHoverColor = get_theme_mod('fluxipress_text_hover_color', '#ffffff');
		$postBgColor = get_theme_mod('fluxipress_postbox_color', '#ffffff');
		$highlightColor = get_theme_mod('fluxipress_highlight_color', '#ff0099');
		$thumbnailWidth = (int) get_option('thumbnail_size_w');
		$thumbnailHeight = (int) get_option('thumbnail_size_h');

		$hex = $textColor;
		if($hex{0} === '#') $hex = substr($hex, 1);

		if(strlen($hex) == 6)
		{
			list($r, $g, $b) = array($hex{0} . $hex{1}, $hex{2} . $hex{3}, $hex{4} . $hex{5});
		}
		elseif(strlen($hex) == 3)
		{
			list($r, $g, $b) = array($hex{0} . $hex{0}, $hex{1} . $hex{1}, $hex{2} . $hex{2});
		}
		else
		{
			return array();
		}

		$r = hexdec($r);
		$g = hexdec($g);
		$b = hexdec($b);
		$textColorRGB = array('r' => $r, 'g' => $g, 'b' => $b);

		?>
		@charset "UTF-8";

		body, .mfp-bg, #menu .menu > ul > li > .children, #menu .menu > li > .sub-menu { background: <?php echo $bgColor; ?>; }
		body, #blog-title a, #menu .menu a, #post-list .post .no-more, .comment-author a, .comment-meta a, .ti, .ta, .form .hint, .themeinfo, .mfp-title, .mfp-counter, .mfp-close-btn-in .mfp-close, #page.open #menu .menu .current_page_ancestor > a { color: <?php echo $textColor; ?>; }
		a, #blog-title a:hover, #menu .menu a:hover, #menu .menu .current-menu-item > a, #menu .menu .current_page_item > a, #menu .menu .current_page_ancestor > a, .bypostauthor .comment-author a, .bypostauthor .comment-author cite, #post-navi div, #post blockquote:before, #post blockquote:after, .form .req label span { color: <?php echo $highlightColor; ?>; }
		#header .inner { border-bottom: 1px solid <?php echo $textColor; ?>; }
		#menu .menu > ul > li > .children, #menu .menu > li > .sub-menu { border-top: 1px solid <?php echo $highlightColor; ?>; }
		.gt-800 #blog-title a:after { content: "<?php _e('Home', 'fluxipress'); ?>"; }
		#post-navi { border-top: 1px solid <?php echo $textColor; ?>; }
		#sidebar-footer { border-top: 1px solid <?php echo $textColor; ?>; }
		.mfp-title, .mfp-counter { text-shadow: 1px 1px 0 <?php echo $bgColor; ?>; }
		.mfp-arrow-left:after, .mfp-arrow-left .mfp-a { border-right-color: <?php echo $bgColor; ?>; }
		.mfp-arrow-left:before, .mfp-arrow-left .mfp-b { border-right-color: <?php echo $textColor; ?>; }
		.mfp-arrow-right:after, .mfp-arrow-right .mfp-a { border-left-color: <?php echo $bgColor; ?>; }
		.mfp-arrow-right:before, .mfp-arrow-right .mfp-b { border-left-color: <?php echo $textColor; ?>; }
		.post { background: <?php echo $postBgColor; ?>; }
		#post-list .post:hover { background: <?php echo $highlightColor; ?>; }
		#post-list .sticky-icon { border-color: transparent <?php echo $highlightColor; ?> transparent transparent; }
		#post-list .post:hover, #post-list .post:hover a { color: <?php echo $textHoverColor; ?>; }
		#post .gallery .gallery-item {
			width: <?php echo $thumbnailWidth . 'px'; ?>;
			height: <?php echo $thumbnailHeight . 'px'; ?>;
		}
		#comments { border-top: 1px solid rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); }
		.comment, #sidebar-single .widget, #footer .widget { border-bottom: 1px solid rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); }
		#page.open { box-shadow: 10px 0 20px 0 rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); }
		@media only screen and (max-width: 800px) {
			#menu { background: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .2); }
			#sidebar-single { border-top: 1px solid <?php echo $textColor; ?>; }
		}
		#mobile-menu { background: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .1); }
		#mobile-menu:before { border-color: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .7); }
		#mobile-menu:hover { background: <?php echo $highlightColor; ?>; }
		#mobile-menu:hover:before { border-color: <?php echo $textHoverColor; ?>; }
		<?php
		exit;
	}
}
add_action('template_redirect', 'fluxipress_parse_style_options');


/*
 * Load posts and return them as JSON object. 
 */

function fluxipress_load_posts_as_json()
{
	if((int) get_query_var('fluxipress_load_posts') === 1)
	{
		$numPosts = (int) get_query_var('fluxipress_load_posts_num');
		$page = (int) get_query_var('fluxipress_load_posts_page');

		query_posts(array(
			'posts_per_page' => $numPosts,
			'paged'          => $page
		));

		if(have_posts())
		{
			$i = ($page - 1) * $numPosts;
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
		}
		wp_reset_query();

		exit;
	}
}
add_action('template_redirect', 'fluxipress_load_posts_as_json');


?>