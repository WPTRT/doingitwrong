<style>
	.bx-wrapper{
		padding: 60px 0;
	}
	.bxslider .slide {
		width: 80%;
	}
	.bxslider .bx-controls-direction {
		clear: both;
		overflow: hidden;
	}
	.bx-prev {
		float: left;
	}
	.bx-next {
		float: right;
	}
</style>
<?php  // slider_css

/**
 * Slider template used for front-page
 */
$featured = query_posts( array( 'tag' => 'featured' ) );

# we begin our slider markup
echo '<ul id="my-slider" class="bxslider">';

# let's check if we have any posts to cycle through
if ( !empty( $featured ) ):
	foreach( $featured as $feature ){
		echo 'listing';
		echo 'listing';
		setup_postdata( $feature );
		$link = esc_url( get_permalink( $feature->ID ) );
		$cont = '<span class="featured-link"><a href="' . $link . '">Read: ' . $feature->post_title . '</a></span>';
		$postinfo = '<h3 class="featured-post">' . $featured->post_title . '</h3><div class="featured-content"><p>' . get_the_excerpt() . '</p></div>' . $cont ;
		printf( '<li><div class="slide">%s</div></li>\n', $postinfo );
	}

	wp_reset_query();
	$featured = (int) count( query_posts( array( 'tag' => 'featured' ) ) );

else:
	$default = array( 'Super Responsive Themes' => 'slide-1.jpg', 'Friendly support you can count on' => 'slide-2.jpg', 'Free updates for as long you have the theme' => 'slide-3.jpg' );
	foreach( $default as $slide => $image ) {
?>
		<li>
			<div class="slide">
			<span class="featured-link"><a href="<?php echo get_template_directory_uri() . '/images/' . $image; ?>"></a></span>
			<h3 class="featured-post"><?php echo $slide; ?></h3>
			<div class="featured-content">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore saepe, sed deleniti ducimus voluptas excepturi nam veniam praesentium, neque harum sapiente, ea, distinctio dolorem blanditiis modi sint cumque? Animi, dicta.</p>
				<span class="featured-link"><a href="#">Read more</a></span>
			</div>
			</div>
		</li>
<?php }
endif;

echo '</ul>';


// jQuery code begin for the slider ?>
<script>
( function( $ ){
	var slider = jQuery( '.bxslider' );
//	var slide = jQuery( 'div.slide' );
	// begin the slider
	slider.bxSlider({
		'infiniteLoop': false,
		'pagerType': 'short',
		'pagerShortSeparator': ' | ',
		'minSlides': <?php echo $featured; ?>,
		'slideMargin': 100,
		'maxSlides': <?php echo $featured; ?>,
	});
})( jQuery );
</script>
<?php  // end jQuery code