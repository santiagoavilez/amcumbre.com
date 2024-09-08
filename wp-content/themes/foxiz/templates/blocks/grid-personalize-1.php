<?php
/** Don't load directly */
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'foxiz_get_grid_personalize_1' ) ) {
	/**
	 * @param array $settings
	 * @param null  $_query
	 *
	 * @return false|string
	 */
	function foxiz_get_grid_personalize_1( $settings = [], $_query = null ) {

		if ( foxiz_is_amp() ) {
			return false;
		}

		$settings = wp_parse_args( $settings, [
			'uuid' => '',
			'name' => 'grid_personalize_1',
		] );

		$settings['classes'] = 'block-grid block-grid-personalize-1';

		if ( empty( $settings['display_mode'] ) ) {
			$settings['classes'] .= ' is-ajax-block';
		}

		if ( empty( $settings['content_source'] ) ) {
			$settings['content_source'] = 'recommended';
		}

		if ( empty( $settings['columns'] ) ) {
			$settings['columns'] = 3;
		}
		if ( empty( $settings['column_gap'] ) ) {
			$settings['column_gap'] = 20;
		}

		if ( ! empty( $settings['box_style'] ) ) {
			if ( ! empty( $settings['block_structure'] ) ) {

				$structure = explode( ',', preg_replace( '/\s+/', '', $settings['block_structure'] ) );
				if ( 'thumbnail' === $structure[0] ) {
					$settings['classes'] .= ' first-featured';
				} elseif ( 'thumbnail' === $structure[ count( $structure ) - 1 ] ) {
					$settings['classes'] .= ' last-featured';
				} else {
					$settings['classes'] .= ' featured-wo-round';
				}
			} else {
				$settings['classes'] .= ' first-featured';
			}
		}

		if ( empty( $settings['pagination'] ) ) {
			$settings['no_found_rows'] = true;
		}

		$settings = foxiz_get_design_builder_block( $settings );

		$is_recommended = ! empty( $settings['content_source'] ) && 'recommended' === $settings['content_source'];
		if ( $is_recommended && ! empty( $GLOBALS['foxiz_queried_ids'] ) && is_array( $GLOBALS['foxiz_queried_ids'] ) ) {
			$settings['post_not_in'] = implode( ',', $GLOBALS['foxiz_queried_ids'] );
		}

		/** ajax mode */
		if ( empty( $settings['display_mode'] ) ) {
			$settings['live_block'] = 1;
			foxiz_live_block_localize( $settings );
		}

		ob_start();
		foxiz_block_open_tag( $settings, $_query );
		if ( class_exists( 'Elementor\\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			foxiz_live_block_grid_personalize_1( $settings );
		} else {
			if ( empty( $settings['display_mode'] ) ) {
				echo '<div class="block-loader">' . foxiz_get_svg( 'loading', '', 'animation' ) . '</div>';
			} else {
				foxiz_live_block_grid_personalize_1( $settings );
			}
		}
		foxiz_block_close_tag();

		return ob_get_clean();
	}
}

if ( ! function_exists( 'foxiz_live_block_grid_personalize_1' ) ) {
	/**
	 * @param array $settings
	 *
	 * @return false|string
	 */
	function foxiz_live_block_grid_personalize_1( $settings = [] ) {

		if ( ! is_user_logged_in() && 'saved' == $settings['content_source'] && ! empty( foxiz_get_option( 'bookmark_enable_when' ) ) ) {
			foxiz_saved_restrict_info();

			return false;
		}

		$_query = foxiz_personalize_query( $settings );
		if ( empty( $_query ) || ! $_query->have_posts() ) {
			if ( ! empty( $settings['content_source'] ) ) {
				if ( 'saved' == $settings['content_source'] ) {
					foxiz_saved_empty();
				} elseif ( 'history' === $settings['content_source'] ) {
					foxiz_reading_history_empty();
				}
			} else {
				foxiz_error_posts( $_query );
			}
		} else {
			foxiz_block_inner_open_tag( $settings );
			foxiz_loop_grid_personalize_1( $settings, $_query );
			foxiz_block_inner_close_tag( $settings );
			foxiz_render_pagination( $settings, $_query );
			wp_reset_postdata();
		}
	}
}

if ( ! function_exists( 'foxiz_loop_grid_personalize_1' ) ) {
	/**
	 * @param  $settings
	 * @param  $_query
	 */
	function foxiz_loop_grid_personalize_1( $settings, $_query ) {

		if ( empty( $settings['block_structure'] ) ) {
			$settings['block_structure'] = 'thumbnail,title,meta';
		}
		$settings['block_structure'] = explode( ',', preg_replace( '/\s+/', '', $settings['block_structure'] ) );
		while ( $_query->have_posts() ) :
			$_query->the_post();
			foxiz_grid_flex_1( $settings );
		endwhile;
	}
}


