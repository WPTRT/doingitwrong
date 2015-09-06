<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package nopasare
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function wrong_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wrong_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wrong_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if ( is_front_page() ){
		$classes[] = 'has-slider';
	}

	return $classes;
}
add_filter( 'body_class', 'wrong_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function wrong_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'nopasare' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'wrong_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function wrong_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'wrong_setup_author' );
global $wp_embed;
add_filter( 'the_excerpt', array( $wp_embed, 'autoembed' ), 9 );

function add_link_pages( $content ){
	$pages = wp_link_pages( 
		array( 
			'before' => '<div>' . __( 'Page: ', 'wrong' ),
			'after' => '</div>',
			'echo' => false ) 
	);
	if ( $pages == '' ){
		return $content;
	}
	return $content . $pages;
}
add_filter( 'the_content', 'add_link_pages' );

add_filter( 'the_password_form', 'my_password_form' );
function my_password_form(){
    global $post;
    
    $form = '
    <form class="password-form" action="/wp-login.php?action=postpass" method="post">
    <p>' . __( 'This post is password protected. To read it please enter the password below.' ) . '</p>
    <input type="password" value="" name="post_password" id="password-' . $post->ID . '"/>
    </form>';
    return $form;
}

add_action( 'widgets_init', 'extended_archive_widget' );
function extended_archive_widget(){
	register_widget( 'x_archives' );
}

class x_archives extends WP_Widget
{
	function __construct() {
		$widget_ops = array(
			'classname'   => 'archives_extended',
			'description' => 'Extended archives with additional options.'
			);
		parent::__construct( 'x_archive_widget', 'Archives', $widget_ops );
	}
	
	function widget( $args, $instance ){
		extract( $args );
		$limit = ( empty( $instance['limit'] ) ) ? '12' : $instance['limit'];
		$type  = ( empty( $instance['type'] ) ) ? 'monthly' : $instance['type'];
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);
		
		$content = wp_get_archives( array(
			'type'            => $type,
			'limit'           => $limit,
			'format'          => 'html', 
			'before'          => '',
			'after'           => '',
			'show_post_count' => false,
			'echo'            => 0,
			'order'           => 'DESC'
			) );
		
        $output = $before_widget . $before_title . $title . $after_title . '<ul class="archive">' . $content .'</ul>' . $after_widget;
        echo $output;
    }
        
    function update( $new_instance, $old_instance ){
        $instance = $old_instance; 
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title' => 'Archives', 'type' => '', 'limit' => '') ); 
        $instance['title'] = $new_instance['title'];
        $instance['limit'] = $new_instance['limit']; 
        $instance['type'] = $new_instance['type']; 
        return $instance; 
    }
    
    function form( $instance ){
        $instance = wp_parse_args( (array)$instance, array('title', 'limit', 'type') ); 
        $title = $instance['title']; 
        $limit = $instance['limit']; 
        $type = $instance['type']; 
        $types = array( 
            'Post' => 'postbypost', 
            'Daily' => 'daily', 
            'Weekly' => 'weekly', 
            'Monthly' => 'monthly' 
            ); ?> 
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /> 
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit:' ); ?></label>
            <input id="<?php echo $this->get_field_id('limit'); ?>" class="widefat" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type:' ); ?></label>
            <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
            <?php foreach( $types as $key => $typo ){ 
            echo '<option value=' . $typo;
            selected( $type, $typo );
            echo ">$key</option>";
            } ?>
            </select>
        <?php
    }
        
}


remove_action( 'wp_head', 'feed_links_extra', 3); 
remove_action( 'wp_head', 'feed_links', 2); 