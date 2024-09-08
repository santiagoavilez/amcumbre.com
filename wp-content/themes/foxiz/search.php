<?php
/** header */
get_header();
$foxiz_settings = foxiz_get_search_page_settings();
foxiz_search_page_header( $foxiz_settings );
if ( have_posts() ) {
	foxiz_the_blog( $foxiz_settings );
} else {
	foxiz_search_empty();
}

/** footer */
get_footer();