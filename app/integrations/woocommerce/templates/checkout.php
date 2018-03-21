<?php
/**
 * Template Name: Checkout
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

bigbox_view( 'global/header-min' );

while ( have_posts() ) :
	the_post();
?>

<div id="main" class="site-primary" role="main">
	<h1 class="page-title"><?php the_title(); ?></h1>

	<div class="hentry">
		<?php the_content(); ?>
	</div>
</div>

<?php
endwhile;

bigbox_view( 'global/footer-min' );