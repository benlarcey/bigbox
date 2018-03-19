<?php
/**
 * Global page footer.
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

			</div>
		</div>

		<?php
		bigbox_partial( 'footer-nav' );
		bigbox_partial( 'footer-copyright' );

		wp_footer();
		?>

	</body>
</html>
