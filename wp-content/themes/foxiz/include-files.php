<?php
/** Don't load directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$foxiz_file_paths = [
	'backend/class-tgm-plugin-activation',
	'backend/install-plugins',
	'backend/configs',
	'backend/theme-options',
	'backend/tax-settings',
	'backend/single-metaboxes',
	'backend/actions',
	'backend/mega-menu',

	'includes/fallbacks',
	'includes/helpers',
	'personalize/personalize',
	'personalize/template-helpers',
	'personalize/reading-list',
	'includes/sidebars',
	'includes/menu',
	'includes/actions',
	'includes/query',
	'includes/css',
	'includes/fonts',
	'includes/woocommerce',
	'podcast/init',

	/** templates */
	'templates/template-helpers',
	'templates/parts',
	'templates/entry',
	'templates/popup',
	'templates/blog',
	'templates/page',
	'templates/ajax',

	'templates/header/templates',
	'templates/header/layouts',
	'templates/header/transparent',
	'templates/footer',

	'templates/single/templates',
	'templates/single/reviews',
	'templates/single/layouts',
	'templates/single/footer',
	'templates/single/related',
	'templates/single/attachment',
	'templates/single/standard-1',
	'templates/single/standard-2',
	'templates/single/standard-3',
	'templates/single/standard-4',
	'templates/single/standard-5',
	'templates/single/standard-6',
	'templates/single/standard-7',
	'templates/single/standard-8',
	'templates/single/standard-9',
	'templates/single/standard-10',
	'templates/single/standard-11',
	'templates/single/video-1',
	'templates/single/video-2',
	'templates/single/video-3',
	'templates/single/video-4',
	'templates/single/audio-1',
	'templates/single/audio-2',
	'templates/single/audio-3',
	'templates/single/audio-4',
	'templates/single/gallery-1',
	'templates/single/gallery-2',
	'templates/single/gallery-3',

	'templates/modules/classic',
	'templates/modules/grid',
	'templates/modules/list',
	'templates/modules/overlay',
	'templates/modules/category',
	'templates/modules/author',

	'templates/blocks/heading',
	'templates/blocks/classic-1',
	'templates/blocks/grid-1',
	'templates/blocks/grid-2',
	'templates/blocks/grid-small-1',
	'templates/blocks/grid-box-1',
	'templates/blocks/grid-box-2',
	'templates/blocks/grid-flex-1',
	'templates/blocks/grid-flex-2',
	'templates/blocks/grid-personalize-1',
	'templates/blocks/grid-personalize-2',
	'templates/blocks/list-1',
	'templates/blocks/list-2',
	'templates/blocks/list-box-1',
	'templates/blocks/list-box-2',
	'templates/blocks/list-small-1',
	'templates/blocks/list-small-2',
	'templates/blocks/list-small-3',
	'templates/blocks/list-flex',
	'templates/blocks/list-personalize',
	'templates/blocks/hierarchical-1',
	'templates/blocks/hierarchical-2',
	'templates/blocks/hierarchical-3',
	'templates/blocks/overlay-1',
	'templates/blocks/overlay-2',
	'templates/blocks/overlay-flex',
	'templates/blocks/overlay-personalize',
	'templates/blocks/playlist',
	'templates/blocks/quick-links',
	'templates/blocks/breaking-news',
	'templates/blocks/categories',
	'templates/blocks/authors',
	'templates/blocks/newsletter',
	'templates/blocks/gallery',
	'templates/blocks/product-grid',
	'templates/blocks/tax-accordion',
];

foreach ( $foxiz_file_paths as $file_path ) {
	$file = get_theme_file_path( $file_path . '.php' );
	if ( file_exists( $file ) ) {
		include_once $file;
	}
}