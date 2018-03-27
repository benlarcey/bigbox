/**
 * External dependencies.
 */
import { forEach } from 'lodash';

/**
 * Internal dependencies.
 */
import { transformInput } from './quantity';

// Partials to update.
export const partials = {
	cart:   '#bigbox-cart',
	totals: '#bigbox-cart-totals',
	review: '#bigbox-cart-review',
}

/**
 * Collect all quantity inputs and update to selects.
 *
 * Can't loop because we don't want to use the cache.
 */
export const transformQtys = () => {
	forEach ( partials, ( selector ) => {
		$( selector ).find( '.qty' ).each( function() {
			transformInput( $( this ), false );
		} );
	} );
};

/**
 * Block partials when something is changing.
 */
export const blockPartials = () => {
	forEach( partials, ( selector ) => {
		$( selector ).addClass( 'processing' ).block( {
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		} );
	} );
}

/**
 * Update partials with response data.
 *
 * @param {object} response Response fragments to map to partials.
 */
export const updatePartials = ( response ) => {
	forEach( partials, ( selector, partial ) => {
		$( selector )
			.replaceWith( response.data[ partial ] )

			// Unblock
			.removeClass( 'processing' )
			.unblock();
	} );

	transformQtys();
}

/**
 * Update cart contents when quantity changes.
 */
$( '#bigbox-cart' ).on( 'change', '.qty', function() {
	blockPartials();

	wp.ajax.send( 'bigbox_update_cart', {
		data: {
			checkout: $(this).serialize(),
		},
		success( response ) {
			updatePartials( response );
		},
	} );
} );

/**
 * Transform quantity fields.
 */
transformQtys();

const $body    = $( document.body );
const triggers = [
	'init_checkout',
	'payment_method_selected',
	'updated_checkout',
	'updated_wc_div',
	'updated_cart_totals',
	'updated_shipping_method',
];

triggers.forEach( ( trigger ) => {
	$body.on( trigger, transformQtys );
} );
