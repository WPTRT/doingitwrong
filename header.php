<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wrong
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/html5shiv.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wrong' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	<?php if ( get_header_image() ): ?>
	<div class="header-image">
		<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo get_bloginfo( 'title', 'display' ); ?>" />
	</div>
	<?php endif; ?>

		<?php if( has_nav_menu( 'primary' ) ): ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'wrong' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'access' ) ); ?>
		</nav><!-- #site-navigation -->
		<?php endif; ?>
		
		<div class="social">
		    <?php $options = get_option( 'default_options' );
            foreach( $options['social'] as $profile => $link ){
                echo '<span class="social">';
                echo '<a href="' . $link . '">' . $profile . '</a>';
                echo '</span>';
            }
            ?>
		    
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
