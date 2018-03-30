<?php
/**
 * Config for type output.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

$family      = bigbox_get_theme_font_family();
$weight_base = bigbox_get_theme_font_weight( 'base' );
$weight_bold = bigbox_get_theme_font_weight( 'bold' );

return [
	[
		'selectors'    => [
			'body',
		],
		'declarations' => [
			'font-family' => $family,
			'font-weight' => $weight_base,
		],
	],

	// Bold
	[
		'selectors'    => [
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'strong',
			'table tfoot td',
			'.product__sale a',
			'.site-title',
			'.action-list__item-label',
		],
		'declarations' => [
			'font-weight' => $weight_bold,
		],
	],
];
