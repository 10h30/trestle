<?php

/**
 * Trestle theme functionality
 *  
 * @since  1.0.0
 * 
 * @package Trestle
 */

add_action( 'genesis_setup' ,'trestle_theme_setup', 15 );
function trestle_theme_setup() {

	/*===========================================
	 * Required Files
	===========================================*/
	
	// Trestle theme functions
	require_once dirname( __FILE__ ) . '/lib/functions/theme-functions.php';

	// Admin functionality
	require_once dirname( __FILE__ ) . '/lib/admin/admin.php';
	
	// Shortcodes
	require_once dirname( __FILE__ ) . '/lib/shortcodes/shortcodes.php';
	
	// Plugin activation class
	require_once dirname( __FILE__ ) . '/lib/classes/class-tgm-plugin-activation.php';


	/*===========================================
	 * Trestle Theme Setup
	===========================================*/

	// Child theme definitions (do not remove)
	define( 'CHILD_THEME_NAME', 'Trestle' );
	define( 'CHILD_THEME_URL', 'http://demo.mightyminnow.com/theme/trestle/' );
	define( 'CHILD_THEME_VERSION', '1.0.0' );

	// Load theme text domain
	load_theme_textdomain( 'trestle', get_stylesheet_directory() . '/languages' );

	// Add HTML5 markup structure
	add_theme_support( 'html5' );

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background
	add_theme_support( 'custom-background' );

	// Add support for footer widgets if specified in Trestle settings
	$trestle_footer_widgets_number = esc_attr( genesis_get_option( 'trestle_footer_widgets_number' ) );
	add_theme_support( 'genesis-footer-widgets', $trestle_footer_widgets_number );


	/*===========================================
	 * Header Styles & Scripts
	===========================================*/

	add_action( 'wp_enqueue_scripts', 'trestle_header_actions' );

	/*===========================================
	 * Widget Areas
	===========================================*/
	
	add_action( 'widgets_init', 'trestle_register_widget_areas' );

	/*===========================================
	 * Auto & Mobile Navigation
	===========================================*/	
	
	// Implement auto-nav and mobile nav button
	add_action( 'init', 'trestle_nav_modifications' );


	/*===========================================
	 * Posts & Pages
	===========================================*/

	// Setup revisions number
	add_filter( 'wp_revisions_to_keep', 'trestle_update_revisions_number', 10, 2 );

	// Manually control where Post Info & Meta display
	add_action( 'the_post', 'trestle_post_info_meta', 0 );


	/*===========================================
	 * General Actions & Filters
	===========================================*/

	// Add body classes
	add_filter( 'body_class', 'trestle_body_classes' );

	// Do custom Read More text
	add_filter( 'excerpt_more', 'trestle_read_more_link' );
	add_filter( 'get_the_content_more_link', 'trestle_read_more_link' );
	add_filter( 'the_content_more_link', 'trestle_read_more_link' );
}