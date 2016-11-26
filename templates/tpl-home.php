<?php
/**
 * Template Name: Blog
 * The template for displaying blog-like listing pages
 *
 * @package WordPress
 */
get_header();

$query = new WP_Query( array( ''));
?>
<div class="container">
	<div class="row">
		<?php if ( $query->have_posts() ){
			while( $query->have_posts() ) { $query->the_post();
				get_template_part( 'content', get_post_format() );
			}
			wrong_paging_nav();
		} ?>
	</div>
</div>
<?php get_footer();
