<?php


/**
* Registers the sidebar(s).
*/

function fluxipress_widgets_init()
{
	register_sidebar(
		array(
			'name'			=>	'Single Post',
			'id'			=>	'sidebar-single',
			'before_widget'	=>	'<div class="widget">',
			'after_widget'	=>	'</div>'
		)
	);

	register_sidebar(
		array(
			'name'			=>	'Footer',
			'id'			=>	'sidebar-footer',
			'before_widget'	=>	'<div class="widget">',
			'after_widget'	=>	'</div>'
		)
	);
}
add_action('widgets_init', 'fluxipress_widgets_init');


/**
* Primary menu setup.
*/

function fluxipress_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}
add_filter('wp_nav_menu_args', 'fluxipress_nav_menu_args');


/**
* Configure general theme settings and register styles & scripts.
*/

function fluxipress_theme_setup()
{
	if(!isset($content_width)) $content_width = 1140;
	
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');

	register_nav_menu('primary', 'Primary Menu');
}
add_action('after_setup_theme', 'fluxipress_theme_setup');


function fluxipress_add_stylesheets()
{
	wp_register_style(
		'fluxipress-css-options',
		home_url('/') . '?fluxipress_style_options=1'
	);
	wp_enqueue_style('fluxipress-css-options');
	
	wp_register_style(
		'fluxipress-css-magnific',
		get_template_directory_uri() . '/css/magnific-popup.css'
	);
	wp_enqueue_style('fluxipress-css-magnific');
	
	wp_register_style(
		'fluxipress-css-fonts',
		'//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300'
	);
	wp_enqueue_style('fluxipress-css-fonts');
}
add_action('wp_enqueue_scripts', 'fluxipress_add_stylesheets');


function fluxipress_add_scripts()
{
	if(is_admin()) return;
	
	wp_enqueue_script('jquery');
	
	wp_register_script(
		'fluxipress-js-magnific',
		get_template_directory_uri() . '/js/jquery.magnific-popup.min.js',
		array(),
		false,
		true
	);
	wp_enqueue_script('fluxipress-js-magnific');
	
	wp_register_script(
		'fluxipress-js-init',
		get_template_directory_uri() . '/js/init-1.0.7.js',
		array(),
		false,
		true
	);
	
	global $posts_per_page;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	$jsOptions = array(
		'homePath' => home_url('/'),
		'currentPage' => (int) $paged,
		'postsPerPage' => (int) $posts_per_page,
		'enableInfiniteScrolling' => ((bool) get_theme_mod('fluxipress_infinite_scroll', false)) ? 'true' : 'false'
	);
	wp_localize_script('fluxipress-js-init', 'fluxipressOptions', $jsOptions);
	wp_enqueue_script('fluxipress-js-init');
}
add_action('wp_enqueue_scripts', 'fluxipress_add_scripts', 11);


/*
 * Setup theme customization
 */
require_once('functions-customize.php');


function fluxipress_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'fluxipress_remove_recent_comments_style');


require_once('functions-api.php');

?>