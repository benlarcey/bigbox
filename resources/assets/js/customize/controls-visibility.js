/* global wp, jQuery */

/**
 * Toggle other control's visibility based on another.
 */
( function( $ ) {
	const api = wp.customize;

	// Control visibility for controls
	$.each( {
		// Hide WC Store notice controls if notice is disabled.
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
		// Hide font fallback if using system default.
		'type-font-family': {
			controls: [
				'type-font-family-fallback',
			],
			callback: function( to ) {
				return 'default' !== to;
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
