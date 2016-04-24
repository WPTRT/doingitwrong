<style>
	.section.testimonials {
		clear: both;
	}
	
	.testimonial.one-third {
		float: left;
		width: 33%;
		padding-right: 3%;
	}
	.testimonials:before,
	.testimonials:after {
		content: "";
		display: table;
	}
	.testimonials:after {
		clear: both;
	}
</style>
<?php 
/**
 * Testimonials for our theme
 */

# create some default just in case they don't have any
$default = array(
	'Marshall' => array(
		'photo' => 'person-1.jpg',
		'content' => 'The best I can give you is a fake smile and dead eyes!'
	),
	'Robin' => array(
		'photo' => 'person-2.jpg',
		'content' => 'I wound up shame-eating the whole pizza. I woke up all greasy and sweaty. My sheets looked like what they wrap Deli sandwiches in!'
	),
	'Ted' => array(
		'photo' => 'person-3.jpg',
		'content' => 'Because sometimes even if you know how something\'s gonna end that doesn\'t mean you can\'t enjoy the ride.!'
	),
	
);

# get our testimonial content to test later on
$testimonials = get_theme_mod( 'testimonial_text_1' ) || get_theme_mod( 'testimonial_image_1' ) || get_theme_mod( 'testimonial_name_1' ) ||
	get_theme_mod( 'testimonial_text_2' ) || get_theme_mod( 'testimonial_image_2' ) || get_theme_mod( 'testimonial_name_2' ) ||
	get_theme_mod( 'testimonial_text_3' ) || get_theme_mod( 'testimonial_image_3' ) || get_theme_mod( 'testimonial_name_3' );

# begin our testimonial markup
echo '<div class="section testimonials">';
echo '<h1>See what other have to say</h1>';
# test if we have any
if ( $testimonials ):

$testimonials = array( 
	1 => array(
		get_theme_mod( 'testimonial_name_1' ),
		get_theme_mod( 'testimonial_image_1' ),
		get_theme_mod( 'testimonial_text_1' ),
		), 
	2 => array(
		get_theme_mod( 'testimonial_name_2' ),
		get_theme_mod( 'testimonial_image_2' ),
		get_theme_mod( 'testimonial_text_2' ),
		),
	3 => array(
		get_theme_mod( 'testimonial_name_3' ),
		get_theme_mod( 'testimonial_image_3' ),
		get_theme_mod( 'testimonial_text_3' ),
	),
);

foreach ( $testimonials as $key => $testimonial ) {
	echo '<div class="testimonial one-third">';
	echo '<h2 class="person">' . $testmonial[0] . '</h2>';
	echo '<img src="' . $testimonial[1] . '"/>';
	echo '<div class="testimonial-content">';
	echo wpautop( $testimonial[2] );
	echo '</div>';
	echo '</div>';
}

else: # we don't have any testimonials
	foreach( $default as $person => $words ){
		echo '<div class="testimonial one-third">';
		echo '<h2 class="person">' . $person . '</h2>';
		echo '<div class="testimonial-content">';
		echo '<img src="' . get_template_directory_uri() . '/img/' . $words[ 'photo' ] . '"/>';
		echo wpautop( $words[ 'content' ] );
		echo '</div>';
		echo '</div>';
	}

endif; # done testing for testimonials
echo '</div>';
