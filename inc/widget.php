<?php
/**
 * Feature Name:	Widget
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

if ( ! class_exists( 'Liveticker_Widget' ) ) {

	class Liveticker_Widget extends WP_Widget {

		/**
		 * constructor
		 *
		 * @return	void
		 */
		public function __construct() {

			parent::__construct(
				'liveticker-widget',
				'Liveticker Widget',
				array( 'description' => __( 'This widget displays a Liveticker in your sidebar.', LT_TEXTDOMAIN ) )
			);
		}

		/**
		 * displays the widget in frontend
		 *
		 * @param	array $args the widget arguments
		 * @param	array $instance current instance
		 * @return	void
		 */
		public function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			$title = '';
			if ( isset( $instance[ 'title' ] ) )
				$title = $instance[ 'title' ];

			$current_ticker = '';
			if ( isset( $instance[ 'ticker' ] ) )
				$current_ticker = esc_attr( $instance[ 'ticker' ] );

			$title = apply_filters( 'widget_title', $title );

			if ( '' != $title )
				echo $before_title . $title . $after_title;

			echo do_shortcode( '[ticker ' . $current_ticker . ']' );

			echo $after_widget;
		}

		/**
		 * process the options-updateing
		 *
		 * @param	array $new_instance
		 * @param	array $old_instance
		 * @return	array
		 */
		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
			$instance[ 'ticker' ] = strip_tags( $new_instance[ 'ticker' ] );
			return $instance;
		}

		/**
		 * the backend options form
		 *
		 * @param	array $instance
		 * @return	string
		 */
		public function form( $instance ) {

			$title = '';
			if ( isset( $instance[ 'title' ] ) )
				$title = esc_attr( $instance[ 'title' ] );

			$current_ticker = '';
			if ( isset( $instance[ 'ticker' ] ) )
				$current_ticker = esc_attr( $instance[ 'ticker' ] );
			?>
			<p>
				<label for="<?php $this->get_field_id( 'title' );?>">
					<?php _e( 'Title' );?>
				</label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'title' );?>" name="<?php echo $this->get_field_name( 'title' );?>" class="large-text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php $this->get_field_id( 'ticker' );?>">
					<?php _e( 'Choose Ticker:', LT_TEXTDOMAIN );?>
				</label><br />
				<select id="<?php echo $this->get_field_id( 'ticker' );?>" name="<?php echo $this->get_field_name( 'ticker' );?>" style="width: 99%;">
					<?php
					$tickers = get_terms( 'ticker', array( 'hide_empty' => FALSE ) );
					if ( ! empty( $tickers ) ) {
						foreach ( $tickers as $ticker ) {
							?><option value="<?php echo $ticker->slug; ?>" <?php selected( $ticker->slug, $current_ticker ); ?>><?php echo $ticker->name; ?></option><?php
						}
					}
					?>
				</select>
			</p>
			<?php
			return TRUE;
		}

		/**
		 * register
		 *
		 * @return	void
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
}