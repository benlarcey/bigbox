<?php
/**
 * Footer navigation.
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

$count = bigbox_get_footer_nav_columns();
ob_start();

for ( $i = 1; $i <= $count; $i++ ) :
	$sidebar = bigbox_get_cached_sidebar( 'footer-' . $i );

	if ( $sidebar ) :
		echo '<div class="footer-nav__col">';
		echo $sidebar; // WPCS: XSS okay.
		echo '</div>';
	endif;
endfor;

$widgets = trim( ob_get_clean() );

if ( '' === $widgets ) :
	return;
endif;
?>

<div class="footer-nav">
	<div class="container">
		<div class="footer-nav__row footer-nav__columns-<?php echo esc_attr( $count ); ?>">

			<?php echo $widgets; // WPCS: XSS okay. ?>

		</div>
	</div>
</div>
