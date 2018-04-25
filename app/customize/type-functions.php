<?php
/**
 * Type helper functions.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

/**
 * Get the chosen family.
 *
 * @since 1.0.0
 *
 * @return string
 */
function bigbox_get_theme_font_family() {
	$family = get_theme_mod( 'type-font-family', 'Lato' );

	/**
	 * Filters the name of the font family used to generate custom CSS.
	 *
	 * @since 1.0.0
	 *
	 * @param string $family The name of the font family.
	 */
	return apply_filters( 'bigbox_get_theme_font_family', $family );
}

/**
 * Get the chosen weight.
 *
 * @since 1.0.0
 *
 * @param string $weight_type Weight to get.
 * @return string
 */
function bigbox_get_theme_font_weight( $weight_type = 'base' ) {
	$weight = get_theme_mod( "type-font-weight-{$weight_type}", 'base' === $weight_type ? 400 : 700 );

	if ( 'regular' === $weight ) {
		return 400;
	}

	/**
	 * Filters the font weight used to generate custom CSS.
	 *
	 * @since 1.0.0
	 *
	 * @param string $family      The name of the font family.
	 * @param string $weight_type The name of the weight type to get. Either `base` or `bold`.
	 */
	return apply_filters( 'bigbox_get_theme_font_weight', $weight, $weight_type );
}

/**
 * Get a Google font family and variants.
 *
 * Raleway:400,500
 *
 * @return string
 */
function bigbox_get_google_font_family_string() {
	$family = bigbox_get_theme_font_family();

	if ( 'default' == $family ) {
		return false;
	}

	$base = bigbox_get_theme_font_weight( 'base' );
	$bold = bigbox_get_theme_font_weight( 'bold' );

	$weights = implode( ',', [ $base, $bold ] );
	$family  = urlencode( $family );

	return $family . ':' . $weights;
}

/**
 * Create a URL for to load a Google font.
 *
 * @since 1.0.0
 *
 * @return mixed URL if needed. False otherwise.
 */
function bigbox_get_google_fonts_url() {
	$family_string = bigbox_get_google_font_family_string();

	if ( ! $family_string ) {
		return false;
	}

	$base_url = '//fonts.googleapis.com/css';

	return esc_url_raw( add_query_arg( [ 'family' => $family_string ], $base_url ) );
}
