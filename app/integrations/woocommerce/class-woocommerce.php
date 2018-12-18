<?php
/**
 * WooCommerce integration.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Integration
 * @author Spencer Finnell
 */

namespace BigBox\Integration;

use BigBox\Integration;
use BigBox\Registerable;
use BigBox\Service;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WooCommerce.
 *
 * @since 1.0.0
 */
class WooCommerce extends Integration implements Registerable, Service {

	/**
	 * Additional inline CSS configuration items.
	 *
	 * @var array $inline_css_configs
	 * @since 1.16.0
	 */
	protected $inline_css_configs = [
		'store-notice',
	];

	/**
	 * Connect to WordPress.
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_filter( 'bigbox_customize_inline_css_configs', [ $this, 'inline_css_configs' ] );
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );

		include_once $this->get_dir() . '/wc-template-functions.php';

		include_once $this->get_dir() . '/starter-content.php';
		include_once $this->get_dir() . '/cart.php';
		include_once $this->get_dir() . '/checkout.php';
		include_once $this->get_dir() . '/account.php';
		include_once $this->get_dir() . '/widgets.php';
		include_once $this->get_dir() . '/emails.php';
		include_once $this->get_dir() . '/nav-menus.php';
		include_once $this->get_dir() . '/page-templates.php';
		include_once $this->get_dir() . '/customize.php';

		include_once $this->get_dir() . '/template-functions.php';
		include_once $this->get_dir() . '/template-hooks.php';
	}

	/**
	 * Add theme support.
	 *
	 * @since 1.0.0
	 */
	public function add_theme_support() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		$wc_theme_support = [
			'gallery_thumbnail_image_width' => 150,
			'product_grid'                  => [
				'default_columns' => 5,
				'min_columns'     => 1,
				'max_columns'     => 6,
			],
		];

		/**
		 * Filters WooCommerce theme support arguments.
		 *
		 * @since 1.0.0
		 *
		 * @param array $support The theme's specific settings.
		 */
		$wc_theme_support = apply_filters( 'bigbox_woocommerce_theme_support', $wc_theme_support );

		add_theme_support(
			'woocommerce',
			$wc_theme_support
		);
	}
}
