<?php
/**
 * Front page template for theme
 * 
 * All themes have to follow core's template hierarchy:
 * See: https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */
get_header();

if ( get_option( 'show_on_front' ) == 'posts' ){
	load_template( get_home_template() );
} else {
	get_template_part( 'slider' );
	get_template_part( 'content', 'page' );
}

get_footer();