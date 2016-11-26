<?php
/**
 * wrong functions and definitions
 *
 * @package wrong
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */


if ( ! function_exists( 'wrong_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wrong_setup() {
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 860; /* pixels */
	}
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wrong, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wrong', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-large', 1140, 325 );
	add_image_size( 'featured-medium', 640, 325 );
	add_image_size( 'featured-thumb', 325, 325 );
	set_post_thumbnail_size( 860, 200, array( 'center', 'center' ) );
	add_editor_style();

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wrong' ),
		'footer' => 'Footer Menu',
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', supported_post_formats() );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wrong_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wrong_setup
add_action( 'after_setup_theme', 'wrong_setup' );

function supported_post_formats(){
    // Core formats as example
    // $formats = array( 'quote', 'link', 'chat', 'image', 'gallery', 'audio', 'video' );
    $default = array( 'link', 'image', 'quote' );
    $formats = wp_parse_args( $default, (array)apply_filters( 'theme_formats', array() ) );

    return $formats;
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wrong_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sitewide', 'wrong' ),
		'id'            => 'sitewide',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Single', 'wrong' ),
		'id'            => 'single-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wrong_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wrong_scripts() {
	wp_enqueue_style( 'wrong-style', get_stylesheet_uri() );

	// load own version of jQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js');
	wp_enqueue_script( 'jquery' );

	// load our js
	wp_enqueue_script( 'neat-o-stuff', get_template_directory_uri() . '/js/fx.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/bxslider.js' );
	wp_enqueue_script( 'wrong-navigation', get_template_directory_uri() . '/js/navigation.js', '', null, true );
	wp_enqueue_script( 'wrong-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wrong_scripts' );

function theme_get_options( $option, $default = '' ){
	return get_theme_mod( $option, $default );
}

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/options.php';
