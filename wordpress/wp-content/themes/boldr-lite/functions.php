<?php
/**
 *
 * BoldR Lite WordPress Theme by Iceable Themes | http://www.iceablethemes.com
 *
 * Copyright 2013 Mathieu Sarrasin - Iceable Media
 *
 * Theme's Function
 *
 */

/*
 * Set default $content_width
 */
if ( ! isset( $content_width ) )
	$content_width = 590;

/* Adjust $content_width it depending on the page being displayed */
function boldr_content_width() {
	global $content_width;
	if ( is_singular() && !is_page() )
		$content_width = 595;
	if ( is_page() )
		$content_width = 680;
	if ( is_page_template( 'page-full-width.php' ) )
		$content_width = 920;
}
add_action( 'template_redirect', 'boldr_content_width' );

/*
 * Setup and registration functions
 */
function boldr_setup(){
	/* Translation support
	 * Translations can be added to the /languages directory.
	 * A .pot template file is included to get you started
	 */
	load_theme_textdomain('boldr', get_template_directory() . '/languages');

	/* Feed links support */
	add_theme_support( 'automatic-feed-links' );

	/* Register menus */
	register_nav_menu( 'primary', 'Navigation menu' );
	register_nav_menu( 'footer-menu', 'Footer menu' );

	/* Post Thumbnails Support */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 260, 260, true );

	/* Custom header support */
	add_theme_support( 'custom-header',
						array(	'header-text' => false,
								'width' => 920,
								'height' => 370,
								'flex-height' => true,
								)
					);

	/* Custom background support */
	add_theme_support( 'custom-background',
						array(	'default-color' => '333333',
								'default-image' => get_template_directory_uri() . '/img/black-leather.png',
								)
					);

}
add_action('after_setup_theme', 'boldr_setup');

/*
 * Page title
 */
function boldr_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'boldr' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'boldr_wp_title', 10, 2 );

/*
 * Add a home link to wp_page_menu() ( wp_nav_menu() fallback )
 */
function boldr_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'boldr_page_menu_args' );

/*
 * Add parent Class to parent menu items
 */
function boldr_add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	return $items;    
}
add_filter( 'wp_nav_menu_objects', 'boldr_add_menu_parent_class' );


/*
 * Register Sidebar and Footer widgetized areas
 */
