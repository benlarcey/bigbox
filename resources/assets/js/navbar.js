/** global $ */

/**
 * Adjust width of navbar dropdown.
 */
export const adjustWidth = () => {
	const $real = $( '#search-dropdown-real' ).find( 'select' );
	const $fake = $( '#search-dropdown-placeholder' )

	let selected = $real.find( 'option:selected' ).text();

	if ( selected.length ) {
		$fake.find( 'option' ).html( selected );
	}

	// Adjust width.
	$real.width( $fake.width() );

	// Trigger again on change.
	$real.change( adjustWidth );
};
