<?php
/**
 * FacetWP template hooks.
 *
 * @since 1.0.0
 *
 * @package BigBox
 * @category Integration
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * @see woocommerce/templates/archive-product.php.
 */

// Add pagination.
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination' );
add_action( 'woocommerce_after_shop_loop', 'bigbox_facetwp_pagination' );

add_filter( 'facetwp_pager_html', 'bigbox_facetwp_pagination_output', 10, 2 );

// Replace WooCommerce's "Results Showing" and sorting options.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop', 'bigbox_facetwp_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'bigbox_facetwp_catalog_ordering', 30 );

add_filter( 'facetwp_result_count', 'bigbox_facetwp_result_count_output', 10, 2 );
