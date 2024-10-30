<?php
/**
 * Feature Name:	Shows the columns for the topics
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Registers the column header for the ticker
 *
 * @wp-hook	manage_edit-topics_columns
 *
 * @param	array $defaults
 *
 * @return	array
 */
function lt_custom_column_head( $defaults ) {
	$defaults[ 'ticker' ] = __( 'Ticker', LT_TEXTDOMAIN );
	return $defaults;
}

/**
 * Loads the custom column content
 *
 * @wp-hook	manage_posts_custom_column
 *
 * @param	string $column_name
 *
 * @return	void
 */
function lt_custom_column_content( $column_name ) {
	global $post;
	if ( $column_name == 'ticker' )
		echo get_the_term_list( $post->ID, 'ticker', '', ', ', '' );
}