<?php
/**
 * Config for warning color output.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

$warning = bigbox_get_theme_color( 'warning' );
$default = bigbox_get_theme_default_color( 'warning' );

if ( $warning === $default ) {
	return [];
}

return [
	// Solid background-color.
	[
		'selectors'    => [
			'.woocommerce-store-notice',
			'.button--warning',
		],
		'declarations' => [
			'background-color' => esc_attr( $warning ),
		],
	],
	// Solid color.
	[
		'selectors'    => [
			'.woocommerce-remove-coupon',
			'.order-status--on-hold',
			'.order-status--refunded',
		],
		'declarations' => [
			'color' => esc_attr( $warning ),
		],
	],
];
