<?php
/**
 * Feature Name:	Registers the ticker taxonomy
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Inits and loads the needed taxonomy
 * which represent the single tickers.
 *
 * @wp-hook	init
 *
 * @return	void
 */
function lt_init_taxonomy() {

	$labels = array(
		'name'							=> __( 'Ticker', LT_TEXTDOMAIN ),
		'singular_name'					=> __( 'Ticker', LT_TEXTDOMAIN ),
		'add_new_item'					=> __( 'Add New Ticker', LT_TEXTDOMAIN ),
		'edit_item'						=> __( 'Edit TIcker', LT_TEXTDOMAIN ),
		'all_items'						=> __( 'All Ticker', LT_TEXTDOMAIN ),
		'search_items'					=> __( 'Search Ticker', LT_TEXTDOMAIN ),
		'parent_item_colon'				=> __( 'Parent Ticker:', LT_TEXTDOMAIN ),
		'menu_name'						=> __( 'Add Ticker', LT_TEXTDOMAIN ),
		'popular_items'					=> __( 'Popular Ticker', LT_TEXTDOMAIN ),
		'parent_item'					=> __( 'Parent Ticker', LT_TEXTDOMAIN ),
		'update_item'					=> __( 'Update Ticker', LT_TEXTDOMAIN ),
		'new_item_name'					=> __( 'New Ticker Name', LT_TEXTDOMAIN ),
		'separate_items_with_commas'	=> __( 'Separate Ticker with commas', LT_TEXTDOMAIN ),
		'add_or_remove_items'			=> __( 'Add or Remove Ticker', LT_TEXTDOMAIN ),
		'choose_from_most_used'			=> __( 'Choose from most used', LT_TEXTDOMAIN ),
	);

	$taxonomy_args = array(
		'public'			=> TRUE,
		'show_ui'			=> TRUE,
		'show_in_nav_menus'	=> TRUE,
		'hierarchical'		=> TRUE,
		'show_tagcloud'		=> FALSE,
		'labels'			=> $labels,
	);

	register_taxonomy( 'ticker', array( 'ticks' ), $taxonomy_args );
}