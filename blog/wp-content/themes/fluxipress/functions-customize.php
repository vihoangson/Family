<?php

/**
 * Get theme defaults by type.
 * @param $key  string      The value identifier.
 *
 * @return mixed            The default value.
 */
function fluxipress_get_defaults($key)
{
	$defaults = array(
		'background_color'      => '#f0f0f0',
		'postbox_color'         => '#ffffff',
		'text_color'            => '#333333',
		'text_hover_color'      => '#ffffff',
		'highlight_color'       => '#ff0099',
		'more_link_text'        => 'more&hellip;',
	);
	
	return $defaults[$key];
}

/**
 * Sanitize input that requires a boolean value.
 * @param $value
 *
 * @return bool
 */
function fluxipress_sanitize_boolean($value)
{
	if(!is_bool($value))
	{
		$value = false;
	}

	return $value;
}

/**
 * Sanitize input that requires a hex color value.
 * @param $value
 *
 * @return string
 */
function fluxipress_sanitize_hex_color($value)
{
	if(preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $value))
	{
		return $value;
	}
	
	return '#ff0000';
}

/**
 * Sanitize input that requires a string value. Can be empty.
 * @param $value
 *
 * @return string
 */
function fluxipress_sanitize_string($value)
{
	if(!is_string($value))
	{
		$value = '';
	}
	
	return strip_tags($value);
}


/**
 * Setup theme customization.
 * @param $wp_customize
 */
function fluxipress_customize_register( $wp_customize )
{
	// color options section
	$wp_customize->add_section(
		'fluxipress_color_options',
		array(
			'title'		=> __('Color Options', 'fluxipress'),
			'priority'	=> 31,
		)
	);

	// background color
	$wp_customize->add_setting(
		'fluxipress_background_color',
		array(
			'default'	        => fluxipress_get_defaults('background_color'),
			'transport'	        => 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_background_color',
			array(
				'label'		=> __('Background Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_background_color',
			)
		)
	);

	// post box color
	$wp_customize->add_setting(
		'fluxipress_postbox_color',
		array(
			'default'           => fluxipress_get_defaults('postbox_color'),
			'transport'	        => 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_postbox_color',
			array(
				'label'		=> __('Post Box Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_postbox_color',
			)
		)
	);

	// text color
	$wp_customize->add_setting(
		'fluxipress_text_color',
		array(
			'default'           => fluxipress_get_defaults('text_color'),
			'transport'         => 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_text_color',
			array(
				'label'		=> __('Text Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_text_color',
			)
		)
	);

	// text hover color
	$wp_customize->add_setting(
		'fluxipress_text_hover_color',
		array(
			'default'           => fluxipress_get_defaults('text_hover_color'),
			'transport'	        => 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_text_hover_color',
			array(
				'label'		=> __('Text Color (Hover)', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_text_hover_color',
			)
		)
	);

	// highlight color
	$wp_customize->add_setting(
		'fluxipress_highlight_color',
		array(
			'default'           => fluxipress_get_defaults('highlight_color'),
			'transport'         => 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'fluxipress_highlight_color',
			array(
				'label'		=> __('Highlight Color', 'fluxipress'),
				'section'	=> 'fluxipress_color_options',
				'settings'	=> 'fluxipress_highlight_color',
			)
		)
	);


	// category options section
	$wp_customize->add_section(
		'fluxipress_category_options',
		array(
			'title'		=> __('Category Options', 'fluxipress'),
			'priority'	=> 32,
		)
	);

	// infinite scroll
	$wp_customize->add_setting(
		'fluxipress_infinite_scroll',
		array(
			'default'	=> false,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'fluxipress_infinite_scroll',
		array(
			'label' => __('Enable Infinite Scrolling', 'fluxipress'),
			'section' => 'fluxipress_category_options',
			'settings' => 'fluxipress_infinite_scroll',
			'type' => 'checkbox',
		)
	);

	// display excerpts
	$wp_customize->add_setting(
		'fluxipress_display_excerpts',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'fluxipress_display_excerpts',
		array(
			'label' => __('Display Excerpts', 'fluxipress'),
			'section' => 'fluxipress_category_options',
			'settings' => 'fluxipress_display_excerpts',
			'type' => 'checkbox',
		)
	);

	// display more link
	$wp_customize->add_setting(
		'fluxipress_display_more',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'fluxipress_display_more',
		array(
			'label' => __('Display More Link', 'fluxipress'),
			'section' => 'fluxipress_category_options',
			'settings' => 'fluxipress_display_more',
			'type' => 'checkbox',
		)
	);

	// more link text
	$wp_customize->add_setting(
		'fluxipress_more_link',
		array(
			'default'           => fluxipress_get_defaults('more_link_text'),
			'sanitize_callback' => 'fluxipress_sanitize_string',
		)
	);

	$wp_customize->add_control(
		'fluxipress_more_link',
		array(
			'label' => 'Post Box Link Text',
			'section' => 'fluxipress_category_options',
			'type' => 'text',
		)
	);


	// post options section
	$wp_customize->add_section(
		'fluxipress_post_options',
		array(
			'title'		=> __('Post Options', 'fluxipress'),
			'priority'	=> 33,
		)
	);

	// display tags
	$wp_customize->add_setting(
		'fluxipress_display_tags',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'fluxipress_display_tags',
		array(
			'label' => __('Display Tags', 'fluxipress'),
			'section' => 'fluxipress_post_options',
			'settings' => 'fluxipress_display_tags',
			'type' => 'checkbox',
		)
	);

	// display footer widgets
	$wp_customize->add_setting(
		'fluxipress_display_footer',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'fluxipress_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'fluxipress_display_footer',
		array(
			'label' => __('Display Footer Widgets on Single Post Pages', 'fluxipress'),
			'section' => 'fluxipress_post_options',
			'settings' => 'fluxipress_display_footer',
			'type' => 'checkbox',
		)
	);

}
add_action('customize_register', 'fluxipress_customize_register');

?>