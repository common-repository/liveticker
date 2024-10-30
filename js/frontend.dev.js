/**
 * Feature Name:	Frontend JS
 * Author:			HerrLlama for Inpsyde GmbH
 * Author URI:		http://inpsyde.com
 * Licence:			GPLv3
 */

( function( $ ) {
	var lt_frontend = {
		init : function () {
			
			if ( $( '.ticker' ) ) {
				$.each( $( '.ticker' ), function( index, value ) {
					lt_frontend.load_next_posts( $( value ).attr( 'ticker' ) );
					lt_frontend.double_post_check( $( value ).attr( 'ticker' ) );
				} );
				setInterval( lt_frontend.init, lt_vars.interval );
    		}
			
		},
		
		double_post_check: function( current_ticker ) {
			
			$.each( $( '.' + current_ticker ).children( '.hide-tick' ), function( i, ele ) {
				
				$.each( $( '.' + current_ticker ).children( '.' + $( ele ).attr( 'post_id' ) ), function( check_i, check_v ) {
					if ( check_i == 0 ) {
						$( check_v ).show( 'slow' );
					} else {
						$( check_v ).remove();
					}
				} );
			} );
		},
		
		load_next_posts : function( current_ticker ) {
			
			var san_current_ticker = current_ticker.replace( /-/g, "_" );
			var loadedticks = eval( 'loadedticks_' + san_current_ticker );
			
			var post_vars = {
				loadedticks: loadedticks,
				current_ticker: current_ticker,
				action: 'get_new_ticks'
			};
			$.ajax( {
				data: post_vars,
				url: lt_vars.admin_ajax,
				async: true,
				dataType: 'html',
				success: function( response ) {
					
					var stuff = $.parseJSON( response );
					
					if ( null != stuff ) {
						$.each( stuff.loadedticks, function( index, value ) {
							loadedticks.push( value );
						} );
						
						$( stuff.html ).hide().prependTo( '.' + current_ticker );
						lt_frontend.double_post_check( current_ticker );
					}
				}
		    } );
		},
	};
	$( document ).ready( function( $ ) {
		lt_frontend.init();
	} );
} )( jQuery );