<?php
/**
 * Feature Name:	Loads the ticker style
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * This function loads the ticker style in
 * the frontend.
 *
 * @wp-hook	wp_head
 *
 * @return	void
 */
function lt_enqueue_style() {
	?>
	<style type="text/css">
		.ticker {
			<?php echo get_option( 'lt-ticker-css' ); ?>
		}
		.ticker .hide-tick {
			display: none;
		}
		.ticker div.tick {
			<?php echo get_option( 'lt-single-tick-css' ); ?>
		}
		.ticker div.tick:last-child {
			<?php echo get_option( 'lt-single-tick-css-last' ); ?>
		}
		.ticker h3 {
			<?php echo get_option( 'lt-headline-css' ); ?>
		}
		.ticker p {
			<?php echo get_option( 'lt-p-css' ); ?>
		}
		.ticker img {
			<?php echo get_option( 'lt-image-css' ); ?>
		}
		.ticker-rss {
			<?php echo get_option( 'lt-rss-button' ); ?>
		}
	</style>
	<?php
}