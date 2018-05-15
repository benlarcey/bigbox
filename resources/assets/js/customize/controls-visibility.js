/* global wp, jQuery */

/**
 * Toggle other control's visibility based on another.
 */
( function( $ ) {
	const api = wp.customize;

	// Control visibility for controls
	$.each( {
		woocommerce_demo_store: {
			controls: [
				'demo-store-notice-position',
				'demo-store-notice-color',
				'demo-store-notice-color-background',
			],
			callback: function( to ) {
				return !! to;
			},
		},
	}, ( settingId, o ) => {
		api( settingId, ( setting ) => {
			// Handle multiple toggles.
			$.each( o.controls, ( i, controlId ) => {
				// Toggle control.
				api.control( controlId, ( control ) => {
					const visibility = ( to ) => {
						control.container.toggle( o.callback( to ) );
					};

					visibility( setting.get() );

					setting.bind( visibility );
				} );
			} );
		} );
	} );
}( jQuery ) );
