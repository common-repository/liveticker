<?php
/**
 * Feature Name:	Load new ticks
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads the new ticks
 *
 * @wp-hook	wp_ajax_get_new_ticks
 * @wp-hook	wp_ajax_nopriv_get_new_ticks
 *
 * @return	void
 */
function lt_get_new_ticks() {

	if ( ! defined( 'DOING_AJAX' ) ) {
		echo __( 'You are not doing ajax here!', LT_TEXTDOMAIN );
		exit;
	}

	// Load new files
	$files = lt_cache_system_get_cached_files( $_REQUEST[ 'current_ticker' ] );
	sort( $files );
	$files = array_reverse( $files );

	$new_files = array();
	foreach ( $files as $file ) {
		if ( ! in_array( $file, $_REQUEST[ 'loadedticks' ] ) ) {
			$new_files[] = $file;
			$_REQUEST[ 'loadedticks' ][] = $file;
		}
	}

	// are the new files present?
	if ( ! is_array( $new_files ) || 0 >= count( $new_files ) )
		exit;

	// Loaded Files
	$response[ 'loadedticks' ] = $new_files;

	// Read Cache and push html
	$html = '';
	foreach ( $new_files as $file )
		$html .= lt_cache_system_read_cache( $file );

	$response[ 'html' ] = $html;

	echo json_encode( $response );

	exit;
}