<?php
/**
 * Build CSS for editor iframe.
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

$css = new \BigBox\Customize\Build_Inline_CSS();

$gray700 = bigbox_get_theme_color( 'gray-700' );
$gray800 = bigbox_get_theme_color( 'gray-800' );

$family      = bigbox_get_theme_font_family();
$weight_base = bigbox_get_theme_font_weight( 'base' );
$weight_bold = bigbox_get_theme_font_weight( 'bold' );
$size        = get_theme_mod( 'type-font-size', 1 );

$css->add(
	[
		'selectors'    => [
			'.mce-content-body',
		],
		'declarations' => [
			'color' => esc_attr( $gray700 ),
		],
	]
);

$css->add(
	[
		'selectors'    => [
			'.mce-content-body a',
			'.mce-content-body h1',
			'.mce-content-body h2',
			'.mce-content-body h3',
			'.mce-content-body h4',
			'.mce-content-body h5',
			'.mce-content-body h6',
		],
		'declarations' => [
			'color' => esc_attr( $gray800 ),
		],
	]
);

$type_base = [
	'font-weight' => $weight_base,
	'font-size'   => "{$size}em",
];

if ( $family ) {
	$type_base['font-family'] = $family;
}

$css->add(
	[
		'selectors'    => [
			'.mce-content-body',
		],
		'declarations' => $type_base,
	]
);

$css->add(
	[
		'selectors'    => [
			'.mce-content-body strong',
		],
		'declarations' => [
			'font-weight' => $weight_bold,
		],
	]
);

return $css->build();
