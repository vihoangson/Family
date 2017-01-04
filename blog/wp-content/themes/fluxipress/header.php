<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />

<?php
if(!function_exists('_wp_render_title_tag'))
{
	function fluxipress_render_title()
	{
		?><title><?php wp_title('|', true, 'right'); ?></title><?php
	}
	add_action('wp_head', 'fluxipress_render_title');
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
<?php
if(is_singular()) wp_enqueue_script('comment-reply', false, array(), false, true);

wp_head();
?>
</head>

<body <?php body_class('lt-480' . (is_single() && is_active_sidebar('sidebar-single') ? ' has-single-sidebar' : '')); ?>>
<div id="page-wrap">
<div id="page">

	<a id="mobile-menu" href="#menu"></a>
	
	<div id="header">
		<div class="wrap">
			<div class="inner">
				<?php if(is_home()) : ?><h1 id="blog-title"><?php else : ?><strong id="blog-title"><?php endif; ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"><?php echo get_bloginfo('name'); ?></a>
				<?php if(is_home()) : ?></h1><?php else : ?></strong><?php endif; ?>
				<div id="menu">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false
					));
				?>
				</div>
			</div>
		</div>
	</div>

	<div id="main" class="wrap clear">