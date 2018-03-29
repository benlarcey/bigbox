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

/**
 * Build inline CSS.
 *
 * @since 1.0.0
 */
function bigbox_customize_css() {
	$css = new \BigBox\Theme\Customize\Inline_CSS();

	$config = include get_template_directory() . '/app/theme/customize/config-css.php';
	$scheme = include get_template_directory() . '/app/theme/customize/config-scheme.php';
	$grays  = include get_template_directory() . '/app/theme/customize/config-grays.php';

	$defaults = array_merge( $scheme, $grays );

	foreach ( $config as $color => $data ) {
		$color = get_theme_mod( "color-${color}", $defaults[ $color ]['default'] );

		foreach ( $data as $declaration => $selectors ) {
			$css->add( [
				'selectors'    => $selectors,
				'declarations' => [ 
					$declaration => esc_attr( $color ),
				],
			] );
		}
	}

	return $css->build();
}

/**
 * Enqueue customizer scripts.
 *
 * @since 1.0.0
 */
function bigbox_customize_preview_init() {
	wp_enqueue_script(
		'bigbox-customize-preview',
		get_template_directory_uri() . '/public/js/customize-preview.min.js',
		[ 'customize-preview' ],
		bigbox_get_theme_version(),
		true
	);
}
add_action( 'customize_preview_init', 'bigbox_customize_preview_init', 99 );

/**
 * Return filtered inline CSS for live previews.
 *
 * @since 1.0.0
 *
 * @return array
 */
function bigbox_preview_css() {
	$customized = json_decode( wp_unslash( $_POST['customized'] ), true );

	// Filter `get_theme_mod()` calls for customized settings.
	foreach ( $customized as $setting_id => $value ) {
		add_filter(
			'theme_mod_' . sanitize_key( $setting_id ), function( $value ) {
				if ( isset( $customized[ $setting_id ] ) ) {
					return $customized[ $setting_id ];
				}

				return $value;
			}
		);
	}

	return wp_send_json_success( bigbox_customize_css() );
}
add_action( 'wp_ajax_bigbox-preview-css', 'bigbox_preview_css' );

/**
 * Adds postMessage support for site title and adds a note about description not being output.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function bigbox_customize_register( $wp_customize ) {
	// postMessage some settings.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'header_text' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Update title of Tagline.
	$wp_customize->get_control( 'blogdescription' )->description = esc_html__( 'Not output but used for SEO', 'bigbox' );

	// Update label of Header Text
	$wp_customize->get_control( 'header_text' )->label     = esc_html__( 'Display Site Title', 'bigbox' );

	// Update branding partial when Site Title or text changes.
	foreach ( [ 'blogname', 'header_text' ] as $setting ) {
		$wp_customize->selective_refresh->add_partial(
			$setting, [
				'selector'            => '.branding',
				'container_inclusive' => false,
				'render_callback'     => function() {
					bigbox_partial( 'branding' );
				}
			]
		);
	}
}
add_action( 'customize_register', 'bigbox_customize_register', 11 );

/**
 * Color controls.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function bigbox_customize_register_colors( $wp_customize ) {
	// Create panel.
	$wp_customize->add_panel(
		'colors', [
			'title'    => _x( 'Colors', 'customizer panel title', 'bigbox' ),
			'priority' => 25,
		]
	);

	// Create "Scheme" and "Grays" sections.
	$wp_customize->add_section(
		'colors-scheme', [
			'title'    => _x( 'Scheme', 'customizer section title (colors)', 'bigbox' ),
			'panel'    => 'colors',
			'priority' => 10,
		]
	);

	$wp_customize->add_section(
		'colors-grays', [
			'title'    => _x( 'Grays', 'customizer section title (colors)', 'bigbox' ),
			'panel'    => 'colors',
			'priority' => 20,
		]
	);

	// Add colors.
	$scheme   = include get_template_directory() . '/app/theme/customize/config-scheme.php';
	$grays    = include get_template_directory() . '/app/theme/customize/config-grays.php';
	$controls = compact( 'scheme', 'grays' );

	foreach ( $controls as $section => $colors ) {

		foreach ( $colors as $theme_color => $color ) {
			$key = "color-${theme_color}";

			$wp_customize->add_setting(
				$key, [
					'default'           => $color['default'],
					'transport'         => 'postMessage',
					'sanitize_callback' => 'sanitize_hex_color',
				]
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$key,
					[	
						'label'    => $color['label'],
						'section'  => 'colors-' . $section,
					]
				)
			);
		}

	}
}
add_action( 'customize_register', 'bigbox_customize_register_colors', 11 );
