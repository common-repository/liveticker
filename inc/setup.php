<?php
/**
 * Feature Name:	Setup
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Build the initial options for the liveticker to
 * provide a simple style at the startup. Fo that
 * this function inserts all options.
 *
 * @return	void
 */
function lt_setup() {
	if ( get_option( 'lt-ticker-setup' ) == 'done' )
		return;
	if ( get_option( 'lt-ticker-css' ) == '' )
		update_option( 'lt-ticker-css', "padding: 5px;\noverflow: auto;\nmargin: 10px 0;\nmin-height: 150px;\nmax-height: 500px;\nbackground: #f1f1f1;\nborder: 1px dashed #ccc;" );
	if ( get_option( 'lt-single-tick-css' ) == '' )
		update_option( 'lt-single-tick-css', "border-bottom: 1px dashed #ccc;" );
	if ( get_option( 'lt-single-tick-css-last' ) == '' )
		update_option( 'lt-single-tick-css-last', "margin-bottom: 0;\nborder-bottom: 0;" );
	if ( get_option( 'lt-headline-css' ) == '' )
		update_option( 'lt-headline-css', "margin: 3px 0 !important;" );
	if ( get_option( 'lt-p-css' ) == '' )
		update_option( 'lt-p-css', "margin: 0 !important;\npadding: 0 !important;" );
	if ( get_option( 'lt-image-css' ) == '' )
		update_option( 'lt-image-css', "float: left;\nborder: 0;\npadding: 0;\nmargin: 0 5px 5px 0;" );
	if ( get_option( 'lt-rss-button' ) == '' )
		update_option( 'lt-rss-button', "border: 0;\nfloat: right;\nright: 50px;\nposition: relative;" );
	if ( get_option( 'lt-refresh-interval' ) == '' )
		update_option( 'lt-refresh-interval', "25000" );
	update_option( 'lt-ticker-setup', 'done' );
}