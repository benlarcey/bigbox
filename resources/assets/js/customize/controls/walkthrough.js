/* global jQuery, wp, bigboxCustomizeControls, _ */

/**
 * Internal dependencies.
 */
const {
	active,
	pointers,
} = bigboxCustomizeControls.walkthrough;

const template = wp.template( 'bigbox-pointer' );

let activePointer = 0;

/**
 * Determine next pointer.
 *
 * @return {number} Next pointer index.
 */
const nextPointer = () => {
	return activePointer + 1 < pointers.length ? activePointer + 1 : pointers.length;
};

/**
 * Toggle any active pointers.
 */
const hideActivePointer = () => {
	const $pointer = document.querySelector( '.bigbox-pointer' );

	if ( $pointer !== null ) {
		$pointer.style.display = 'none';
	}
};

/**
 * Calculate the offset positioning for an element.
 *
 * Currently all pointers are a fixed X offset (width of customize pane)
 * and only move up and down.
 *
 * @param {Object} elPosition Element offset.
 * @return {Object} Offset positioning object. Contains left and top offset numbers.
 */
const calculateOffset = ( elPosition ) => {
	return {
		left: 299 + 10,
		top: elPosition.y + ( elPosition.height / 2 ),
	};
};

/**
 * Show a pointer.
 *
 * @param {number} pointer The index of the pointer to show.
 */
const showPointer = ( pointer ) => {
	// Hide previous pointer.
	hideActivePointer();

	// Set current pointer.
	activePointer = pointer;

	// Display.
	const pointerObj = pointers[ pointer ];

	const $el = document.querySelector( pointerObj.el );
	const offset = calculateOffset( $el.getBoundingClientRect() );

	// Inject
	const $pointer = document.querySelector( '.bigbox-pointer' );
	$pointer.innerHTML = template( {
		...pointerObj,
		last: nextPointer() === pointers.length,
	} );

	// Update position.
	$pointer.style.left = `${ offset.left }px`;
	$pointer.style.top = `${ offset.top }px`;

	// Attempt to focus a portion of the UI then show popover.
	if ( pointerObj.focusType && pointerObj.focus ) {
		wp.customize[ pointerObj.focusType ]( pointerObj.focus ).focus();
	}

	// Show.
	$pointer.style.display = 'block';
};

( function( $ ) {
	if ( ! active ) {
		return;
	}

	const $customizer = $( '.wp-customizer' );

	// Wait for Customize ready.
	wp.customize.bind( 'ready', () => showPointer( 0 ) );

	// Go forward.
	$customizer.on( 'click', '.bigbox-pointer .next', () => showPointer( nextPointer() ) );

	// Dismiss
	$customizer.on( 'click', '.bigbox-pointer .close', hideActivePointer );
}( jQuery ) );
