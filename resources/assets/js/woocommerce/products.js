/* global jQuery, wc_single_product_params */

/**
 * Transform a <input type="number"> element in to a <select> element.
 *
 * Preserve as many as the original attributes as possible.
 */

/**
 * Internal dependencies.
 */
import { transformInput } from './quantity';

/**
 * Transform purchase form quantities.
 */
( function( $ ) {
	// Can't cache the .qty input because it gets replaced.
	const $form = $( 'form.cart' );

	// Variation update.
	$form.on( 'show_variation', ( e, variation ) => {
		transformInput( $form.find( '.qty' ), variation );
		$form.addClass( 'woocommerce-variation--loaded' );
	} );

	// All.
	transformInput( $form.find( '.qty' ), false );
}( jQuery ) );

/**
 * Submit product category selector.
 */
( function( $ ) {
	const $form = $( '#product-category-selector' );

	// Variation update.
	$form.find( 'select' ).on( 'change', () => {
		$form.submit();
	} );
}( jQuery ) );

/**
 * Set width of flexSlider.
 */
( function( $ ) {
	if ( ! wc_single_product_params.flexslider ) {
		return;
	}

	$( '.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:eq(0) .wp-post-image' ).on( 'load', () => {
		$( '.woocommerce-product-gallery--with-images .flex-viewport' ).css( 'maxWidth', `${ wc_single_product_params.flexslider.itemWidth }px` );
	} );
}( jQuery ) );
