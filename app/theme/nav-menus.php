<?php
/**
 * WordPress navigation menus.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Menu
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register navigation menu areas.
 *
 * @since 1.0.0
 */
function bigbox_register_nav_menus() {
	$navs = [
		/* translators: Navigation menu name. */
		'primary'   => __( 'Primary', 'bigbox' ),
		/* translators: Navigation menu name. */
		'secondary' => __( 'Secondary', 'bigbox' ),
	];

	/**
	 * Filter registered nav menus to be passed to `register_nav_menus()`.
	 *
	 * @since 1.0.0
	 *
	 * @param array $navs Nav menus to register.
	 */
	$navs = apply_filters( 'bigbox_register_nav_menus', $navs );

	register_nav_menus( $navs );
}
add_action( 'after_setup_theme', 'bigbox_register_nav_menus' );

/**
 * Get primmary nav menus.
 *
 * @since 1.0.0
 *
 * @param array $args Menu arguments.
 * @return string
 */
function bigbox_get_primary_nav_menus( $args = [] ) {
	$menus = wp_cache_get( 'bigbox_get_primary_nav_menus', 'bigbox' );

	if ( false === $menus ) {
		wp_enqueue_script( 'hoverIntent' );

		ob_start();

		wp_nav_menu(
			[
				'theme_location' => 'primary',
				'menu_class'     => 'navbar-menu__items navbar-menu__items-primary',
				'container'      => false,
				'fallback_cb'    => false,
			]
		);

		wp_nav_menu(
			[
				'theme_location' => 'secondary',
				'menu_class'     => 'navbar-menu__items navbar-menu__items-secondary',
				'container'      => false,
				'fallback_cb'    => false,
			]
		);

		$menus = ob_get_clean();

		wp_cache_set( 'bigbox_get_primary_nav_menus', $menus, 'bigbox' );
	}

	return $menus;
}
