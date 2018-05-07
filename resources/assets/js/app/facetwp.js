/* global FWP, jQuery */

/**
 * Internal dependencies.
 */
import { adjustWidth } from './navbar.js';

( function( $ ) {
	const $document = $( document );

	/**
	 * Refresh FacetWP when on the shop page.
	 *
	 * @param {Event} e Submit event.
	 */
	$( '#facetwp-primary-search' ).submit( function( e ) {
		e.preventDefault();

		FWP.refresh();
	} );

	/**
	 * Don't push empty form values forward to help FacetWP load initially.
	 */
	$( '#primary-search' ).submit( function() {
		$( this )
			.find( 'input, select' )
			.filter( function() {
				return ! this.value;
			} )
			.prop( 'name', '' );
	} );

	const $htmlbody = $( 'html, body' );
	const $categories = $( '.products-categories' );

	// Adjust select widths once loaded.
	$document.on( 'facetwp-loaded', adjustWidth );

	$document.on( 'facetwp-loaded', () => {
		if ( FWP.loaded ) {
			$htmlbody.animate( {
				scrollTop: $( '#main' ).offset().top,
			}, 250 );

			$categories.hide();
		}

		if ( '' !== FWP.build_query_string() ) {
			$categories.hide();
		}
	} );

	// Add "real" checkboxes and radio.
	$document.on( 'facetwp-loaded', () => {
		$( '.facetwp-checkbox' ).each( function() {
			const $checkbox = $( this );

			$checkbox
				.prepend( `<input type="checkbox" ${ $checkbox.hasClass( 'checked' ) ? 'checked' : null } />` );
		} );

		$( '.facetwp-radio' ).each( function() {
			const $radio = $( this );

			$radio
				.prepend( `<input type="radio" ${ $radio.hasClass( 'checked' ) ? 'checked' : null } />` );
		} );
	} );
}( jQuery ) );
