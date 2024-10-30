<?php
/**
 * Feature Name:	Styles
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads the admin styles
 *
 * @wp-hook	admin_init
 *
 * @return	void
 */
function lt_admin_style() {

	$stylename = 'admin.css';
	if ( defined( 'WP_DEBUG' ) )
		$stylename = 'admin.dev.css';

	wp_register_style(
		'lt-admin-styles',
		plugin_dir_url( __FILE__ ) . '../css/' . $stylename
	);
	wp_enqueue_style( 'lt-admin-styles' );
};