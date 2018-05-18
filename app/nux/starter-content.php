<?php
/**
 * Starter content.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category NUX
 * @author Spencer Finnell
 */

/**
 * Starter content.
 *
 * @since 1.0.0
 */
function bigbox_add_starter_content() {
	add_theme_support( 'starter-content', bigbox_get_starter_content() );
}
add_action( 'after_setup_theme', 'bigbox_add_starter_content' );

/**
 * Get starter content.
 *
 * @since 1.0.0
 *
 * @return array
 */
function bigbox_get_starter_content() {
	/**
	 * Filters starter content used for fresh installs.
	 *
	 * @since 1.0.0
	 *
	 * @param array $content The base content that does not plugins.
	 */
	return apply_filters( 'bigbox_get_starter_content', [
		'posts'     => [
			'home' => [],
			'blog' => [],
		],

		// Default to a static front page and assign the front and posts pages.
		'options'   => [
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		],

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => [
			'primary' => [
				'name'  => 'Primary',
				'items' => [
					'page_home',
				],
			],
			'secondary' => [
				'name'  => 'secondary',
				'items' => [
					'page_blog',
				],
			],
		],
	] );
}
