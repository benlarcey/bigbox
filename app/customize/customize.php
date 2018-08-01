<?php
/**
 * WordPress customize enhancements.
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

// Colors and Type helpers.
require_once get_template_directory() . '/app/customize/color-functions.php';
require_once get_template_directory() . '/app/customize/type-functions.php';
require_once get_template_directory() . '/app/customize/selector-functions.php';

// Controls.
require_once get_template_directory() . '/app/customize/controls.php';

// Handle live preview.
require_once get_template_directory() . '/app/customize/preview.php';

/**
 * Build inline CSS.
 *
 * @since 1.0.0
 */
function bigbox_customize_inline_css() {
	$css = new \BigBox\Customize\Build_Inline_CSS();

	// Sub in a `gutenberg` and `type` to fetch output.
	$controls = array_merge(
		bigbox_get_theme_colors(),
		[
			'gutenberg' => [],
			'type'      => [],
		]
	);

	foreach ( $controls as $key => $data ) {
		$file = get_template_directory() . '/app/customize/output/' . $key . '.php';

		if ( ! file_exists( $file ) ) {
			continue;
		}

		$config = include $file;

		/**
		 * Filter the inline CSS configuration for each control.
		 *
		 * @since 1.11.0
		 *
		 * @param array $data CSS configuration data.
		 */
		$config = apply_filters( 'bigbox_customize_inline_css_' . $key, $config );

		foreach ( $config as $data ) {
			$css->add( $data );
		}
	}

	/**
	 * Allow appending more CSS to the inline output.
	 *
	 * @since 1.0.0
	 *
	 * @param BigBox\Customize\Build_Inline_CSS $css CSS object to handle building inline output.
	 */
	do_action( 'bigbox_customize_inline_css', $css );

	return $css->build();
}
