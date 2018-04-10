<?php
/**
 * Template Name: Minimal
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

if ( ! isset( $columns ) ) {
	$columns = 10;
}

bigbox_view( 'global/header-min' );

while ( have_posts() ) :
	the_post();
?>

	<div id="main" class="site-primary site-primary--<?php echo esc_attr( $columns ); ?>" role="main">
	<h1 class="page-title"><?php the_title(); ?></h1>

	<article class="hentry">
		<?php the_content(); ?>
	</article>
</div>

<?php
endwhile;

bigbox_view( 'global/footer-min' );
