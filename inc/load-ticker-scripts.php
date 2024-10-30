<?php
/**
 * Feature Name:	Scripts
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads the needed scripts for the frontend
 *
 * @wp-hook	wp_enqueue_scripts
 *
 * @return	void
 */
function lt_wp_enqueue_scripts() {

	$script_suffix = '.js';
	if ( defined( 'WP_DEBUG' ) )
		$script_suffix = '.dev.js';

	wp_register_script(
		'lt-frontend-scripts',
		plugin_dir_url( __FILE__ ) . '../js/frontend' . $script_suffix,
		array( 'jquery' )
	);

	wp_enqueue_script( 'lt-frontend-scripts' );
	wp_localize_script( 'lt-frontend-scripts', 'lt_vars', array(
		'admin_ajax'	=> admin_url( 'admin-ajax.php' ),
		'interval'		=> get_option( 'lt-refresh-interval' )
	) );
};