<?php
/**
 * Config for danger color output.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

$danger = bigbox_get_theme_color( 'danger' );
$rgba10 = bigbox_hex_to_rgba( $danger, 0.10 );
$rgba30 = bigbox_hex_to_rgba( $danger, 0.30 );
$rgba50 = bigbox_hex_to_rgba( $danger, 0.50 );

return [
	// Solid color.
	[
		'selectors'    => [
			'.woocommerce-remove-coupon',
			'.woocommerce-purchase-form .outofstock',
			'label .required',
		],
		'declarations' => [
			'color' => esc_attr( $danger ),
		],
	],

	// @mixin card--error.
	[
		'selectors'    => [
			'.woocommerce-error li',
		],
		'declarations' => [
			'color'        => esc_attr( $danger ),
			'border-color' => esc_attr( $rgba50 ),
			'box-shadow'   => esc_attr( "inset {$rgba10} 0 0 0 3px, {$rgba30} 0 1px 2px" ),
			'font-weight'  => esc_attr( bigbox_get_theme_font_weight( 'bold' ) ),
		],
	],

	// @mixin button--danger.
	[
		'selectors'    => [],
		'declarations' => [
			'background-color' => esc_attr( $danger ),
		],
	],
];
