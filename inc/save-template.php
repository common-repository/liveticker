<?php
/**
 * Feature Name:	Save the Options
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Saves the template
 *
 * @wp-hook	admin_post_lt_save_template
 *
 * @return	void
 */
function lt_save_template() {
	$settings = array( 'ticker-css', 'single-tick-css', 'single-tick-css-last', 'headline-css', 'p-css', 'image-css', 'rss-button' );
	foreach ( $settings as $setting )
		update_option( 'lt-' . $setting, $_POST[ 'template' ][ $setting ] );
	wp_redirect( 'edit.php?post_type=ticks&page=tickerpress-template&message=updated' );
}