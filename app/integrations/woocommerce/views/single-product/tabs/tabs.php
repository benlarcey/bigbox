<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	
	<div class="woocommerce-single-product-data">

	<?php
		foreach ( $tabs as $key => $tab ) :
			if ( isset( $tab['callback'] ) ) :
				ob_start();
				call_user_func( $tab['callback'], $key, $tab );

				$content = trim( ob_get_clean() );

				if ( '' !== $content ) :
		?>

			<div class="woocommerce-single-product-data__section" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php echo $content; ?>
			</div>

		<?php
				endif;
			endif;
		endforeach;
		?>

	</div>

<?php endif; ?>
