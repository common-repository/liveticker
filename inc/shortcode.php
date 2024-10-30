<?php
/**
 * Feature Name:	The Shortcode
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads and displays the ticker.
 *
 * @param array $settings the settings of the ticker
 *
 * @return string
 */
function lt_load_ticker( $settings ) {

	$html = '';

	// Current Ticker Slug
	$ticker_slug = $settings[ 0 ];
	$san_ticker_slug = str_replace( '-', '_', $ticker_slug );

	// Get the needed files
	$loaded_ticks = lt_cache_system_get_cached_files( $ticker_slug );
	sort( $loaded_ticks );
	$files = array_reverse( $loaded_ticks );

	// Build feed link
	$feed_link = get_bloginfo( 'url' );
	if ( is_multisite() && get_current_blog_id() == 1 )
		$feed_link = get_bloginfo( 'url' ) . '/blog';

	// build the output
	$html .= '<a href="' . $feed_link . '/ticker/' . $ticker_slug . '/feed/" target="_blank"><img src="' . plugin_dir_url( __FILE__ ) . '../img/rss.jpg" class="ticker-rss" /></a>';
	$html .= '<div class="ticker ' . $ticker_slug . '" ticker="' . $ticker_slug . '">';

	// build the output
	foreach ( $files as $file )
		$html .= lt_cache_system_read_cache( $file );

	$html .= '</div>';

	// Output needed javascript
	$html .= '<script type="text/javascript">';
	$html .= 'var loadedticks_' . $san_ticker_slug . ' = ["' . implode( '", "', $loaded_ticks ) . '"];';
	$html .= '</script>';

	return $html;
}