<?php
/**
 * wrong Theme Customizer
 *
 * @package wrong
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wrong_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Add settings
	$wp_customize->add_setting( 'max_width', array(
		'default' => 860,
		'sanitize_callback' => 'callback_function'
		) );
    $wp_customize->add_control( 'max_width', array(
        'label' => __( 'Set the max width for the site' ),
        'section' => 'nav',
        'settings' => 'max_width'
        ) );

	# Testimonials section
   $wp_customize->add_section('testimonials',      array(
            'title' => __( 'Testimonial', 'wrong' ),
            'priority' => 100
        )
    );
	
	$wp_customize->add_setting( 'testimonial_image_1', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_image_1',		array(
			'type' => 'text',
			'label' =>  __( ' First Testimonial Image', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_name_1', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_name_1',		array(
			'type' => 'text',
			'label' =>  __( 'Customer name', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_text_1', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control('testimonial_text_1',		array(
			'type' => 'textarea',
			'label' =>  __( 'Testimonial', 'wrong' ),
			'section' => 'testimonials',
		)
	);	$wp_customize->add_setting( 'testimonial_image_2', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_image_2',		array(
			'type' => 'text',
			'label' =>  __( 'Second Testimonial Image', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_name_2', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_name_2',		array(
			'type' => 'text',
			'label' =>  __( 'Customer name', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_text_2', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control('testimonial_text_2',		array(
			'type' => 'textarea',
			'label' =>  __( 'Testimonial', 'wrong' ),
			'section' => 'testimonials',
		)
	);	$wp_customize->add_setting( 'testimonial_image_3', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_image_3',		array(
			'type' => 'text',
			'label' =>  __( 'Third Testimonial Image', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_name_3', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control('testimonial_name_3',		array(
			'type' => 'text',
			'label' =>  __( 'Customer name', 'wrong' ),
			'section' => 'testimonials',
		)
	);

	$wp_customize->add_setting( 'testimonial_text_3', array(
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control('testimonial_text_3',		array(
			'type' => 'textarea',
			'label' =>  __( 'Testimonial', 'wrong' ),
			'section' => 'testimonials',
		)
	);
	
	$wp_customize->add_setting( 'footer_setting', array(
		'sanitize_callback' => 'mytheme_sanitation',
		'default' => 'Add some additional text here...'
	) );
	$wp_customize->add_control( 'footer_credit', array(
		'label' => 'Footer extra info',
		'section' => 'title_tagline',
		'settings' => 'footer_setting'
	) );

}
add_action( 'customize_register', 'wrong_customize_register' );

function mytheme_sanitation( $value ){
	return $value;
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wrong_customize_preview_js() {
	wp_enqueue_script( 'wrong_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wrong_customize_preview_js' );