function boldr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Default Sidebar', 'boldr' ),
		'id'            => 'sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
	
	register_sidebar( array(
		'name'          => __( 'Footer', 'boldr' ),
		'id'            => 'footer-sidebar',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<li id="%1$s" class="one-fourth widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'boldr_widgets_init' );


/*
 * Enqueue CSS styles
 */
function boldr_styles() {
	wp_register_style( 'boldr',          get_template_directory_uri() . '/css/icefit.css');
	wp_register_style( 'theme-style',    get_template_directory_uri() . '/css/theme-style.css');
	wp_register_style( 'dynamic-styles', site_url() . '/index.php?dynamiccss=1');
	wp_enqueue_style( 'boldr' );
	wp_enqueue_style( 'theme-style' );
	wp_enqueue_style( 'dynamic-styles' );
	wp_enqueue_style( 'google-webfonts', 'http://fonts.googleapis.com/css?family=Oswald:400italic,700italic,400,700', array(), null );
}
add_action('wp_print_styles', 'boldr_styles');


/*
 * Enqueue Javascripts
 */
function boldr_scripts() {
	wp_enqueue_script('icefit-scripts', get_template_directory_uri() . '/js/icefit.js', array('jquery'));
	wp_enqueue_script('hoverIntent',    get_template_directory_uri() . '/js/hoverIntent.js', array('jquery'));
	wp_enqueue_script('superfish',      get_template_directory_uri() . '/js/superfish.js', array('jquery'));
    /* Threaded comments support */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action('wp_enqueue_scripts', 'boldr_scripts');


/*
 * Remove "rel" tags in category links (HTML5 invalid)
 */
function boldr_remove_rel_cat( $text ) {
	$text = str_replace(' rel="category"', "", $text); return $text;
}
add_filter( 'the_category', 'boldr_remove_rel_cat' );

/*
 * Fix for a known issue with enclosing shortcodes and wpautop
 * (wpautop tends to add empty <p> or <br> tags before and/or after enclosing shortcodes)
 * Thanks to Johann Heyne
 */
function boldr_shortcode_empty_paragraph_fix($content) {
	$array = array (
		'<p>['    => '[', 
		']</p>'   => ']', 
		']<br />' => ']',
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'boldr_shortcode_empty_paragraph_fix');

/*
 * Improved version of clean_pre
 * Based on a work by Emrah Gunduz
 */
function boldr_protect_pre($pee) {
	$pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'boldr_eg_clean_pre', $pee );
	return $pee;
}

function boldr_eg_clean_pre($matches) {
	if ( is_array($matches) )
		$text = $matches[1] . $matches[2] . "</pre>";
	else
		$text = $matches;
	$text = str_replace('<br />', '', $text);
	return $text;
}
add_filter( 'the_content', 'boldr_protect_pre' );

/*
 * Customize "read more" links on index view
 */
function boldr_excerpt_more( $more ) {
	global $post;
	return '<div class="read-more"><a href="'. get_permalink( get_the_ID() ) . '">'. __("Read More", 'boldr') .'</a></div>';
}
add_filter( 'excerpt_more', 'boldr_excerpt_more' );

/*
 * Rewrite and replace wp_trim_excerpt() so it adds a relevant read more link
 * when the <!--more--> or <!--nextpage--> quicktags are used
 * This new function preserves every features and filters from the original wp_trim_excerpt
 */
function boldr_trim_excerpt($text = '') {
	global $post;
	$raw_excerpt = $text;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$excerpt_length = apply_filters('excerpt_length', 55);
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

		/* If the post_content contains a <!--more--> OR a <!--nextpage--> quicktag
		 * AND the more link has not been added already
		 * then we add it now
		 */
		if ( ( preg_match('/<!--more(.*?)?-->/', $post->post_content ) || preg_match('/<!--nextpage-->/', $post->post_content ) ) && strpos($text,$excerpt_more) === false ) {
		 $text .= $excerpt_more;
		}
		
	}
	return apply_filters('boldr_trim_excerpt', $text, $raw_excerpt);
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
add_filter( 'get_the_excerpt', 'boldr_trim_excerpt' );

/*
 * Create dropdown menu (used in responsive mode)
 * Requires a custom menu to be set (won't work with fallback menu)
 */
function boldr_dropdown_nav_menu () {
	$menu_name = 'primary';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		if ($menu = wp_get_nav_menu_object( $locations[ $menu_name ] ) ) {
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<select id="dropdown-menu">';
		$menu_list .= '<option value="">Menu</option>';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			if($url != "#" ) $menu_list .= '<option value="' . $url . '">' . $title . '</option>';
		}
		$menu_list .= '</select>';
   		// $menu_list now ready to output
   		echo $menu_list;    
		}
    } 
}

/*
 * Find whether post page needs comments pagination links (used in comments.php)
 */
function boldr_page_has_comments_nav() {
	global $wp_query;
	return ($wp_query->max_num_comment_pages > 1);
}

function boldr_page_has_next_comments_link() {
	global $wp_query;
	$max_cpage = $wp_query->max_num_comment_pages;
	$cpage = get_query_var( 'cpage' );	
	return ( $max_cpage > $cpage );
}

function boldr_page_has_previous_comments_link() {
	$cpage = get_query_var( 'cpage' );	
	return ($cpage > 1);
}

/*
 * Find whether attachement page needs navigation links (used in single.php)
 */
function boldr_adjacent_image_link($prev = true) {
    global $post;
    $post = get_post($post);
    $attachments = array_values(get_children("post_parent=$post->post_parent&post_type=attachment&post_mime_type=image&orderby=\"menu_order ASC, ID ASC\""));

    foreach ( $attachments as $k => $attachment )
        if ( $attachment->ID == $post->ID )
            break;

    $k = $prev ? $k - 1 : $k + 1;

    if ( isset($attachments[$k]) )
        return true;
	else
		return false;
}

/*
 * Framework Elements
 */
include_once('functions/icefit-options/settings.php'); // Admin Settings Panel

?>