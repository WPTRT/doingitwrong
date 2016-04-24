<?php
/**
 * Front page template for theme
 * 
 * All themes have to follow core's template hierarchy:
 * See: https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */
get_header();

	get_template_part( 'slider' );
	get_template_part( 'section', 'testimonials' );
	wp_reset_query();
	get_template_part( 'index', 'home' );

get_footer();