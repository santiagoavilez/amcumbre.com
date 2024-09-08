<?php
/** Don't load directly */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'foxiz_single_page' ) ) {
	function foxiz_single_page() {

		$page_id = get_the_ID();

		$classes          = [ 'single-page' ];
		$header_style     = foxiz_get_page_header_style( $page_id );
		$sidebar_name     = foxiz_get_single_setting( 'sidebar_name', 'page_sidebar_name', $page_id );
		$sidebar_position = foxiz_get_single_sidebar_position( 'sidebar_position', 'page_sidebar_position', $page_id );
		$content_classes  = 'rb-container edge-padding';

		if ( 'none' === $sidebar_position ) {
			$sidebar_name = false;
		}
		if ( '-1' === (string) $header_style ) {
			$classes[] = 'none-header';
		}
		if ( empty( $sidebar_name ) || ! is_active_sidebar( $sidebar_name ) ) {
			$classes[] = 'without-sidebar';
			if ( foxiz_get_page_content_width() ) {
				$content_classes = 'rb-small-container edge-padding';
			}
		} else {
			$classes[] = 'is-sidebar-' . $sidebar_position;
			$classes[] = foxiz_get_single_sticky_sidebar( 'page' );
		}
		if ( foxiz_is_wc_pages() ) {
			$content_classes = 'rb-container edge-padding';
		}
		?>
		<div class="<?php echo join( ' ', $classes ); ?>">
			<?php if ( function_exists( 'foxiz_page_header_' . $header_style ) ) {
				call_user_func( 'foxiz_page_header_' . $header_style );
			} ?>
			<div class="<?php echo esc_attr( $content_classes ); ?>">
				<div class="grid-container">
					<div class="s-ct">
						<?php
						foxiz_single_simple_content();
						foxiz_single_comment();
						?>
					</div>
					<?php foxiz_single_sidebar( $sidebar_name ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'foxiz_page_header_1' ) ) {
	function foxiz_page_header_1() {

		$classes = 'page-header page-header-1 edge-padding';
		if ( ! foxiz_is_sw_header() ) {
			$classes .= ' rb-container';
		} else {
			$classes .= ' rb-small-container';
		} ?>
		<header class="<?php echo esc_attr( $classes ); ?>">
			<?php
			foxiz_single_page_breadcrumb();
			foxiz_single_title();
			?>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="page-featured"><?php the_post_thumbnail( 'foxiz_crop_o2', [ 'class' => 'featured-img' ] ); ?></div>
			<?php endif; ?>
		</header>
	<?php }
}

if ( ! function_exists( 'foxiz_page_header_2' ) ) {
	function foxiz_page_header_2() {

		if ( ! foxiz_is_sw_header() ) {
			$classes = 'rb-container edge-padding';
		} else {
			$classes = 'rb-small-container edge-padding';
		} ?>
		<header class="page-header page-header-2">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="page-featured-overlay"><?php the_post_thumbnail( '2048×2048', [ 'class' => 'featured-img' ] ); ?></div>
			<?php endif; ?>
			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="page-header-inner light-scheme">
					<?php
					foxiz_single_title();
					foxiz_single_page_breadcrumb();
					?>
				</div>
			</div>
		</header>
	<?php }
}

if ( ! function_exists( 'foxiz_page_header_3' ) ) {
	function foxiz_page_header_3() {

		if ( ! foxiz_is_sw_header() ) {
			$classes = 'rb-container edge-padding';
		} else {
			$classes = 'rb-small-container edge-padding';
		} ?>
		<header class="page-header page-header-2 is-centered">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="page-featured-overlay"><?php the_post_thumbnail( '2048×2048', [ 'class' => 'featured-img' ] ); ?></div>
			<?php endif; ?>
			<div class="<?php echo esc_attr( $classes ); ?>">
				<div class="page-header-inner light-scheme">
					<?php
					foxiz_single_title();
					foxiz_single_page_breadcrumb();
					?>
				</div>
			</div>
		</header>
	<?php }
}

if ( ! function_exists( 'foxiz_page_header_4' ) ) {
	function foxiz_page_header_4() {

		if ( ! has_post_thumbnail() ) {
			foxiz_page_header_1();

			return false;
		}

		$classes = 'page-header-inner light-scheme';
		if ( ! foxiz_is_sw_header() ) {
			$classes .= ' rb-container';
		} else {
			$classes .= ' rb-small-container';
		} ?>
		<header class="page-header page-header-4 edge-padding rb-container">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="page-featured">
					<?php the_post_thumbnail( 'foxiz_crop_o2', [ 'class' => 'featured-img' ] ); ?>
					<div class="single-header-overlay">
						<div class="<?php echo esc_attr( $classes ); ?>">
							<?php
							foxiz_single_title();
							foxiz_single_page_breadcrumb();
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</header>
	<?php }
}

if ( ! function_exists( 'foxiz_page_404' ) ) {
	/**
	 * 404 page
	 */
	function foxiz_page_404() {

		$featured           = foxiz_get_option( 'page_404_featured' );
		$dark_featured      = foxiz_get_option( 'page_404_dark_featured' );
		$heading            = foxiz_get_option( 'page_404_heading' );
		$description        = foxiz_get_option( 'page_404_description' );
		$search             = foxiz_get_option( 'page_404_search' );
		$template           = foxiz_get_option( 'page_404_template' );
		$template_w_content = foxiz_get_option( 'page_404_template_w_content' );

		if ( ! empty( $template ) && empty( $template_w_content ) ) {
			foxiz_blog_template( $template );

			return false;
		}

		$class_name = 'page404-wrap rb-container edge-padding';
		if ( ! empty( $template ) ) {
			$class_name .= ' has-404-template';
		}

		if ( empty( $heading ) ) {
			$heading = foxiz_html__( 'Something\'s wrong here...', 'foxiz' );
		}
		if ( empty( $description ) ) {
			$description = foxiz_html__( 'It looks like nothing was found at this location. The page you were looking for does not exist or was loading incorrectly.', 'foxiz' );
		}
		?>
		<div class="<?php echo esc_attr( $class_name ); ?>">
			<div class="page404-inner">
				<?php if ( ! empty( $featured['url'] ) ) : ?>
					<div class="page404-featured">
						<?php if ( ! empty( $dark_featured['url'] ) ) : ?>
							<img data-mode="default" src="<?php echo esc_url( $featured['url'] ); ?>" alt="<?php echo esc_attr( $featured['alt'] ); ?>" height="<?php echo esc_attr( $featured['height'] ); ?>" width="<?php echo esc_attr( $featured['width'] ); ?>"/>
							<img data-mode="dark" src="<?php echo esc_url( $dark_featured['url'] ); ?>" alt="<?php echo esc_attr( $dark_featured['alt'] ); ?>" height="<?php echo esc_attr( $dark_featured['height'] ); ?>" width="<?php echo esc_attr( $dark_featured['width'] ); ?>"/>
						<?php else : ?>
							<img src="<?php echo esc_url( $featured['url'] ); ?>" alt="<?php echo esc_attr( $featured['alt'] ); ?>" height="<?php echo esc_attr( $featured['height'] ); ?>" width="<?php echo esc_attr( $featured['width'] ); ?>"/>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<h1 class="page-title"><?php echo esc_html( $heading ); ?></h1>
				<p class="page404-description"><?php echo esc_html( $description ); ?></p>
				<?php if ( ! empty( $search ) ) {
					get_search_form();
				} ?>
				<div class="page404-btn-wrap">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="page404-btn is-btn"><?php foxiz_html_e( 'Return to Homepage', 'foxiz' ); ?></a>
				</div>
			</div>
		</div>
		<?php
		if ( ! empty( $template ) ) {
			foxiz_blog_template( $template );
		}
	}
}

if ( ! function_exists( 'foxiz_single_page_breadcrumb' ) ) {
	/**
	 * foxiz_single_page_breadcrumb
	 */
	function foxiz_single_page_breadcrumb() {

		$setting = rb_get_meta( 'page_breadcrumb' );

		if ( ! empty( $setting ) && '-1' === (string) $setting ) {
			return false;
		}

		if ( foxiz_is_wc_pages() && function_exists( 'woocommerce_breadcrumb' ) ) {
			woocommerce_breadcrumb();
		} elseif ( foxiz_get_option( 'single_page_breadcrumb' ) ) {
			echo foxiz_get_breadcrumb( 'page-breadcrumb' );
		}
	}
}