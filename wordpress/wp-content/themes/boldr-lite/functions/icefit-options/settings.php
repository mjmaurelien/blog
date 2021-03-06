<?php
/**
 *
 * BoldR Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Admin settings template
 *
 */

// Load the icefit options framework
include_once('icefit-options.php');

// Set setting panel name and slug
$boldr_settings_name = "BoldR Lite Settings";
$boldr_settings_slug = "boldr_settings";

// Set settings template
function boldr_settings_template() {

	$settings_options = array();

// START PAGE 0

	$settings_options[] = array(
		'name'          => 'Go Pro',
		'type'          => 'start_menu',
		'id'            => 'gopro_page',
		'icon'          => 'down',
	);

		$settings_options[] = array(
			'name'          => 'Upgrade to BoldR Pro!',
			'desc'          => '',
			'id'            => 'gopro',
			'type'          => 'gopro',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu');

// END PAGE 0


// START PAGE 1
	$settings_options[] = array(
		'name'          => 'Main settings',
		'type'          => 'start_menu',
		'id'            => 'main',
		'icon'          => 'control',
	);

		$settings_options[] = array(
			'name'          => 'Logo',
			'desc'          => 'Upload your own logo',
			'id'            => 'logo',
			'type'          => 'image',
			'default'       => get_template_directory_uri() .'/img/logo.png',
		);

		$settings_options[] = array(
			'name'          => 'Favicon',
			'desc'          => 'Set your favicon. 16x16 or 32x32 pixels, either 8-bit or 24-bit colors. PNG (W3C standard), GIF, or ICO.',
			'id'            => 'favicon',
			'type'          => 'image',
			'default'       => '',
		);

	$settings_options[] = array('type' => 'end_menu');
// END PAGE 1
// START PAGE 2
	$settings_options[] = array(
		'name'          => 'Custom Header',
		'type'          => 'start_menu',
		'id'            => 'custom_header',
		'icon'          => 'picture',
	);

		$settings_options[] = array(
			'name'          => 'Display custom header on Homepage',
			'desc'          => 'Enable or disable display of custom header image on the front page.',
			'id'            => 'home_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array ('On', 'Off'),			
		);

		$settings_options[] = array(
			'name'          => 'Display custom header on Blog Index',
			'desc'          => 'Enable or disable display of custom header image on blog index pages.',
			'id'            => 'blog_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array ('On', 'Off'),			
		);

		$settings_options[] = array(
			'name'          => 'Display custom header on Blog Posts',
			'desc'          => 'Enable or disable display of custom header image on single blog posts',
			'id'            => 'single_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array ('On', 'Off'),			
		);

		$settings_options[] = array(
			'name'          => 'Display custom header on Pages',
			'desc'          => 'Enable or disable display of custom header image on individual pages.',
			'id'            => 'pages_header_image',
			'type'          => 'radio',
			'default'       => 'On',
			'values'		=> array ('On', 'Off'),			
		);


	$settings_options[] = array('type' => 'end_menu');
// END PAGE 2
	return $settings_options;
}
?>