/* global $, wc_checkout_params */

/**
 * External dependencies.
 */
import domReady from '@wordpress/dom-ready';

/**
 * Internal dependencies.
 */
import { transformQtys, bindQtyChangeEvents } from './quantity';
import { getPartial, blockPartials, unblockPartials, updatePartialsWithResponse } from './../utils/partials.js';

// WooCommerce uses jQuery to send out triggers.
const $body = $( document.body );

// Partials to update.
const partials = {
	review: '#bigbox-cart-review',
};

/**
 * Refresh partials when a quantity item changes.
 */
const refreshCheckout = () => {
	blockPartials( Object.values( partials ) );

	wp.ajax.send( 'bigbox_update_cart_review', {
		data: {
			security: wc_checkout_params.update_order_review_nonce,
			checkout: new URLSearchParams( new FormData( document.getElementById( 'bigbox-checkout' ) ) ).toString(),
		},
		/**
		 * Update cart partials when session has been updated.
		 *
		 * @param {Object} response AJAX response object containing cart data.
		 */
		success: response => {
			// Inject response.
			updatePartialsWithResponse( response, partials );
			
			$body.trigger( 'update_checkout' );

			// Rebind quantities.
			doQty();

			// Unblock.
			unblockPartials( Object.values( partials ) );
		}
	} );
}

/**
 * Helper to transform quantities and bind changes.
 */
const doQty = () => {
	transformQtys( partials );
	bindQtyChangeEvents( partials, refreshCheckout );
}

/**
 * List of WooCommerce triggers that require quantities to be rebuilt.
 */
const triggers = [
	'payment_method_selected',
	'updated_checkout',
	'updated_shipping_method',
];

triggers.forEach( trigger => $body.on( trigger, doQty ) );
