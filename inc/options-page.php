<?php
/**
 * Feature Name:	Options Page
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Adds the options page to the admin menu
 *
 * @wp-hook	admin_menu
 *
 * @return	void
 */
function sf_options_page_admin_menu() {
	add_submenu_page( 'edit.php?post_type=ticks', __( 'Settings' ), __( 'Settings' ), 'manage_options', 'tickerpress-options', 'lt_options_page' );
}

/**
 * Displays the optionspage
 *
 * @return	void
 */
function lt_options_page() {

	?>
	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2><?php _e( 'Settings' ); ?></h2>

		<?php
		if ( isset( $_GET[ 'message' ] ) ) {
			switch( $_GET[ 'message' ] ) {
				case 'updated':
					echo '<div class="updated"><p>' . __( 'Settings saved.' ) . '</p></div>';
					break;
			}
		}
		?>

		<div id="poststuff" class="metabox-holder has-right-sidebar">

			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="help" class="postbox">
						<h3 class="hndle"><span><?php _e( 'Help', LT_TEXTDOMAIN ); ?></span></h3>
						<div class="inside">
							<p><?php _e( 'The usage of the ticker is really simple. It comes with a so called <a href="http://codex.wordpress.org/Shortcode">shortcode</a> namend <em>ticker</em>. So here are the steps to create a ticker:', LT_TEXTDOMAIN ); ?></p>
							<ol>
								<li><?php _e( 'Initiate a <em>Ticker</em> by using the same called menu entry.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Now create an initial Ticker Post and allocate it to the initiated Ticker. It works like the well known categories in the posts.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Publish the Ticker Post.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Go to a post or a page where you want to place the Ticker. Place the shortcode <em>[ticker slug]</em> in the text.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Replace the word <em>slug</em> with the actual slug from the initiated Ticker you created in step one.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Save the post.', LT_TEXTDOMAIN ); ?></li>
								<li><?php _e( 'Ready! Now you can create Ticker Posts just by clicking <em>Add New</em> in the <em>Ticker Post</em>-Section and your visitors can see your ... erm ... tickles!', LT_TEXTDOMAIN ); ?></li>
							</ol>
							<p><?php _e( 'With Liveticker you can initiate unlimited Ticker on your Posts - not in a single post, but in different posts.', LT_TEXTDOMAIN ); ?></p>
							<p><?php _e( 'If you need more help, contact me:', LT_TEXTDOMAIN ); ?> <a href="mailto:t.herzog@inpsyde.com">t.herzog@inpsyde.com</a></p>
						</div>
					</div>
					<div id="inpsyde" class="postbox">
						<h3 class="hndle"><span><?php _e( 'Powered by', LT_TEXTDOMAIN ); ?></span></h3>
						<div class="inside">
							<p style="text-align: center;"><a href="http://inpsyde.com"><img src="<?php echo plugin_dir_url( __FILE__ ) . '../img/inpsyde-logo.png'; ?>" style="border: 7px solid #fff;" /></a></p>
							<p><?php _e( 'This plugin is powered by Inpsyde.com - Your expert for WordPress, BuddyPress and bbPress.', LT_TEXTDOMAIN ); ?></p>
						</div>
					</div>
				</div>
			</div>

			<div id="post-body">
				<div id="post-body-content">
					<div id="normal-sortables" class="meta-box-sortables ui-sortable">

						<form action="<?php echo admin_url( 'admin-post.php?action=lt_save_settings' ); ?>" method="post">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="lt-refresh-interval"><?php _e( 'Refresh-Interval', LT_TEXTDOMAIN ); ?></label>
										</th>
										<td>
											<input type="number" min="5000" step="1" id="lt-refresh-interval" name="lt-refresh-interval" class="" value="<?php echo get_option( 'lt-refresh-interval' ); ?>" /><br />
											<span class="description"><?php _e( 'The Ticker-Box refreshs automatically. For that, we need an interval setted here. The value have to be set in milliseconds (Wished seconds x 100).', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
								</tbody>
							</table>
							<p class="submit">
								<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes' ); ?>">
							</p>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}