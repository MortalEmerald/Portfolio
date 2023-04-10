/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.header-titles .site-title, .header-titles .custom-logo-name' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.header-titles .site-title, .header-titles .custom-logo-name, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.header-titles .site-title, .header-titles .custom-logo-name, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.header-titles .site-title, .header-titles .custom-logo-name, .site-description, .site-navigation .primary-menu a, .site-navigation .primary-menu .icon' ).css( {
					color: to,
				} );
				$( ' .navbar-controls .svg-icon' ).css( {
					color: to,
					fill: to,
				} );
			}
		} );
	} );

}( jQuery ) );
