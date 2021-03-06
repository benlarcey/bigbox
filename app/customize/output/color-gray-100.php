<?php
/**
 * Config for gray-100 color output.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$gray100 = bigbox_get_theme_color( 'gray-100' );

return [
	// Solid background-color.
	[
		'selectors'    => [
			'.footer-copyright',
			'.navbar-mobile__close',
			'.breadcrumbs',
			'.woocommerce-breadcrumb',
			'.navbar-search__category select',

			'.wp-block-table.is-style-stripes tr:nth-child(odd)',

			// Flatpickr.
			'.flatpickr-calendar .flatpickr-day.inRange',
			'.flatpickr-calendar .flatpickr-day.prevMonthDay.inRange',
			'.flatpickr-calendar .flatpickr-day.nextMonthDay.inRange',
			'.flatpickr-calendar .flatpickr-day.today.inRange',
			'.flatpickr-calendar .flatpickr-day.prevMonthDay.today.inRange',
			'.flatpickr-calendar .flatpickr-day.nextMonthDay.today.inRange',
			'.flatpickr-calendar .flatpickr-day:hover',
			'.flatpickr-calendar .flatpickr-day.prevMonthDay:hover',
			'.flatpickr-calendar .flatpickr-day.nextMonthDay:hover',
			'.flatpickr-calendar .flatpickr-day:focus',
			'.flatpickr-calendar .flatpickr-day.prevMonthDay:focus',
			'.flatpickr-calendar .flatpickr-day.nextMonthDay:focus',
		],
		'declarations' => [
			'background-color' => esc_attr( $gray100 ),
		],
	],
	// Solid border-color.
	[
		'selectors'    => [
			'.footer-nav',
		],
		'declarations' => [
			'border-color' => esc_attr( $gray100 ),
		],
	],
];
