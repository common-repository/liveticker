<?php
/**
 * Feature Name:	Registers the ticks post type
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Loads the custom post type for the
 * single ticks.
 *
 * @wp-hook	init
 *
 * @return	void
 */
function lt_register_post_type() {
	$labels = array(
		'name'					=> __( 'Ticks', LT_TEXTDOMAIN ),
		'add_new'				=> __( 'Add Tick', LT_TEXTDOMAIN ),
		'new_item'				=> __( 'New Tick', LT_TEXTDOMAIN ),
		'all_items'				=> __( 'All Ticks', LT_TEXTDOMAIN ),
		'edit_item'				=> __( 'Edit Tick', LT_TEXTDOMAIN ),
		'view_item'				=> __( 'View Ticks', LT_TEXTDOMAIN ),
		'not_found'				=> __( 'Nothing Found', LT_TEXTDOMAIN ),
		'menu_name'				=> __( 'Liveticker', LT_TEXTDOMAIN ),
		'add_new_item'			=> __( 'Add New Tick', LT_TEXTDOMAIN ),
		'search_items'			=> __( 'Search Ticks', LT_TEXTDOMAIN ),
		'singular_name'			=> __( 'Tick', LT_TEXTDOMAIN ),
		'parent_item_colon'		=> __( 'Parent Tick:', LT_TEXTDOMAIN ),
		'not_found_in_trash'	=> __( 'Nothing Found in Trash', LT_TEXTDOMAIN ),
	);

	$supports = array(
		'title',
		'editor',
		'author',
		'thumbnail',
		'revisions'
	);

	$post_type_args = array(
		'public' 				=> TRUE,
		'exclude_from_search'	=> FALSE,
		'publicly_queryable'	=> TRUE,
		'show_ui' 				=> TRUE,
		'show_in_nav_menus'		=> TRUE,
		'show_in_menu'			=> TRUE,
		'show_in_admin_bar'		=> TRUE,
		'menu_position' 		=> NULL,
		'hierarchical' 			=> FALSE,
		'has_archive'			=> TRUE,
		'can_export'			=> TRUE,
		'labels'				=> $labels,
		'supports' 				=> $supports,
	);

	register_post_type( 'ticks', $post_type_args );
}