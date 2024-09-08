<?php
/** Don't load directly */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'foxiz_render_single_standard_11' ) ) {
	function foxiz_render_single_standard_11() {

		$classes          = [ 'single-standard-1 single-standard-11' ];
		$sidebar_name     = foxiz_get_single_setting( 'sidebar_name' );
		$sidebar_position = foxiz_get_single_sidebar_position();
		$crop_size        = foxiz_get_single_crop_size( '2048x2048' );

		if ( 'none' === $sidebar_position ) {
			$sidebar_name = false;
		}
		if ( empty( $sidebar_name ) || ! is_active_sidebar( $sidebar_name ) ) {
			$classes[] = 'without-sidebar';
		} else {
			$classes[] = 'is-sidebar-' . $sidebar_position;
			$classes[] = foxiz_get_single_sticky_sidebar();
		}
		if ( foxiz_get_option( 'single_11_ratio' ) ) {
			$classes[] = 'has-feat-ratio';
		} ?>
		<div class="<?php echo join( ' ', $classes ); ?>">
			<div class="rb-container edge-padding">
				<?php foxiz_single_open_tag(); ?>
				<header class="single-header">
					<?php
					foxiz_single_breadcrumb();
					foxiz_single_entry_category();
					foxiz_single_title( 'fw-headline' );
					foxiz_single_tagline( 'fw-tagline' );
					?>
					<div class="s-feat-outer">
						<?php
						foxiz_single_standard_featured( $crop_size );
						foxiz_single_featured_caption(); ?>
					</div>
					<?php foxiz_single_header_meta(); ?>
				</header>
				<div class="grid-container">
					<div class="s-ct">
						<?php
						foxiz_single_content();
						foxiz_single_author_box();
						foxiz_single_next_prev();
						foxiz_single_comment();
						?>
					</div>
					<?php foxiz_single_sidebar( $sidebar_name ); ?>
				</div>
				<?php
				foxiz_single_close_tag();
				foxiz_single_footer();
				?>
			</div>
		</div>
		<?php
	}
}