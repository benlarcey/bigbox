<?php
/**
 * Config for gray-500 color output.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

$gray500 = bigbox_get_theme_color( 'gray-500' );

return [
	// Solid color.
	[
		'selectors'    => [
			'.woocommerce-products-header .term-description',
			'.star-rating__count',
			'.woocommerce-review-link',
			'.coupons-next',
			'.wc_payment_method label[for^="payment_method"]',
			'.woocommerce .input-text + span',
		],
		'declarations' => [
			'color' => esc_attr( $gray500 ),
		],
	],
];
