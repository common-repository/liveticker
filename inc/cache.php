<?php
/**
 * Feature Name:	Cache System
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads a list of files either with a given search
 * pattern via $search or all the cached files.
 *
 * @param	string $search the search value to identify files
 *
 * @return	array the cached files
 */
function lt_cache_system_get_cached_files( $search = NULL ) {
	// Set list empty
	$cached_files = array();

	// open handle
	$handle = opendir( LT_CACHE_DIR );
	if ( ! $handle )
		return;

	// Loop through directory files
	while ( FALSE != ( $cached_file = readdir( $handle ) ) ) {

		// Is this file for us?
		if ( '.cache' == substr( $cached_file, -6 ) ) {

			if ( is_null( $search ) )
				$cached_files[] = $cached_file;
			else if ( 0 < strpos( $cached_file, $search ) )
				$cached_files[] = $cached_file;
		}
	}
	closedir( $handle );
	return $cached_files;
}

/**
 * Gets the content of a cached file
 *
 * @param	string $file_name name of the file
 *
 * @return	string the loaded file
 */
function lt_cache_system_read_cache( $file_name ) {
	if ( file_exists( LT_CACHE_DIR . $file_name ) )
		return file_get_contents( LT_CACHE_DIR . $file_name );
}

/**
 * Writes the file with some data
 *
 * @param	string $file_name name of the file to write
 * @param	string $data the input data for the file
 *
 * @return	void
 */
function lt_cache_system_write_cache( $file_name, $data ) {
	$cache_file = LT_CACHE_DIR . $file_name;
	// if the file is not writable, return
	if ( file_exists( $cache_file ) && ! is_writable( $cache_file ) || ! is_writable( LT_CACHE_DIR ) )
		return;
	// cache only, if directory is writable, else do nothing, not to crash the whole website
	if ( is_writable( LT_CACHE_DIR ) )
		file_put_contents( $cache_file, $data );
}

/**
 * Deletes a cached file
 *
 * @param	int $post_id
 *
 * @return	void
 */
function lt_remove_tick( $post_id ) {

	$tickers = get_terms( 'ticker', array( 'hide_empty' => FALSE ) );
	foreach ( $tickers as $ticker ) {
		$filename = 'ticker_' . $ticker->slug . '_' . $post_id . '.cache';
		$cache_file = LT_CACHE_DIR . $filename;
		if ( file_exists( $cache_file ) )
			@unlink( $cache_file );
	}
}

/**
 * Saves the data of the tick
 *
 * @param	int $post_id the id of the current tick
 * @param	array $tax_input the ticker where the tick is located
 *
 * @return	void
 */
function lt_create_tick( $post_id, $tax_input = array() ) {

	// Remove all the ticks first
	lt_remove_tick( $post_id );

	// Check Bulk
	if ( defined( 'LT_BULK_EDIT' ) && LT_BULK_EDIT == TRUE ) {
		$_REQUEST[ 'post_title' ] = get_the_title( $post_id );
		$_REQUEST[ 'content' ] = get_post( $post_id )->post_content;
	}

	// Generate HTML
	$html = '<div class="tick hide-tick ' . $post_id . '" post_id="' . $post_id . '">';
	$html .= '<h3>' . get_the_time( 'd.m.Y H:i', $post_id ) . ' - ' . $_REQUEST[ 'post_title' ]. '</h3>';
	if ( has_post_thumbnail( $post_id ) ) {
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$html .= '<a href="' . wp_get_attachment_url( $thumbnail_id ) . '" title="' . esc_attr( $_REQUEST[ 'post_title' ] ) . '" rel="lightbox">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</a>';
	}

	$post_content = $_REQUEST[ 'content' ];
	$post_content = wpautop( $post_content );
	$post_content = do_shortcode( $post_content );
	$post_content = apply_filters( 'the_content', $post_content );

	$html .= '<p class="' . $post_id . '">' . $post_content . '</p>';

	if ( has_post_thumbnail( $post_id ) )
		$html .= '<br style="clear: both;" />';

	$html .= '</div>';

	// Write the cache for each ticker-category
	foreach ( $tax_input as $ticker ) {
		if ( 0 == $ticker )
			continue;

		// generate filename
		$term = get_term_by( 'id', $ticker, 'ticker' );
		$term_slug = $term->slug;

		$filename = 'ticker_' . $term->slug . '_' . $post_id . '.cache';
		lt_cache_system_write_cache( $filename, $html );
	}
}

/**
 * Prepares the data of the tick and decides if the tick
 * should be saved, updated or deleted.
 *
 * @wp-hook	save_post
 *
 * @return	void
 */
function lt_save_tick() {

	// Preventing Autosave, we don't want that
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	// Do we have a ticker post
	if ( isset( $_REQUEST[ 'post_type' ] ) && 'ticks' != $_REQUEST[ 'post_type' ] && 'ticks' != $_REQUEST[ 'post_type' ] )
		return;

	// Bulk Actions
	if ( ! defined( 'LT_BULK_EDIT' ) && isset( $_REQUEST[ 'bulk_edit' ] ) ) {
		define( 'LT_BULK_EDIT', TRUE );

		if ( 'publish' != $_REQUEST[ '_status' ] && '-1' != $_REQUEST[ '_status' ] ) {
			foreach ( $_REQUEST[ 'post' ] as $post_id )
				lt_remove_tick( $post_id );
		} else {
			foreach ( $_REQUEST[ 'post' ] as $post_id ) {
				$current_tax = wp_get_post_terms( $post_id, 'ticker' );
				$tax_input = array();
				if ( ! empty( $current_tax ) )
				foreach ( $current_tax as $tax )
					$tax_input[] = $tax->term_id;

				// Merge with request
				if ( isset( $_REQUEST[ 'tax_input' ][ 'ticker' ] ) && ! empty( $_REQUEST[ 'tax_input' ][ 'ticker' ] ) )
					$tax_input = array_merge( $tax_input, $_REQUEST[ 'tax_input' ][ 'ticker' ] );
				$tax_input = array_unique( $tax_input );

				lt_create_tick( $post_id, $tax_input );
			}
		}
	}

	if ( isset( $_REQUEST[ 'post_ID' ] ) )
		$my_post_id = $_REQUEST[ 'post_ID' ];
	else if ( isset( $_REQUEST[ 'ID' ] ) )
		$my_post_id = $_REQUEST[ 'ID' ];
	else
		return;

	// Check permissions
	if ( ! isset( $_REQUEST[ 'bulk_edit' ] ) && ! current_user_can( 'edit_post', $my_post_id ) )
		return;

	// Only save the tick if we publish the post
	if ( ! isset( $_REQUEST[ 'bulk_edit' ] ) && 'publish' != get_post_status( $my_post_id ) ) {
		lt_remove_tick( $my_post_id );
		return;
	}

	// Create the tick
	if ( ! isset( $_REQUEST[ 'bulk_edit' ] ) )
		lt_create_tick( $my_post_id, $_REQUEST[ 'tax_input' ][ 'ticker' ] );
}