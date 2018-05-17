<?php
/**
 * Searching in the nav bar.
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

if ( ! bigbox_is_integration_active( 'woocommerce' ) ) :
	return;
endif;
?>

<form id="primary-search" action="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" method="GET" class="navbar-search">

	<?php
	$taxonomy = get_taxonomy( bigbox_get_navbar_search_source( 'dropdown', 'product_cat' ) );

	if ( $taxonomy ) :
		$selected = isset( $_GET[ $taxonomy->name ] ) ? esc_attr( $_GET[ $taxonomy->name ] ) : null; // @codingStandardsIgnoreLine

		// Translators: %s Header search taxonomy label.
		$all = esc_html( sprintf( __( 'All %s', 'bigbox' ), strtolower( $taxonomy->labels->name ) ) );
	?>

	<div id="navbar-search__category" class="navbar-search__category">
		<label for="<?php echo esc_attr( $taxonomy->name ); ?>" class="screen-reader-text">
			<?php
			// Translators: %s Header search taxonomy name.
			echo esc_html( sprintf( __( 'Choose a %s', 'bigbox' ), strtolower( $taxonomy->labels->singular_name ) ) );
			?>
			:
		</label>

		<div id="search-dropdown-real">
			<?php
			wp_dropdown_categories(
				apply_filters(
					'bigbox_navbar_search_dropdown', [
						'show_option_all' => $all,
						'selected'        => $selected,
						'name'            => $taxonomy->name,
						'taxonomy'        => $taxonomy->name,
						'hierarchical'    => true,
						'value_field'     => 'slug',
						'show_count'      => true,
						'orderby'         => 'name',
						'order'           => 'ASC',
					]
				)
			);
			?>
		</div>

		<select id="search-dropdown-placeholder">
			<?php echo '<option>' . ( $selected ? $selected : $all ) . '</option>'; // WPCS: XSS okay. ?>
		</select>
	</div>

	<?php endif; ?>

	<div class="navbar-search__keywords">
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Find a product:', 'bigbox' ); ?></label>
		<input type="search" id="s" name="s" class="form-input" placeholder="<?php esc_html_e( 'Find a product...', 'bigbox' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
	</div>

	<div class="navbar-search__submit">
		<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'bigbox' ); ?>">
			<?php bigbox_svg( 'search' ); ?>
		</button>

		<input type="hidden" name="post_type" value="product" />
	</div>

</form>
