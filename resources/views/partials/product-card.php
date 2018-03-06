<?php
/**
 * Product card.
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 * @package BigBox
 * @category Theme
 * @author Spencer Finnell
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="product-card">
	<div class="product-card__preview">
		<a href="#">
			<img src="https://images-na.ssl-images-amazon.com/images/I/41NoqeaXK6L.jpg" alt="" />
		</a>
	</div>

	<div class="product-card__description">
		<h2 class="product-card__title">
			<a href="#">Certified Refurbished Vitamix 5200 Blender, Black</a>
		</h2>

		<div class="product-card__shipping">Ships in 4-7 days</div>

		<div class="product-card__sale">
			<a href="#">Save 40%</a>
		</div>

		<div class="product-card__stats m-0">
			<div class="product-card__price price">
				<a href="#">
					<ins><sup>$</sup>499<sup>99</sup></ins>
					<del><sup>$</sup>699<sup>99</sup></del>
				</a>
			</div>
		</div>

		<div class="product-card__stats">
			<div class="star-rating product-card__rating">
				<span class="star-rating__stars">
					<?php
					bigbox_svg( 'star' );
					bigbox_svg( 'star' );
					bigbox_svg( 'star' );
					bigbox_svg( 'star' );
					bigbox_svg( 'star' );
					?>
				</span>
				
				<span class="star-rating__count">58</span>
			</div>
		</div>
	</div>
</div>
