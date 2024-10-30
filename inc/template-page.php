<?php
/**
 * Feature Name:	Options Page
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

/**
 * Adds the menu page for the template
 *
 * @wp-hook	sf_template_page_admin_menu
 *
 * @return	void
 */
function sf_template_page_admin_menu() {
	add_submenu_page( 'edit.php?post_type=ticks', __( 'Template', LT_TEXTDOMAIN ), __( 'Template', LT_TEXTDOMAIN ), 'manage_options', 'tickerpress-template', 'lt_template_page' );
}

/**
 * Displays the template page
 *
 * @return	void
 */
function lt_template_page() {
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br></div>
		<h2><?php _e( 'Template', LT_TEXTDOMAIN ); ?></h2>

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

						<form action="<?php echo admin_url( 'admin-post.php?action=lt_save_template' ); ?>" method="post">

							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row"><label for="template[ticker-css]"><?php _e( 'Ticker-CSS', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[ticker-css]" name="template[ticker-css]" class="large-text" rows="10" ><?php echo get_option( 'lt-ticker-css' ); ?></textarea><br />
											<span class="description"><?php _e( 'This style defines the main area of a live ticker.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[single-tick-css]"><?php _e( 'Single-Tick-CSS', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[single-tick-css]" name="template[single-tick-css]" class="large-text" rows="10" ><?php echo get_option( 'lt-single-tick-css' ); ?></textarea><br />
											<span class="description"><?php _e( 'This style defines single ticker post wrapper.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[single-tick-css-last]"><?php _e( 'Single-Tick-CSS Last Element', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[single-tick-css-last]" name="template[single-tick-css-last]" class="large-text" rows="10" ><?php echo get_option( 'lt-single-tick-css-last' ); ?></textarea><br />
											<span class="description"><?php _e( 'This style defines last single ticker post wrapper.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[headline-css]"><?php _e( 'Headline-CSS', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[headline-css]" name="template[headline-css]" class="large-text" rows="10" ><?php echo get_option( 'lt-headline-css' ); ?></textarea><br />
											<span class="description"><?php _e( 'Style the headline of each ticker post with this setting.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[p-css]"><?php _e( 'P-Tag-CSS', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[p-css]" name="template[p-css]" class="large-text" rows="10" ><?php echo get_option( 'lt-p-css' ); ?></textarea><br />
											<span class="description"><?php _e( 'Every text is inside of a p-html-tag. You can style it with this setting.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[image-css]"><?php _e( 'Image-CSS', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[image-css]" name="template[image-css]" class="large-text" rows="10" ><?php echo get_option( 'lt-image-css' ); ?></textarea><br />
											<span class="description"><?php _e( 'This style setting is able to style all the incoming images.', LT_TEXTDOMAIN ); ?></span>
										</td>
									</tr>
									<tr>
										<th scope="row"><label for="template[rss-button]"><?php _e( 'RSS Button', LT_TEXTDOMAIN ); ?></label></th>
										<td>
											<textarea id="template[rss-button]" name="template[rss-button]" class="large-text" rows="10"><?php echo get_option( 'lt-rss-button' ); ?></textarea><br />
											<span class="description"><?php _e( 'This style allowes you to set the position of the RSS-Button.', LT_TEXTDOMAIN ); ?></span>
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