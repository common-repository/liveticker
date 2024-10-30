<?php
/**
 * Feature Name:	Save the Options
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Saves the options
 *
 * @wp-hook	admin_post_lt_save_settings
 *
 * @return	void
 */
function lt_save_settings() {
	update_option( 'lt-refresh-interval', $_POST[ 'lt-refresh-interval' ] );
	wp_redirect( 'edit.php?post_type=ticks&page=tickerpress-options&message=updated' );
}