<?php
/**
 * Review breakdown.
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
?>

<h3>
<?php
echo esc_html( sprintf( __( '%1$s out of 5 stars', 'bigbox' ), number_format( $product->get_average_rating(), 1 ) ) );

?></h3>

<div class="review-breakdown">
	<?php
	for ( $i = 1; $i <= 5; $i++ ) :
		$percent = round( ( $product->get_rating_count( $i ) / $product->get_review_count() ) * 100 );
	?>
	<div class="review-breakdown__item">
		<div class="review-breakdown__label">
		<?php
		// Translators: %1$d Number of stars 
		printf( _n( '%1$d Star', '%1$d Stars', $i, 'bigbox' ), $i );
		?>
		</div>

		<div class="review-breakdown__count" >
			<span class="review-breakdown__count-label"><?php echo esc_html( $percent ); ?>%</span>
			<span class="review-breakdown__count-bar" style="width: <?php echo esc_attr( $percent ); ?>%"></span>
		</div>
	</div>
	<?php endfor; ?>
</div>
