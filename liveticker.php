<?php
/**
 * Plugin Name:	Liveticker
 * Description:	Ajaxified Liveticker which can be placed in an arcticle. Uses Custom Post Types, Custom Taxonomies and the shortcode [ticker]. You can also use own RSS-Feeds for each ticker you created.
 * Version:		1.0.2
 * Author:		HerrLlama for wpcoding.de
 * Author URI:	http://wpcoding.de
 * Licence:		GPLv3
 */

// check wp
if ( ! function_exists( 'add_action' ) )
	return;

// constants
define( 'LT_TEXTDOMAIN', 'liveticker-td' );
define( 'LT_CACHE_DIR', dirname( __FILE__ ) . '/cache/' );

// kickoff
add_action( 'plugins_loaded', 'lt_init' );
function lt_init() {

	// setup
	require_once dirname( __FILE__ ) . '/inc/setup.php';
	lt_setup();

	// localization
	require_once dirname( __FILE__ ) . '/inc/localization.php';

	// register post type and taxonomy
	require_once dirname( __FILE__ ) . '/inc/register-post-type.php';
	add_action( 'init', 'lt_register_post_type' );
	require_once dirname( __FILE__ ) . '/inc/register-taxonomy.php';
	add_action( 'init', 'lt_init_taxonomy' );

	// load the ticker style and scripts
	require_once dirname( __FILE__ ) . '/inc/load-ticker-style.php';
	add_filter( 'wp_head', 'lt_enqueue_style' );
	require_once dirname( __FILE__ ) . '/inc/load-ticker-scripts.php';
	add_action( 'wp_enqueue_scripts', 'lt_wp_enqueue_scripts' );

	// cache system
	require_once dirname( __FILE__ ) . '/inc/cache.php';
	add_filter( 'save_post', 'lt_save_tick' );

	// shortcode
	require_once dirname( __FILE__ ) . '/inc/shortcode.php';
	add_shortcode( 'ticker', 'lt_load_ticker' );

	// ajax stuff
	require_once dirname( __FILE__ ) . '/inc/ajax-load-new-ticks.php';
	add_action( 'wp_ajax_get_new_ticks', 'lt_get_new_ticks' );
	add_action( 'wp_ajax_nopriv_get_new_ticks', 'lt_get_new_ticks' );

	// the widget
	require_once dirname( __FILE__ ) . '/inc/widget.php';
	add_action( 'widgets_init', array( 'Liveticker_Widget', 'register' ) );

	// everything below is just in the admin panel
	if ( ! is_admin() )
		return;

	// admin style
	require_once dirname( __FILE__ ) . '/inc/admin-style.php';
	add_action( 'admin_init', 'lt_admin_style' );

	// depencies of the custom post type
	global $pagenow;
	if ( $pagenow == 'edit.php' && isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] == 'ticks' ) {
		require_once dirname( __FILE__ ) . '/inc/ticks-columns.php';
		add_action( 'manage_edit-topics_columns', 'lt_custom_column_head' );
		add_action( 'manage_posts_custom_column', 'lt_custom_column_content' );
	}

	// options page
	require_once dirname( __FILE__ ) . '/inc/options-page.php';
	add_action( 'admin_menu', 'sf_options_page_admin_menu' );

	// save the options
	require_once dirname( __FILE__ ) . '/inc/save-options.php';
	add_filter( 'admin_post_lt_save_settings', 'lt_save_settings' );

	// template page
	require_once dirname( __FILE__ ) . '/inc/template-page.php';
	add_action( 'admin_menu', 'sf_template_page_admin_menu' );

	// saves the template
	require_once dirname( __FILE__ ) . '/inc/save-template.php';
	add_filter( 'admin_post_lt_save_template', 'lt_save_template' );
}