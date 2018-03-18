<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ( $product->is_on_sale() ) :
	if ( 'simple' === $product->get_type() ) :
		$percentage = round( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() * 100 );
		$flash      = sprintf( esc_html__( 'Save %1$s%%', 'bigbox' ), $percentage );
	else :
		$flash = esc_html__( 'Sale!', 'bigbox' );
	endif;
?>

<div class="product__sale">
	<a href="<?php echo esc_url( apply_filters( 'woocommerce_loop_product_link', $product->get_permalink(), $product ) ); ?>">
		<?php
		// Translators: %1$s Sale price percentage.
		echo apply_filters( 'woocommerce_sale_flash', $flash, $post, $product );
		?>
	</a>
</div>

<?php
endif;
